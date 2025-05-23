@extends('Master.Layouts.app', ['title' => $title])

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Vendor</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-gray">Request Data Barang</li>
                <li class="breadcrumb-item active" aria-current="page">Vendor</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h3 class="card-title">Data Vendor</h3>
                    @if ($hakTambah > 0)
                        <div>
                            <a class="modal-effect btn btn-primary-light"
                                data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#modaldemo8">Tambah Data
                                <i class="fe fe-plus"></i></a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-1" width="100%"
                            class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
                            <thead>
                                <th class="border-bottom-0" width="1%">No</th>
                                <th class="border-bottom-0">Nama Vendor</th>
                                <th class="border-bottom-0">Keterangan</th>
                                <th class="border-bottom-0" width="1%">Action</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END ROW -->

    @include('Admin.Vendor.tambah')
    @include('Admin.Vendor.edit')
    @include('Admin.Vendor.hapus')

    <script>
        function update(data) {
            $("input[name='idvendorU']").val(data.id_vendor);
            $("input[name='vendorU']").val(data.vendor_nama.replace(/_/g, ' '));
            $("textarea[name='ketU']").val(data.vendor_keterangan.replace(/_/g, ' '));
        }

        function hapus(data) {
    $("input[name='idvendorHapus']").val(data.id_vendor);
    $("#vmerk").html("Vendor " + "<b>" + data.vendor_nama.replace(/_/g, ' ') + "</b>");
    
    // Ketika tombol hapus dikonfirmasi
    $("#confirmDeleteButton").on('click', function() {
        $.ajax({
            url: "{{ route('vendor.delete', '') }}/" + data.id_vendor, // URL untuk route delete
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}' // Menyertakan CSRF token
            },
            success: function(response) {
                validasi("Data vendor berhasil dihapus", "success");
                table.ajax.reload(); // Refresh tabel setelah penghapusan berhasil
            },
            error: function(xhr) {
                validasi("Gagal menghapus data vendor", "error");
            }
        });
    });
}


        function validasi(judul, status) {
            swal({
                title: judul,
                type: status,
                confirmButtonText: "Iya."

            });
        }
    </script>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table;
        $(document).ready(function() {
            //datatables
            table = $('#table-1').DataTable({

                "processing": true,
                "serverSide": true,
                "info": true,
                "order": [],
                "stateSave": true,
                "lengthMenu": [
                    [5, 10, 25, 50, 100],
                    [5, 10, 25, 50, 100]
                ],
                "pageLength": 10,

                lengthChange: true,

                "ajax": {
                    "url": "{{ route('vendor.getvendor') }}", // Sesuaikan route dengan route vendor Anda
                },

                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'vendor_nama',
                        name: 'vendor_nama',
                    },
                    {
                        data: 'ket',
                        name: 'vendor_keterangan',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],

            });
        });
    </script>
@endsection
