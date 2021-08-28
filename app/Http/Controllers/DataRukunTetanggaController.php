<?php

namespace App\Http\Controllers;

use App\Models\DataRukunTetangga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class DataRukunTetanggaController extends Controller
{
    public function index()
    {
        $rukuntetangga = DataRukunTetangga::all();
        return response()->json(['rukuntetangga' => $rukuntetangga]);
    }

    public function show($id)
    {
        $rukuntetangga = DataRukunTetangga::find($id);
        if ($rukuntetangga) {
            return response()->json(['rukuntetangga' => $rukuntetangga]);
        } else {
            return response()->json(['rukuntetangga' => 'Data Tidak Ditemukan']);
        }
    }

    public function store(Request $request)
    {
        $validasi = FacadesValidator::make($request->all(), [
            'no_ktp_rukun_tetangga' => 'required|string|unique:data_rukun_tetanggas',
            'no_rukun_tetangga' => 'required|numeric',
            'nama_rukun_tetangga' => 'required|string',
            'notel_rukun_tetangga' => 'required|string',
        ]);

        if (!$validasi->fails()) {
            $rukuntetangga = new DataRukunTetangga();
            $rukuntetangga->no_ktp_rukun_tetangga = $request->no_ktp_rukun_tetangga;
            $rukuntetangga->no_rukun_tetangga = $request->no_rukun_tetangga;
            $rukuntetangga->nama_rukun_tetangga = $request->nama_rukun_tetangga;
            $rukuntetangga->notel_rukun_tetangga = $request->notel_rukun_tetangga;

            if ($rukuntetangga->save()) {
                $keterangan = array(
                    'status' => true,
                    'pesan' => 'Berhasil Menambahkan Data'
                );
            } else {
                $keterangan = array(
                    'status' => false,
                    'pesan' => 'Gagal Menambahkan Data'
                );
            }
        } else {
            $keterangan = array(
                'status' => false,
                'pesan' => 'Pastikan Inputan Terisi dan NIK Belum Terdaftar'
            );
        }

        return response()->json($keterangan);
    }

    public function update(Request $request, $id)
    {
        $validasi = FacadesValidator::make($request->all(), [
            'no_ktp_rukun_tetangga' => 'required|string',
            'no_rukun_tetangga' => 'required|numeric',
            'nama_rukun_tetangga' => 'required|string',
            'notel_rukun_tetangga' => 'required|string',
        ]);

        if (!$validasi->fails()) {
            $rukuntetangga = DataRukunTetangga::find($id);
            if ($rukuntetangga) {
                $rukuntetangga->no_ktp_rukun_tetangga = $request->no_ktp_rukun_tetangga;
                $rukuntetangga->no_rukun_tetangga = $request->no_rukun_tetangga;
                $rukuntetangga->nama_rukun_tetangga = $request->nama_rukun_tetangga;
                $rukuntetangga->notel_rukun_tetangga = $request->notel_rukun_tetangga;

                if ($rukuntetangga->update()) {
                    $keterangan = array(
                        'status' => true,
                        'pesan' => 'Berhasil Mengubah Data'
                    );
                } else {
                    $keterangan = array(
                        'status' => false,
                        'pesan' => 'Gagal Mengubah Data'
                    );
                }
            } else {
                $keterangan = array(
                    'status' => false,
                    'pesan' => 'Data Tidak Ditemukan'
                );
            }
        } else {
            $keterangan = array(
                'status' => false,
                'pesan' => 'Pastikan Inputan Terisi dan NIK Belum Terdaftar'
            );
        }

        return response()->json($keterangan);
    }

    public function destroy($id)
    {
        $rukuntetangga = DataRukunTetangga::find($id);

        if ($rukuntetangga) {
            if ($rukuntetangga->delete()) {
                $keterangan = array(
                    'status' => true,
                    'pesan' => 'Berhasil Menghapus Data'
                );
            } else {
                $keterangan = array(
                    'status' => false,
                    'pesan' => 'Gagal Menghapus Data'
                );
            }
        } else {
            $keterangan = array(
                'status' => false,
                'pesan' => 'Data Tidak Ditemukan'
            );
        }

        return response()->json($keterangan);
    }
}
