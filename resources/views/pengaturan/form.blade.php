@extends('layouts.app')
@section('page-name', 'Pengaturan')

@section('content')
    <div class="row">
        <div class="col-8">
            <form action="{{ route('pengaturan.store') }}" method="post" class="card" enctype="multipart/form-data">
                <div class="card-header">
                    <h3 class="card-title">@yield('page-name')</h3>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{ $pengaturan->nama }}" required>

                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{ url()->previous() }}" class="btn btn-link">Batal</a>
                        <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection