<?php

namespace App\Http\Controllers;
use App\Models\lelang;
use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function admin ()
    {
        return view('dashboard.admin');
    }
    public function petugas ()
    {
        return view('dashboard.petugas');
    }
    public function masyarakat ()
    {
        return view('dashboard.masyarakat');
    }
}
