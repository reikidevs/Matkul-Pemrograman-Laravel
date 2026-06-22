<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $data['master'] = array('title' => 'Profil Saya');
        
        // Get user with related profile (penghuni or pemilik)
        $user = auth()->user();
        if ($user->isPenghuni()) {
            $data['profile'] = $user->penghuni;
            $data['profile_type'] = 'penghuni';
        } elseif ($user->isPemilik()) {
            $data['profile'] = $user->pemilikKost;
            $data['profile_type'] = 'pemilik';
        } else {
            $data['profile'] = null;
            $data['profile_type'] = 'admin';
        }
        
        return view('profile.index', $data);
    }

    public function edit()
    {
        $data['master'] = array('title' => 'Edit Profil');
        
        $user = auth()->user();
        if ($user->isPenghuni()) {
            $data['profile'] = $user->penghuni;
            $data['profile_type'] = 'penghuni';
        } elseif ($user->isPemilik()) {
            $data['profile'] = $user->pemilikKost;
            $data['profile_type'] = 'pemilik';
        } else {
            $data['profile'] = null;
            $data['profile_type'] = 'admin';
        }
        
        return view('profile.edit', $data);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        // Validate common fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nama' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        try {
            // Update user table
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            // Update profile table (penghuni or pemilik)
            if ($user->isPenghuni() && $user->penghuni) {
                $user->penghuni->update([
                    'nama' => $validated['nama'] ?? $validated['name'],
                    'no_hp' => $validated['no_hp'],
                    'alamat' => $validated['alamat'],
                ]);
            } elseif ($user->isPemilik() && $user->pemilikKost) {
                $user->pemilikKost->update([
                    'nama' => $validated['nama'] ?? $validated['name'],
                    'no_hp' => $validated['no_hp'],
                    'alamat' => $validated['alamat'],
                ]);
            }

            return redirect()->route('profile.index')
                ->with('success', 'Profil berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Gagal mengupdate profil: ' . $e->getMessage());
        }
    }

    public function changePassword()
    {
        $data['master'] = array('title' => 'Ubah Password');
        return view('profile.change-password', $data);
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.required' => 'Password lama wajib diisi',
            'password.required' => 'Password baru wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        // Check current password
        if (!Hash::check($validated['current_password'], auth()->user()->password)) {
            return redirect()->back()
                ->with('error', 'Password lama tidak sesuai');
        }

        try {
            // Update password
            auth()->user()->update([
                'password' => Hash::make($validated['password']),
            ]);

            return redirect()->route('profile.index')
                ->with('success', 'Password berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengubah password: ' . $e->getMessage());
        }
    }
}
