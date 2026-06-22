<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PemilikKost;
use App\Models\Penghuni;
use App\Models\Kamar;
use App\Models\Penghunian;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Komplain;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin
        $admin = User::create([
            'name' => 'Admin KostKu',
            'email' => 'admin@kostku.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // 2. Create Pemilik Kost
        $pemilikUser = User::create([
            'name' => 'Budi Santoso',
            'email' => 'pemilik@kostku.com',
            'password' => Hash::make('pemilik123'),
            'role' => 'pemilik',
        ]);

        $pemilik = PemilikKost::create([
            'user_id' => $pemilikUser->id,
            'nama' => 'Budi Santoso',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Raya Kost No. 123, Jakarta Selatan',
        ]);

        // 3. Create Kamar-kamar
        $kamars = [];
        for ($i = 1; $i <= 10; $i++) {
            $tipe = $i <= 3 ? 'vip' : ($i <= 7 ? 'deluxe' : 'standar');
            $harga = $tipe == 'vip' ? 1500000 : ($tipe == 'deluxe' ? 1000000 : 750000);
            
            $kamars[] = Kamar::create([
                'nomor_kamar' => 'A' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'tipe' => $tipe,
                'luas' => rand(15, 30),
                'harga_sewa' => $harga,
                'fasilitas' => 'AC, Kasur, Lemari, WiFi, Kamar Mandi Dalam',
                'lantai' => ceil($i / 5),
                'status' => $i <= 7 ? 'terisi' : 'tersedia',
            ]);
        }

        // 4. Create Penghuni dan Penghunian
        $penghuniData = [
            ['nama' => 'Ani Kusuma', 'email' => 'ani@test.com', 'nik' => '3201010101900001'],
            ['nama' => 'Budi Raharjo', 'email' => 'budi@test.com', 'nik' => '3201010101900002'],
            ['nama' => 'Citra Dewi', 'email' => 'citra@test.com', 'nik' => '3201010101900003'],
            ['nama' => 'Doni Prasetyo', 'email' => 'doni@test.com', 'nik' => '3201010101900004'],
            ['nama' => 'Eka Putri', 'email' => 'eka@test.com', 'nik' => '3201010101900005'],
        ];

        foreach ($penghuniData as $index => $data) {
            // Create user
            $user = User::create([
                'name' => $data['nama'],
                'email' => $data['email'],
                'password' => Hash::make('penghuni123'),
                'role' => 'penghuni',
            ]);

            // Create penghuni profile
            $penghuni = Penghuni::create([
                'user_id' => $user->id,
                'nama' => $data['nama'],
                'nik' => $data['nik'],
                'no_hp' => '08123456' . (7890 + $index),
                'pekerjaan' => ['Karyawan Swasta', 'Mahasiswa', 'Wiraswasta', 'PNS', 'Freelancer'][$index],
                'alamat_asal' => 'Jl. ' . ['Sudirman', 'Thamrin', 'Gatot Subroto', 'Kuningan', 'Casablanca'][$index] . ' No. ' . rand(10, 99),
                'kontak_darurat' => '081234567' . (890 + $index),
                'status' => 'active',
            ]);

            // Create penghunian (untuk 5 kamar pertama yang terisi)
            if ($index < 5) {
                $penghunian = Penghunian::create([
                    'penghuni_id' => $penghuni->id,
                    'kamar_id' => $kamars[$index]->id,
                    'tanggal_masuk' => now()->subMonths(rand(1, 6)),
                    'durasi_kontrak' => 12,
                    'status' => 'active',
                ]);

                // Create tagihan
                $tagihan = Tagihan::create([
                    'penghunian_id' => $penghunian->id,
                    'periode' => now()->format('Y-m'),
                    'jumlah' => $kamars[$index]->harga_sewa,
                    'tanggal_jatuh_tempo' => now()->addDays(5),
                    'denda' => 0,
                    'status' => $index % 2 == 0 ? 'paid' : 'pending',
                ]);

                // Create pembayaran untuk yang sudah paid
                if ($index % 2 == 0) {
                    Pembayaran::create([
                        'tagihan_id' => $tagihan->id,
                        'tanggal_bayar' => now()->subDays(3),
                        'jumlah_bayar' => $kamars[$index]->harga_sewa,
                        'metode_pembayaran' => 'transfer',
                        'rekening_tujuan' => 'Bank BCA - 1234567890 a.n. PT Kost Sejahtera',
                        'bukti_transfer' => 'bukti_transfer/sample_bukti_ani.png',
                        'status' => 'approved',
                        'approved_by' => $pemilikUser->id,
                        'approved_at' => now()->subDays(2),
                    ]);
                } else {
                    // Pembayaran pending
                    Pembayaran::create([
                        'tagihan_id' => $tagihan->id,
                        'tanggal_bayar' => now()->subDays(1),
                        'jumlah_bayar' => $kamars[$index]->harga_sewa,
                        'metode_pembayaran' => 'transfer',
                        'rekening_tujuan' => 'Bank Mandiri - 9876543210 a.n. PT Kost Sejahtera',
                        'bukti_transfer' => 'bukti_transfer/sample_bukti_citra.png',
                        'status' => 'pending',
                    ]);
                }
            }
        }

        // 4b. Penghuni dengan kondisi BELUM LUNAS (untuk demo flow pembayaran)
        $userBelumLunas = User::create([
            'name' => 'Fajar Nugroho',
            'email' => 'fajar@test.com',
            'password' => Hash::make('penghuni123'),
            'role' => 'penghuni',
        ]);

        $penghuniBelumLunas = Penghuni::create([
            'user_id' => $userBelumLunas->id,
            'nama' => 'Fajar Nugroho',
            'nik' => '3201010101900006',
            'no_hp' => '081298765432',
            'pekerjaan' => 'Karyawan Swasta',
            'alamat_asal' => 'Jl. Diponegoro No. 45',
            'kontak_darurat' => '081234500006',
            'status' => 'active',
        ]);

        // Tempati kamar A06 (index 5, berstatus terisi)
        $penghunianBelumLunas = Penghunian::create([
            'penghuni_id' => $penghuniBelumLunas->id,
            'kamar_id' => $kamars[5]->id,
            'tanggal_masuk' => now()->subMonths(2),
            'durasi_kontrak' => 12,
            'status' => 'active',
        ]);

        // Tagihan BELUM LUNAS (unpaid) dan TANPA pembayaran
        // -> tombol "Bayar Sekarang" akan muncul di menu Tagihan Saya
        Tagihan::create([
            'penghunian_id' => $penghunianBelumLunas->id,
            'periode' => now()->format('Y-m'),
            'jumlah' => $kamars[5]->harga_sewa,
            'tanggal_jatuh_tempo' => now()->addDays(5),
            'denda' => 0,
            'status' => 'unpaid',
        ]);

        // 5. Create Komplain
        $penghuni1 = Penghuni::first();
        Komplain::create([
            'penghuni_id' => $penghuni1->id,
            'kategori' => 'fasilitas',
            'judul' => 'AC Kamar Tidak Dingin',
            'deskripsi' => 'AC di kamar saya sudah tidak dingin sejak 2 hari yang lalu. Mohon diperbaiki.',
            'prioritas' => 'high',
            'status' => 'open',
        ]);

        Komplain::create([
            'penghuni_id' => $penghuni1->id,
            'kategori' => 'kebersihan',
            'judul' => 'Kamar Mandi Perlu Dibersihkan',
            'deskripsi' => 'Kamar mandi umum di lantai 2 kotor dan berbau.',
            'prioritas' => 'medium',
            'status' => 'in_progress',
            'assigned_to' => $pemilikUser->id,
        ]);

        echo "✅ Seeder berhasil!\n";
        echo "📧 Admin: admin@kostku.com / admin123\n";
        echo "📧 Pemilik: pemilik@kostku.com / pemilik123\n";
        echo "📧 Penghuni (Lunas): ani@test.com / penghuni123\n";
        echo "📧 Penghuni (Belum Lunas): fajar@test.com / penghuni123\n";
    }
}
