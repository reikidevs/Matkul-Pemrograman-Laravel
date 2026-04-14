@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Mahasiswa</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>MAHASISWA</th>
                                <th>LAHIR</th>
                                <th>PROGRAM STUDI</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswa as $index => $mhs)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    {{ $mhs->nim }}<br>
                                    <strong>{{ $mhs->nama }}</strong><br>
                                    <small>{{ $mhs->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</small>
                                </td>
                                <td>{{ $mhs->tempat_lahir }}, {{ $mhs->tanggal_lahir->format('d-m-Y') }}</td>
                                <td>{{ $mhs->programStudi->nama_prodi }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>NO</th>
                                <th>MAHASISWA</th>
                                <th>LAHIR</th>
                                <th>PROGRAM STUDI</th>
                                <th>AKSI</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
