@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{-- Tombol Tambah Program Studi --}}
                <div class="mb-3">
                    <a href="{{ route('prodi.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Program Studi
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
                                <th>Kode Prodi</th>
                                <th>Nama Program Studi</th>
                                <th>Fakultas</th>
                                <th>Jenjang</th>
                                <th>Jumlah Mahasiswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prodi as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->kode_prodi }}</td>
                                <td>{{ $p->nama_prodi }}</td>
                                <td>{{ $p->fakultas }}</td>
                                <td>{{ $p->jenjang }}</td>
                                <td>{{ $p->mahasiswas_count }}</td>
                                <td>
                                    <div class="d-flex">
                                        {{-- Button Edit mengarah ke route prodi.edit --}}
                                        <a href="{{ route('prodi.edit', $p->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>

                                        {{-- Form Hapus dengan method spoofing DELETE --}}
                                        {{-- Menggunakan onsubmit untuk konfirmasi JS sebelum submit --}}
                                        <form action="{{ route('prodi.destroy', $p->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus program studi {{ $p->nama_prodi }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
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
