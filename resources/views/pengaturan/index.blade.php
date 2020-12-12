@extends('layouts.app')

@section('page-name','Pengaturan')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('page-name')
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('page-name')</h3>
                    <div class="card-options">
                        <a href="{{ route('pengaturan.edit') }}" class="btn btn-primary btn-sm">Ubah</a>
                    </div>
                </div>
                @if(session()->has('msg'))
                <div class="card-alert alert alert-{{ session()->get('type') }}" id="message" style="border-radius: 0px !important">
                    @if(session()->get('type') == 'success')
                        <i class="fe fe-check mr-2" aria-hidden="true"></i>
                    @else
                        <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> 
                    @endif
                        {{ session()->get('msg') }}
                </div>
                @endif
                <div class="card-body">
                    <p>Nama Aplikasi : <b>{{ $pengaturan->nama }}</b></p>
                        {{-- <button class="btn btn-primary btn-sm">Backup Data</button>
                        <button class="btn btn-danger btn-sm">Reset Data</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    require(['jquery', 'sweetalert'], function ($, sweetalert) {
        $(document).ready(function () {

        });
    });
</script>
@endsection