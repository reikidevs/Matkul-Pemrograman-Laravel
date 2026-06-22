@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-1">
            <div class="card-body">
                <h3 class="card-title text-white">Total Mahasiswa</h3>
                <div class="d-inline-block">
                    <h2 class="text-white">5</h2>
                    <p class="text-white mb-0">Mahasiswa Aktif</p>
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-2">
            <div class="card-body">
                <h3 class="card-title text-white">Program Studi</h3>
                <div class="d-inline-block">
                    <h2 class="text-white">4</h2>
                    <p class="text-white mb-0">Program Studi</p>
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-graduation-cap"></i></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-3">
            <div class="card-body">
                <h3 class="card-title text-white">User</h3>
                <div class="d-inline-block">
                    <h2 class="text-white">10</h2>
                    <p class="text-white mb-0">Total User</p>
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-user"></i></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-4">
            <div class="card-body">
                <h3 class="card-title text-white">Data</h3>
                <div class="d-inline-block">
                    <h2 class="text-white">100%</h2>
                    <p class="text-white mb-0">Data Complete</p>
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-check"></i></span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Selamat Datang di Dashboard</h4>
                <p>Sistem Informasi Akademik - Universitas Semarang</p>
                <p>Gunakan menu di sebelah kiri untuk navigasi.</p>
            </div>
        </div>
    </div>
</div>
@endsection
