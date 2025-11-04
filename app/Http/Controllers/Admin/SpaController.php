<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SpaController extends Controller
{
    public function load($page)
    {
        $viewPath = "Admin.Page.$page";
        if (View()->exists($viewPath)) {
            $data = [];
            if ($page === 'SilsilahKeluarga') {
                $data['familyData'] = [
                    'jumlahData' => 0,
                    'data' => collect([
                        // 🔹 Generasi 1 (Root Keluarga)

                    ])
                        ->map(function ($item) {
                            $item['foto'] = asset('assets/images/' . $item['foto']);
                            return $item;
                        })
                        ->values()
                        ->toArray(),
                ];

                // Hitung jumlah data
                $data['familyData']['jumlahData'] = count($data['familyData']['data']);
            }
            return view($viewPath, $data);
        }
        return response("Halaman tidak ditemukan", 404);
    }
}
