<!-- MODAL HAPUS -->
<div class="modal fade" data-bs-backdrop="static" id="modalHapusVendor">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Hapus Vendor</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus vendor <span id="vmerk"></span>?</p>
                <input type="hidden" id="idvendorHapus" name="idvendorHapus" value="">
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <a href="javascript:void(0)" onclick="hapusVendor()" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

@section('formHapusJS')
<script>
    function hapusVendor() {
        const id_vendor = $("#idvendorHapus").val();
        console.log("link "+"{{ route('vendor.destroy', '') }}/delete/" + id_vendor);
        if (confirm("Apakah Anda yakin ingin menghapus vendor ini?")) {
            $.ajax({
                type: 'POST',
                url: "{{ route('vendor.destroy', '') }}/delete/" + id_vendor,
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#modalHapusVendor').modal('toggle');
                    alert("Data vendor berhasil dihapus!");
                    table.ajax.reload(null, false);
                },
                error: function(xhr) {
                    alert("Gagal menghapus data vendor: " + xhr.responseText);
                }
            });
        }
    }

    // Fungsi untuk membuka modal hapus
    function openHapusModal(id_vendor, vendorNama) {
        $("#idvendorHapus").val(id_vendor);
        $("#vmerk").text(vendorNama);
        $('#modalHapusVendor').modal('show');
        console.log('modal kebuka '+id_vendor);
    }
</script>
@endsection
