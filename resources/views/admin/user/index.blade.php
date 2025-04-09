@extends('layouts.app')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js" rel="stylesheet">

@endsection
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manajemen Pengguna</h1>
        </div>
    </div>
@endsection
@section('content-main')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">Tambah Pengguna</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap4.js"></script>


    <script>
        $(function() {

            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                Swal.fire({
                    title: 'Apakah Anda Yakin ?',
                    text: "Data akan terhapus tidak dapat dikembalikan lagi !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.value == true) {
                        $.ajax({
                            type: 'DELETE',
                            url: url,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(data, textStatus, jqXHR) {
                                if (jqXHR.status == 200) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your data has been deleted.",
                                        icon: "success",
                                        timer: 2000,
                                    });
                                    table.ajax.reload(null, false);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: jqXHR.responseJSON.message
                                });
                            }
                        });
                    }
                })
            }) //tutup


            let table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: "DT_RowIndex",
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
