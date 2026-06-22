@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Mahasiswa</h4>
            </div>
            <div class="card-body">
                {{-- Tampilkan error validasi jika ada --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terdapat kesalahan input:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Form Tambah Mahasiswa --}}
                <form action="{{ route('mahasiswa.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nim">NIM <span class="text-danger">*</span></label>
                        <input type="text" name="nim" id="nim"
                            class="form-control @error('nim') is-invalid @enderror"
                            value="{{ old('nim') }}" placeholder="Masukkan NIM">
                        @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}" placeholder="Masukkan nama lengkap">
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir"
                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                            value="{{ old('tempat_lahir') }}" placeholder="Masukkan tempat lahir">
                        @error('tempat_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="form-control @error('jenis_kelamin') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="prodi_id">Program Studi <span class="text-danger">*</span></label>
                        <select name="prodi_id" id="prodi_id"
                            class="form-control @error('prodi_id') is-invalid @enderror">
                            <option value="">-- Pilih Program Studi --</option>
                            @foreach ($prodi as $p)
                            <option value="{{ $p->id }}" {{ old('prodi_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->kode_prodi }} - {{ $p->nama_prodi }} ({{ $p->jenjang }})
                            </option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group d-flex">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
