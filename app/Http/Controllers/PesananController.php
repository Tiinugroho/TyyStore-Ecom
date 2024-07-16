<?php

namespace App\Http\Controllers;

use App\Models\tbstok;
use App\Models\tbpesanan;
use Illuminate\Http\Request;
use App\Models\tbpesanandetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PesananController extends Controller
{
    public function index()
    {
        return view('admin/pesanan/list');
    }
}
