{{-- <!-- MODAL TAMBAH BAGIAN -->
<div class="modal fade" data-bs-backdrop="static" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Bagian</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_bagian" class="form-label">Nama Bagian <span class="text-danger">*</span></label>
                    <input type="text" name="nama_bagian" class="form-control" placeholder="Masukkan nama bagian">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary d-none" id="btnLoader" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="checkForm()" id="btnSimpan" class="btn btn-primary">Simpan <i class="fe fe-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="reset()" data-bs-dismiss="modal">Batal <i class="fe fe-x"></i></a>
            </div>
        </div>
    </div>
</div>

@section('formTambahJS')
<script>
    function checkForm() {
        const nama_bagian = $("input[name='nama_bagian']").val();
        setLoading(true);
        resetValid();

        if (nama_bagian == "") {
            validasi('Nama Bagian wajib diisi!', 'warning');
            $("input[name='nama_bagian']").addClass('is-invalid');
            setLoading(false);
            return false;
        } else {
            submitForm();
        }
    }

    function submitForm() {
        const nama_bagian = $("input[name='nama_bagian']").val();

        $.ajax({
            type: 'POST',
            url: "{{ route('bagian.store') }}",
            enctype: 'multipart/form-data',
            data: {
                nama_bagian: nama_bagian
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
        $("input[name='nama_bagian']").removeClass('is-invalid');
    };

    function reset() {
        resetValid();
        $("input[name='nama_bagian']").val('');
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

    function validasi(judul, status) {
        swal({
            title: judul,
            type: status,
            confirmButtonText: "Iya"
        });
    }
</script>
@endsection --}}
