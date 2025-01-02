<!-- MODAL TAMBAH -->
<div class="modal fade" data-bs-backdrop="static" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Vendor</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="vendor_nama" class="form-label">Nama Vendor <span class="text-danger">*</span></label>
                    <input type="text" name="vendor_nama" class="form-control" placeholder="Masukkan Nama Vendor">
                </div>
                <div class="form-group">
                    <label for="vendor_keterangan" class="form-label">Keterangan</label>
                    <textarea name="vendor_keterangan" class="form-control" rows="4" placeholder="Masukkan Keterangan"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary d-none" id="btnLoader" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="checkForm()" id="btnSimpan" class="btn btn-primary">Simpan <i
                        class="fe fe-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="reset()" data-bs-dismiss="modal">Batal <i
                        class="fe fe-x"></i></a>
            </div>
        </div>
    </div>
</div>

@section('formTambahJS')
<script>
    function checkForm() {
        const vendor_nama = $("input[name='vendor_nama']").val();
        setLoading(true);
        resetValid();

        if (vendor_nama == "") {
            validasi('Nama Vendor wajib di isi!', 'warning');
            $("input[name='vendor_nama']").addClass('is-invalid');
            setLoading(false);
            return false;
        } else {
            submitForm();
        }

    }

    function submitForm() {
        const vendor_nama = $("input[name='vendor_nama']").val();
        const vendor_keterangan = $("textarea[name='vendor_keterangan']").val();

        $.ajax({
            type: 'POST',
            url: "{{ route('vendor.store') }}",
            enctype: 'multipart/form-data',
            data: {
                vendor_nama: vendor_nama,
                vendor_keterangan: vendor_keterangan
            },
            success: function(data) {
                $('#modaldemo8').modal('toggle');
                swal({
                    title: "Berhasil ditambah!",
                    type: "success"
                });
                table.ajax.reload(null, false);
                reset();

            }
        });
    }

    function resetValid() {
        $("input[name='vendor_nama']").removeClass('is-invalid');
    };

    function reset() {
        resetValid();
        $("input[name='vendor_nama']").val('');
        $("textarea[name='vendor_keterangan']").val('');
        setLoading(false);
    }

    function setLoading(bool) {
        if (bool == true) {
            $('#btnLoader').removeClass('d-none');
            $('#btnSimpan').addClass('d-none');
        } else {
            $('#btnSimpan').removeClass('d-none');
            $('#btnLoader').addClass('d-none');
        }
    }
</script>
@endsection
