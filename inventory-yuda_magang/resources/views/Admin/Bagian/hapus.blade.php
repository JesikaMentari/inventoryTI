<!-- MODAL HAPUS BAGIAN -->
<div class="modal fade" data-bs-backdrop="static" id="Hmodaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Hapus Bagian</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus <span id="vbagian"></span>?</p>
                <input type="hidden" name="idbagian">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary d-none" id="btnLoaderDelete" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="submitDeleteForm()" id="btnHapus" class="btn btn-danger">Hapus</a>
                <a href="javascript:void(0)" class="btn btn-light" data-bs-dismiss="modal">Batal</a>
            </div>
        </div>
    </div>
</div>

@section('formHapusJS')
<script>
    function submitDeleteForm() {
        const id_bagian = $("input[name='idbagian']").val();

        setLoadingDelete(true);

        $.ajax({
            type: 'POST',
            url: `/admin/bagian/proses_hapus/${id_bagian}`,
            success: function(data) {
                $('#Hmodaldemo8').modal('toggle');
                swal({
                    title: "Berhasil dihapus!",
                    type: "success"
                });
                table.ajax.reload(null, false);
            }
        });
    }

    function setLoadingDelete(bool) {
        if (bool) {
            $('#btnLoaderDelete').removeClass('d-none');
            $('#btnHapus').addClass('d-none');
        } else {
            $('#btnLoaderDelete').addClass('d-none');
            $('#btnHapus').removeClass('d-none');
        }
    }
</script>
@endsection
