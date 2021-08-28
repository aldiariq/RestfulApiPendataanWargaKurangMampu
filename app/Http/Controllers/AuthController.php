<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
    public function tambahakunadmin()
    {
        $name = 'adminsistem';
        $email = 'adminsistem@sistem.com';
        $password = '12345678';

        $admin = new User();
        $admin->name = $name;
        $admin->email = $email;
        $admin->password = Hash::make($password);

        if ($admin->save()) {
            $keterangan = array(
                'status' => true,
                'pesan' => 'Berhasil Menambah Akun Admin'
            );
        } else {
            $keterangan = array(
                'status' => false,
                'pesan' => 'Gagal Menambah Akun Admin'
            );
        }

        return response()->json($keterangan);
    }

    public function masuk(Request $request)
    {
        $validasi = FacadesValidator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (!$validasi->fails()) {
            $admin = User::where('email', $request->email)->first();

            if ($admin) {
                if (Hash::check($request->password, $admin->password)) {
                    $token = $admin->createToken('tokenAutentikasi')->plainTextToken;

                    $keterangan = array(
                        'status' => true,
                        'pesan' => 'Berhasil Masuk',
                        'token' => $token,
                        'admin' => $admin
                    );
                } else {
                    $keterangan = array(
                        'status' => false,
                        'pesan' => 'Pastikan Password Benar'
                    );
                }
            } else {
                $keterangan = array(
                    'status' => false,
                    'pesan' => 'Pastikan Akun Sudah Teregistrasi'
                );
            }
        } else {
            $keterangan = array(
                'status' => false,
                'pesan' => 'Pastikan Email dan Password Terisi'
            );
        }

        return response()->json($keterangan);
    }

    public function keluar()
    {
        if (auth()->user()->tokens()->delete()) {
            $keterangan = array(
                'status' => true,
                'pesan' => 'Berhasil Logout'
            );
        } else {
            $keterangan = array(
                'status' => false,
                'pesan' => 'Gagal Logout'
            );
        }

        return response()->json($keterangan);
    }
}
