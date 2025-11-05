<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\Orangs;

class Orang extends Controller
{
    public function GetOrang() {}

    public function AddOrang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namaKeluarga'          => 'nullable|string|max:255',
            'nama'                  => 'required|string|max:255',
            'tempat_lahir'          => 'nullable|string|max:255',
            'tanggal_lahir'         => 'nullable|date',
            'jenis_kelamin'         => 'nullable|in:Laki-Laki,Perempuan',
            'no_telp'               => 'nullable|string|max:20',
            'link_maps_tinggal'     => 'nullable|url',
            'tanggal_wafat'         => 'nullable|date',
            'link_maps_pemakaman'   => 'nullable|url',
            'foto'                  => 'nullable|image|mimetypes:image/jpeg,image/png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // 🔹 Handle upload foto (opsional)
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $filename = Str::slug($request->nama) . '_' . time() . '.' . $request->foto->extension();
                $fotoPath = $request->file('foto')->move(public_path('assets/images/orang'), $filename);
                $fotoPath = 'assets/images/orang/' . $filename;
            }

            $orang = Orangs::create([
                'idKeluarga'           => 1,
                'namaOrang'            => $request->nama,
                'tempatLahir'          => $request->tempat_lahir,
                'tanggalLahir'         => $request->tanggal_lahir,
                'jenisKelamin'         => $request->jenis_kelamin,
                'noTelphone'           => $request->no_telp,
                'lokasiTinggal'        => $request->link_maps_tinggal,
                'tanggalWafat'         => $request->tanggal_wafat,
                'lokasiPemakaman'      => $request->link_maps_pemakaman,
                'foto'                 => $fotoPath,
                'created_at'           => now(),
                'created_by'           => "Admin",
            ]);

            return response()->json([
                'ok'        => true,
                'message'   => 'Data orang berhasil disimpan.',
                'data'      => $orang,
            ]);
        } catch (\Throwable $e) {
            Log::error('AddOrang error: ' . $e->getMessage());
            return response()->json([
                'ok' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }
}
