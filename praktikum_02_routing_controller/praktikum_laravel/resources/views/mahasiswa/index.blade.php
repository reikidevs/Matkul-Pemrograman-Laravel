<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 600px;
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 10px;
        }
        .data-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        .data-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            width: 150px;
            color: #555;
        }
        .value {
            color: #333;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #4CAF50;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Mahasiswa</h1>
        
        <div class="data-row">
            <div class="label">NIM:</div>
            <div class="value">{{ $mahasiswa['nim'] }}</div>
        </div>
        
        <div class="data-row">
            <div class="label">Nama:</div>
            <div class="value">{{ $mahasiswa['nama'] }}</div>
        </div>
        
        <div class="data-row">
            <div class="label">Tempat Lahir:</div>
            <div class="value">{{ $mahasiswa['tempat_lahir'] }}</div>
        </div>
        
        <div class="data-row">
            <div class="label">Tanggal Lahir:</div>
            <div class="value">{{ $mahasiswa['tgl_lahir'] }}</div>
        </div>
        
        <div class="data-row">
            <div class="label">Jenis Kelamin:</div>
            <div class="value">{{ $mahasiswa['jenis_kelamin'] }}</div>
        </div>
        
        <div class="data-row">
            <div class="label">Program Studi:</div>
            <div class="value">{{ $mahasiswa['prodi'] }}</div>
        </div>

        <a href="/" class="back-link">← Kembali ke Home</a>
    </div>
</body>
</html>
