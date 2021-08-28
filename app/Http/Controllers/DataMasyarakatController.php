<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMasyarakat;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class DataMasyarakatController extends Controller
{
    public function index()
    {
        $masyarakat = DataMasyarakat::all();
        return response()->json(['masyarakat' => $masyarakat]);
    }

    public function show($id)
    {
        $masyarakat = DataMasyarakat::find($id);
        if ($masyarakat) {
            return response()->json(['masyarakat' => $masyarakat]);
        } else {
            return response()->json(['masyarakat' => 'Data Tidak Ditemukan']);
        }
    }

    public function store(Request $request)
    {
        $validasi = FacadesValidator::make($request->all(), [
            'no_kartu_keluarga' => ['required', 'unique:data_masyarakats'],
            'no_ktp_kepala_keluarga' => 'required',
            'nama_kepala_keluarga' => 'required',
            'pekerjaan_kepala_keluarga' => 'required',
            'penghasilan_kepala_keluarga' => 'required',
            'jumlah_tanggungan' => 'required',
            'foto_kepala_keluarga' => 'required|image|mimes:jpg,png',
            'notel_kepala_keluarga' => 'required',
            'status_tempat_tinggal' => 'required',
            'id_rukun_tetangga' => 'required'
        ]);

        if (!$validasi->fails()) {
            if ($request->hasFile('foto_kepala_keluarga')) {
                $namagambar = time() . '.' . $request->foto_kepala_keluarga->extension();
                $request->foto_kepala_keluarga->move(public_path('uploads/foto_kepala_keluarga'), $namagambar);
            }

            $masyarakat = new DataMasyarakat();
            $masyarakat->no_kartu_keluarga = $request->no_kartu_keluarga;
            $masyarakat->no_ktp_kepala_keluarga = $request->no_ktp_kepala_keluarga;
            $masyarakat->nama_kepala_keluarga = $request->nama_kepala_keluarga;
            $masyarakat->pekerjaan_kepala_keluarga = $request->pekerjaan_kepala_keluarga;
            $masyarakat->penghasilan_kepala_keluarga = $request->penghasilan_kepala_keluarga;
            $masyarakat->jumlah_tanggungan = $request->jumlah_tanggungan;
            $masyarakat->foto_kepala_keluarga = $namagambar;
            $masyarakat->notel_kepala_keluarga = $request->notel_kepala_keluarga;
            $masyarakat->status_tempat_tinggal = $request->status_tempat_tinggal;
            $masyarakat->id_rukun_tetangga = $request->id_rukun_tetangga;

            if ($masyarakat->save()) {
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
                'pesan' => 'Pastikan Inputan Terisi dan No KK Belum Terdaftar'
            );
        }

        return response()->json($keterangan);
    }

    public function update(Request $request, $id)
    {
        $validasi = FacadesValidator::make($request->all(), [
            'no_kartu_keluarga' => 'required',
            'no_ktp_kepala_keluarga' => 'required',
            'nama_kepala_keluarga' => 'required',
            'pekerjaan_kepala_keluarga' => 'required',
            'penghasilan_kepala_keluarga' => 'required',
            'jumlah_tanggungan' => 'required',
            'foto_kepala_keluarga' => 'nullable|image|mimes:jpg,png',
            'notel_kepala_keluarga' => 'required',
            'status_tempat_tinggal' => 'required',
            'id_rukun_tetangga' => 'required'
        ]);

        if (!$validasi->fails()) {
            $masyarakat = DataMasyarakat::find($id);

            if ($request->hasFile('foto_kepala_keluarga')) {
                $namagambar = time() . '.' . $request->foto_kepala_keluarga->extension();
                $request->foto_kepala_keluarga->move(public_path('uploads/foto_kepala_keluarga'), $namagambar);
            } else {
                $namagambar = $masyarakat->foto_kepala_keluarga;
            }

            if ($masyarakat) {
                $masyarakat->no_kartu_keluarga = $request->no_kartu_keluarga;
                $masyarakat->no_ktp_kepala_keluarga = $request->no_ktp_kepala_keluarga;
                $masyarakat->nama_kepala_keluarga = $request->nama_kepala_keluarga;
                $masyarakat->pekerjaan_kepala_keluarga = $request->pekerjaan_kepala_keluarga;
                $masyarakat->penghasilan_kepala_keluarga = $request->penghasilan_kepala_keluarga;
                $masyarakat->jumlah_tanggungan = $request->jumlah_tanggungan;
                $masyarakat->foto_kepala_keluarga = $namagambar;
                $masyarakat->notel_kepala_keluarga = $request->notel_kepala_keluarga;
                $masyarakat->status_tempat_tinggal = $request->status_tempat_tinggal;
                $masyarakat->id_rukun_tetangga = $request->id_rukun_tetangga;

                if ($masyarakat->update()) {
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
                'pesan' => 'Pastikan Inputan Terisi dan No KK Belum Terdaftar'
            );
        }

        return response()->json($keterangan);
    }

    public function delete($id)
    {
        $masyarakat = DataMasyarakat::find($id);

        if ($masyarakat) {
            if ($masyarakat->delete()) {
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
