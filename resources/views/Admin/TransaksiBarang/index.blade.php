@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Daftar Transaksi Barang</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Transaksi</button>
    
    <table id="transaksiTable" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Pihak Pertama</th>
                <th>Pihak Kedua</th>
                <th>Bagian Pihak Pertama</th>
                <th>Bagian Pihak Kedua</th>
                <th>Jumlah</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Lampiran</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

@include('Admin.TransaksiBarang.tambah')
@include('Admin.TransaksiBarang.edit')
@include('Admin.TransaksiBarang.hapus')

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#transaksiTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transaksi-barang.data') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'txb_kode', name: 'txb_kode' },
                { data: 'txb_namaPihakPertama', name: 'txb_namaPihakPertama' },
                { data: 'txb_namaPihakKedua', name: 'txb_namaPihakKedua' },
                { data: 'txb_bagianPihakPertama', name: 'txb_bagianPihakPertama' },
                { data: 'txb_bagianPihakKedua', name: 'txb_bagianPihakKedua' },
                { data: 'txb_jumlah', name: 'txb_jumlah' },
                { data: 'kategori', name: 'kategori' },
                { data: 'txb_tanggal', name: 'txb_tanggal' },
                { data: 'txb_lampiran', name: 'txb_lampiran', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
