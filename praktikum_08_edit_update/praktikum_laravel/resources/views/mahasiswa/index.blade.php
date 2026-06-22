@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{-- Tombol Tambah Mahasiswa --}}
                <div class="mb-3">
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Mahasiswa
                    </a>
                </div>

                {{-- Notifikasi Sukses --}}
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                {{-- Notifikasi Gagal --}}
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Mahasiswa</th>
                                <th>Lahir</th>
                                <th>Program Studi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswa as $shs)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $shs['nim'] }}<br>
                                    {{ $shs['nama'] }}<br>
                                    {{ $shs['jenis_kelamin'] }}
                                </td>
                                <td>{{ $shs['tempat_lahir'] }}, {{ $shs['tanggal_lahir']->format('d-m-Y') }}</td>
                                <td>
                                    {{ $shs['prodi']['fakultas'] }}<br>
                                    {{ $shs['prodi']['nama_prodi'] }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        {{-- Button Edit mengarah ke route mahasiswa.edit dengan parameter id --}}
                                        <a href="{{ route('mahasiswa.edit', $shs->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger mr-2">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
