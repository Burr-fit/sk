<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Orang extends Controller
{
    public function GetOrang() {}

    public function AddOrang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'                  => 'required|string|max:255',
            'tempat_lahir'          => 'nullable|string|max:255',
            'tanggal_lahir'         => 'nullable|date',
            'jenis_kelamin'         => 'nullable|in:L,P',
            'no_telp'               => 'nullable|string|max:20',
            'link_maps_tinggal'     => 'nullable|url',
            'tanggal_wafat'         => 'nullable|date',
            'link_maps_pemakaman'   => 'nullable|url',
            'foto'                  => 'nullable|image|mimestype:jpg,jpeg,png|max:2048',
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

            $orang = Orang::create([
                'nama'          => $request->nama,
                'tempat_lahir'  => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp'       => $request->no_telp,
                'link_maps_tinggal' => $request->link_maps_tinggal,
                'tanggal_wafat' => $request->tanggal_wafat,
                'link_maps_pemakaman' => $request->link_maps_pemakaman,
                'foto' => $fotoPath,
            ]);

            return response()->json([
                'ok'        => true,
                'message'   => 'Data orang berhasil disimpan.',
                'data'      => $orang,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'ok' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }
}
