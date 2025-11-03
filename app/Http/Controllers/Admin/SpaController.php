<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class SpaController extends Controller
{
    public function load($slug)
    {
        if (request()->ajax()) {
            if (View::exists("Admin.Page.$slug")) {
                return view("Admin.Page.$slug");
            } else {
                return response("<h3>Halaman tidak ditemukan</h3>", 404);
            }
        }

        return view("Admin.Page.$slug");
    }
}
