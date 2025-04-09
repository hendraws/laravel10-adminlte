@extends('layouts.app')
@section('css')
@endsection
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Pengguna</h1>
        </div>
    </div>
@endsection
@section('content-main')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">Kembali</a>
            </div>
        </div>
        <form action="{{ route('users.update', $data->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $data->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $data->email }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" value="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
@section('js')
@endsection
