@extends('layouts.app')
@section('css')
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
           {{-- content --}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
@section('js')
@endsection
