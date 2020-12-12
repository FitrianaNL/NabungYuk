@extends('layouts.app')

@section('page-name','Dashboard')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            Dashboard
        </h1>
    </div>
    <div class="row">
        <div class="col-6 col-sm-3 col-lg-3">
            <div class="card">
                <div class="card-body p-3 text-center">
                <div class="h1 m-0">IDR {{ format_idr($total_uang_tabungan) }}</div>
                <div class="text-muted mb-4">Total Uang Tabungan</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3 col-lg-3">
            <div class="card">
                <div class="card-body p-3 text-center">
                <div class="h1 m-0">IDR {{ format_idr($total_uang_masuk) }}</div>
                <div class="text-muted mb-4">Total Uang Masuk</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3 col-lg-3">
            <div class="card">
                <div class="card-body p-3 text-center">
                <div class="h1 m-0">IDR {{ format_idr($total_uang_keluar) }}</div>
                <div class="text-muted mb-4">Total Uang Keluar</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3 col-lg-3">
            <div class="card">
                <div class="card-body p-3 text-center">
                <div class="h1 m-0">{{ $siswa }}</div>
                <div class="text-muted mb-4">Mahasiswa</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3 col-lg-3">
            <div class="card">
                <div class="card-body p-3 text-center">
                <div class="h1 m-0">{{ $kelas }}</div>
                <div class="text-muted mb-4">Jurusan</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        require(['jquery', 'selectize','datepicker'], function ($, selectize) {
        $(document).ready(function () {
                $('[data-toggle="datepicker"]').datepicker({
                    format: 'dd-MM-yyyy'
                });
             
            });
        });
    </script>
@endsection