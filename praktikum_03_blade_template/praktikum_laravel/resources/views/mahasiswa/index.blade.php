<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>DATA MAHASISWA</h1>
    
    <table border="1" cellpadding="10" cellspacing="0">
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
                    {{ $mhs['nim'] }}<br>
                    {{ $mhs['nama'] }}<br>
                    {{ $mhs['jenis_kelamin'] }}
                </td>
                <td>
                    {{ $mhs['tempat_lahir'] }}, {{ $mhs['tgl_lahir'] }}
                </td>
                <td>{{ $mhs['prodi'] }}</td>
                <td>
                    <a href="#">Edit</a>
                    <a href="#">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a href="/">← Kembali ke Home</a>
</body>
</html>
