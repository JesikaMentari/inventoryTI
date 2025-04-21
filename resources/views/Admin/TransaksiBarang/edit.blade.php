<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Transaksi Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    <input type="hidden" name="txb_id">
                    <div class="mb-3">
                        <label>Kode Transaksi</label>
                        <input type="text" class="form-control" name="txb_kode" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Pihak Pertama</label>
                        <input type="text" class="form-control" name="txb_namaPihakPertama" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Pihak Kedua</label>
                        <input type="text" class="form-control" name="txb_namaPihakKedua">
                    </div>
                    <div class="mb-3">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="txb_jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <input type="text" class="form-control" name="kategori">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
