<!-- MODAL EDIT VENDOR -->
<div class="modal fade" data-bs-backdrop="static" id="modalEditVendor">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Vendor</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Input untuk ID Vendor -->
                <!-- <input type="hidden" name="idvendorU" id="idvendorU"> -->
                <div class="form-group">
                    <label for="idvendorU" class="form-label">ID Vendor <span class="text-danger">*</span></label>
                    <input type="text" name="idvendorU" class="form-control" placeholder="Masukkan Id Vendor">
                </div>
                <div class="form-group">
                    <label for="vendorU" class="form-label">Nama Vendor <span class="text-danger">*</span></label>
                    <input type="text" name="vendorU" class="form-control" placeholder="Masukkan Nama Vendor">
                </div>
                <div class="form-group">
                    <label for="ketU" class="form-label">Keterangan</label>
                    <textarea name="ketU" class="form-control" rows="4" placeholder="Masukkan Keterangan"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success d-none" id="btnLoaderEdit" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="checkEditForm()" id="btnSimpanEdit" class="btn btn-success">Simpan Perubahan <i class="fe fe-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="resetEdit()" data-bs-dismiss="modal">Batal <i class="fe fe-x"></i></a>
            </div>
        </div>
    </div>
</div>

@section('formEditJS')
<script>
$(document).ready(function() {
    function checkEditForm() {
        console.log("Fungsi checkEditForm dipanggil.");  // Tambahkan ini untuk debug
        
        const vendorNama = $("input[name='vendorU']").val();
        const idVendor = $("input[name='idvendorU']").val();
        console.log(idVendor);

        setLoadingEdit(true);
        resetValidEdit();

        if (vendorNama === "" || idVendor === "") {
            alert('Nama Vendor dan ID Vendor wajib diisi');
            if (vendorNama === "") $("input[name='vendorU']").addClass('is-invalid');
            if (idVendor === "") $("input[name='id_vendor']").addClass('is-invalid'); 
            setLoadingEdit(false);
            return false;
        } else {
            submitEditForm(idVendor, vendorNama);
        }
    }

    function submitEditForm(id, vendorNama) {
        const vendorKeterangan = $("textarea[name='ketU']").val();

        $.ajax({
            type: 'POST',
            url: "{{ route('vendor.update') }}",
            data: {
                id_vendor: id,  // Pastikan kita mengirim id_vendor
                vendor_nama: vendorNama,
                vendor_keterangan: vendorKeterangan,
                _method: 'PUT', // Laravel membutuhkan ini untuk metode PUT
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                $('#modalEditVendor').modal('toggle');
                alert("Data vendor berhasil diubah!");
                table.ajax.reload(null, false);
                resetEdit();
            },
            error: function(xhr) {
                alert("Gagal mengubah data vendor: " + xhr.responseText);
                setLoadingEdit(false);
            }
        });
    }

    function resetValidEdit() {
        $("input[name='vendorU']").removeClass('is-invalid');
        $("input[name='idvendorU']").removeClass('is-invalid');
    };

    function openEditModal(idVendor, vendorNama, vendorKeterangan) {
        $("input[name='idvendorU']").val(idVendor); // Pastikan input ini ada dan terisi
        $("input[name='vendorU']").val(vendorNama);
        $("textarea[name='ketU']").val(vendorKeterangan);
        $('#modalEditVendor').modal('show');
    }

    function setLoadingEdit(bool) {
        if (bool) {
            $('#btnLoaderEdit').removeClass('d-none');
            $('#btnSimpanEdit').addClass('d-none');
        } else {
            $('#btnSimpanEdit').removeClass('d-none');
            $('#btnLoaderEdit').addClass('d-none');
        }
    }

    // Menghubungkan fungsi checkEditForm dengan onclick
    $('#btnSimpanEdit').on('click', checkEditForm);
});
</script>
@endsection
