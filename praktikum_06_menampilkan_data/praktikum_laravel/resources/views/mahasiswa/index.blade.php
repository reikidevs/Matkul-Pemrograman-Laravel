@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
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
                                        <a href="#" class="btn btn-sm btn-warning mr-2">Edit</a>
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
