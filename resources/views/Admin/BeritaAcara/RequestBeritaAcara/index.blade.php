@extends('Master.Layouts.app', ['title' => 'Berita Acara Serah Terima'])

@section('content')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Berita Acara Serah Terima</h1>
    <div>
        <label for="tipe">Tipe:</label>
        <select name="tipe" id="tipe" class="form-control d-inline-block" style="width: auto;">
            <option value="masuk">Barang Masuk</option>
            <option value="keluar">Barang Keluar</option>
        </select>
    </div>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-gray"></li>
            <li class="breadcrumb-item active" aria-current="page">Berita Acara Serah Terima</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- ROW -->
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <!-- Header with Logo -->
                <div class="text-center mb-5">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset('assets/default/web/default.png') }}" alt="Default" style="width: 80px; margin-right: 15px;">
                        <div>
                            <h2>BERITA ACARA SERAH TERIMA</h2>
                            <h4>PTPN IV REGIONAL III</h4>
                        </div>
                    </div>
                </div>

                <form id="formBeritaAcara" method="POST" action="{{ route('req-ba.print') }}" target="_blank">
                    @csrf
                    <p>Pada hari ini,
                        <select name="hari" id="hari" class="form-control d-inline-block" style="width: auto;">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>,
                        tanggal <input type="date" name="tanggal" id="tanggal" class="form-control d-inline-block" style="width: auto;">, kami yang bertandatangan di bawah ini:
                    </p>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h4>I. Data Pihak Pertama</h4>
                            <div class="form-group">
                                <label for="namaPihakPertama">Nama</label>
                                <input type="text" id="namaPihakPertama" name="namaPihakPertama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="jabatanPihakPertama">Jabatan</label>
                                <input type="text" id="jabatanPihakPertama" name="jabatanPihakPertama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="teleponPihakPertama">Nomor HP</label>
                                <input type="text" id="teleponPihakPertama" name="teleponPihakPertama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="unitPihakPertama">Unit/Keb/PKS/Instansi</label>
                                <input type="text" id="unitPihakPertama" name="unitPihakPertama" class="form-control" required>
                            </div>
                        </div>

<<<<<<< HEAD
                            <div class="col-md-6">
=======
                        <div class="col-md-6">
>>>>>>> 5bd76ee88b7e4793bcf1d3aec2d9eea57f57af34
                            <h4>II. Data Pihak Kedua</h4>
                            <div class="form-group">
                                <label for="namaPihakKedua">Nama</label>
                                <input type="text" id="namaPihakKedua" name="namaPihakKedua" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="jabatanPihakKedua">Jabatan</label>
                                <input type="text" id="jabatanPihakKedua" name="jabatanPihakKedua" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="teleponPihakKedua">Nomor HP</label>
                                <input type="text" id="teleponPihakKedua" name="teleponPihakKedua" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="unitPihakKedua">Unit/Keb/PKS/Instansi</label>
                                <input type="text" id="unitPihakKedua" name="unitPihakKedua" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <p class="mt-4">Dalam hal ini disebut sebagai PIHAK PERTAMA (yang menyerahkan) dan PIHAK KEDUA (yang menerima).</p>

                    <p>Dengan ini menyatakan bahwa PIHAK PERTAMA telah menyerahkan kepada PIHAK KEDUA dan PIHAK KEDUA telah menerima perangkat sebagai berikut:</p>

                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Type</th>
                                    <th>Jumlah</th>
                                    <th>Service Tag / SN</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="barangTableBody">
                                <tr>
                                    <td><input type="text" name="namaBarang[]" class="form-control" required></td>
                                    <td><input type="text" name="typeBarang[]" class="form-control" required></td>
                                    <td><input type="number" name="jumlahBarang[]" class="form-control" required></td>
                                    <td><input type="text" name="snBarang[]" class="form-control" required></td>
                                    <td><input type="text" name="keteranganBarang[]" class="form-control" required></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between mt-2">
                            <button type="button" class="btn btn-secondary" onclick="addRow()">
                                <i class="fe fe-plus"></i> Tambah Barang
                            </button>
                            <button type="button" class="btn btn-danger" onclick="deleteLastRow()">
                                <i class="fe fe-minus"></i> Hapus Barang
                            </button>
                        </div>
                    </div>

                    <p class="mt-4">Sejak penandatanganan berita acara ini, maka barang tersebut menjadi tanggung jawab PIHAK KEDUA untuk dipergunakan sebagai alat kerja.</p>

<<<<<<< HEAD
                        <div class="row mt-5">
=======
                    <div class="row mt-5">
>>>>>>> 5bd76ee88b7e4793bcf1d3aec2d9eea57f57af34
                        <div class="col-md-6 text-center">
                            <p>PIHAK PERTAMA</p>
                            <br><br>
                            <p id="tandaTanganPihakPertama"></p>
                        </div>
                        <div class="col-md-6 text-center">
                            <p>PIHAK KEDUA</p>
                            <br><br>
                            <p id="tandaTanganPihakKedua"></p>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary" onclick="printba()"><i class="fe fe-printer"></i> Print Berita Acara</button>
                            <button type="button" class="btn btn-success" onclick="submitSaveForm()"><i class="fe fe-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ROW END -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    function addRow() {
        const tableBody = document.getElementById('barangTableBody');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td><input type="text" name="namaBarang[]" class="form-control" required></td>
            <td><input type="text" name="typeBarang[]" class="form-control" required></td>
            <td><input type="number" name="jumlahBarang[]" class="form-control" required></td>
            <td><input type="text" name="snBarang[]" class="form-control" required></td>
            <td><input type="text" name="keteranganBarang[]" class="form-control"></td>
        `;

        tableBody.appendChild(newRow);
    }

    function deleteLastRow() {
        const tableBody = document.getElementById('barangTableBody');
        if (tableBody.rows.length > 1) {
            tableBody.deleteRow(tableBody.rows.length - 1);
        }
    }

    function updateSignature() {
        const namaPihakPertama = document.getElementById('namaPihakPertama').value;
        const namaPihakKedua = document.getElementById('namaPihakKedua').value;

        document.getElementById('tandaTanganPihakPertama').innerText = namaPihakPertama;
        document.getElementById('tandaTanganPihakKedua').innerText = namaPihakKedua;
    }

    function submitSaveForm() {
        const tipe = document.getElementById('tipe').value; // Ambil nilai tipe dari dropdown
        const form = document.getElementById('formBeritaAcara'); // Ambil form yang ingin disubmit

        // Mengatur action form berdasarkan tipe
        if (tipe === 'masuk') {
            form.action = "{{ route('request.beritaacara.storeMasuk') }}"; // Rute untuk Barang Masuk
        } else if (tipe === 'keluar') {
            form.action = "{{ route('request.beritaacara.storeKeluar') }}"; // Rute untuk Barang Keluar
        }

        const formData = new FormData(form);

        // Kirim data menggunakan AJAX
        fetch(form.action, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Data berhasil disimpan',
                        icon: 'success',
                        confirmButtonColor: '#09ad95',
                    }).then(() => {
                        // Redirect ke halaman sesuai tipe di tab baru
                        if (tipe === 'masuk') {
                            window.open("{{ route('barang-masuk.index') }}", "_blank");
                        } else if (tipe === 'keluar') {
                            window.open("{{ route('barang-keluar.index') }}", "_blank");
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Terjadi kesalahan',
                        text: data.message || 'Gagal menyimpan data.',
                        icon: 'error',
                        confirmButtonColor: '#d33',
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error',
                    text: error.message || 'Terjadi kesalahan saat mengirim data.',
                    icon: 'error',
                    confirmButtonColor: '#d33',
                });
            });
    }

    function printba() {
        const form = document.getElementById('formBeritaAcara');
        const tipe = document.getElementById('tipe').value;

        form.action = "{{ route('req-ba.print') }}"

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin ingin menyimpan data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#09ad95',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateSignature();
                    form.submit();
                }
            });
        });

        document.getElementById('namaPihakPertama').addEventListener('input', updateSignature);
        document.getElementById('namaPihakKedua').addEventListener('input', updateSignature);
    }
</script>
@endsection
