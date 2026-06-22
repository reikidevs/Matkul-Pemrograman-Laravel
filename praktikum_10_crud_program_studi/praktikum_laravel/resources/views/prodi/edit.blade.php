@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Program Studi</h4>
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

                {{-- Form Edit Program Studi --}}
                {{-- action mengarah ke route prodi.update dengan parameter id prodi --}}
                <form action="{{ route('prodi.update', $prodi->id) }}" method="POST">
                    @csrf
                    {{-- Method spoofing PUT karena HTML hanya support GET dan POST --}}
                    @method('PUT')

                    <div class="form-group">
                        <label for="kode_prodi">Kode Program Studi <span class="text-danger">*</span></label>
                        <input type="text" name="kode_prodi" id="kode_prodi"
                            class="form-control @error('kode_prodi') is-invalid @enderror"
                            value="{{ old('kode_prodi', $prodi->kode_prodi) }}" placeholder="Contoh: TI, SI, MNJ">
                        @error('kode_prodi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_prodi">Nama Program Studi <span class="text-danger">*</span></label>
                        <input type="text" name="nama_prodi" id="nama_prodi"
                            class="form-control @error('nama_prodi') is-invalid @enderror"
                            value="{{ old('nama_prodi', $prodi->nama_prodi) }}" placeholder="Contoh: Teknik Informatika">
                        @error('nama_prodi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="fakultas">Fakultas <span class="text-danger">*</span></label>
                        <input type="text" name="fakultas" id="fakultas"
                            class="form-control @error('fakultas') is-invalid @enderror"
                            value="{{ old('fakultas', $prodi->getRawOriginal('fakultas')) }}" placeholder="Contoh: Fakultas Teknologi Informasi dan Komunikasi">
                        @error('fakultas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenjang">Jenjang <span class="text-danger">*</span></label>
                        @php $jenjangValue = old('jenjang', $prodi->jenjang); @endphp
                        <select name="jenjang" id="jenjang"
                            class="form-control @error('jenjang') is-invalid @enderror">
                            <option value="">-- Pilih Jenjang --</option>
                            <option value="D3" {{ $jenjangValue == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ $jenjangValue == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ $jenjangValue == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ $jenjangValue == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                        @error('jenjang')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group d-flex">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fa fa-save"></i> Update
                        </button>
                        <a href="{{ route('prodi.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
