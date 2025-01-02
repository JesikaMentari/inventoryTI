<!-- MODAL EDIT BAGIAN -->
<div class="modal fade" data-bs-backdrop="static" id="Umodaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Edit Bagian</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_bagian" class="form-label">Nama Bagian <span class="text-danger">*</span></label>
                    <input type="hidden" name="idbagianU" />
                    <input type="text" name="bagianU" class="form-control" placeholder="Masukkan nama bagian">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary d-none" id="btnLoaderEdit" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="submitEditForm()" id="btnUpdate" class="btn btn-primary">Simpan Perubahan</a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="resetEdit()" data-bs-dismiss="modal">Batal</a>
            </div>
        </div>
    </div>
</div>

@section('formEditJS')
<script>
    function submitEditForm() {
        const id_bagian = $("input[name='idbagianU']").val();
        const nama_bagian = $("input[name='bagianU']").val();

        setLoadingEdit(true);

        $.ajax({
            type: 'POST',
            url: `/admin/bagian/proses_ubah/${id_bagian}`,
            data: {
                nama_bagian: nama_bagian,
            },
            success: function(data) {
                $('#Umodaldemo8').modal('toggle');
                swal({
                    title: "Berhasil diubah!",
                    type: "success"
                });
                table.ajax.reload(null, false);
                resetEdit();
            }
        });
    }

    function resetEdit() {
        $("input[name='bagianU']").removeClass('is-invalid').val('');
        setLoadingEdit(false);
    }

    function setLoadingEdit(bool) {
        if (bool) {
            $('#btnLoaderEdit').removeClass('d-none');
            $('#btnUpdate').addClass('d-none');
        } else {
            $('#btnLoaderEdit').addClass('d-none');
            $('#btnUpdate').removeClass('d-none');
        }
    }
</script>
@endsection
