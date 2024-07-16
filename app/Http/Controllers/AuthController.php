<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbstok;
use App\Models\tbpesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        $product = tbstok::all();
        $id_user = Auth::id();
        $products = tbpesanan::where('id_user', $id_user)
        ->where('status', 'pending')
            ->with('tbstok')
            ->get();
        $jumlah_pesanan = $products->count();
        return view("login", compact('products', 'jumlah_pesanan'));
    }

    public function register()
    {
        $product = tbstok::all();
        $id_user = Auth::id();
        $products = tbpesanan::where('id_user', $id_user)
        ->where('status', 'pending')
            ->with('tbstok')
            ->get();
        $jumlah_pesanan = $products->count();
        return view("register", compact('products', 'jumlah_pesanan'));
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // Cek login valid
        if (Auth::attempt($credentials)) {
            // Menyimpan informasi pengguna dalam sesi
            $request->session()->put('user', Auth::user());
            $request->session()->regenerate();

            // Arahkan admin ke dashboard
            if (Auth::user()->role_id == 1) {
                Session::flash('success', 'Login berhasil! Selamat datang, ' . Auth::user()->username . '!');
                return redirect('/admin/dashboard');
            }
            // Tambahkan SweetAlert untuk notifikasi login sukses
            Session::flash('success', 'Login berhasil! Selamat datang, ' . Auth::user()->username . '!');
            // Arahkan pengguna lain ke halaman utama
            return redirect('/');
        }


        // Tambahkan SweetAlert untuk notifikasi login gagal
        Session::flash('error', 'Login gagal! Username atau password tidak valid.');
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Session::flash('success', 'Logout berhasil! Sampai Jumpa Kembali.');
        return redirect('/login'); // Redirect to login page after logout
    }

    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'phone' => 'max:255',
            'address' => 'required',
        ]);

        // Hash the password before storing it
        $request['password'] = Hash::make($request->password);

        // Add default role_id
        $request['role_id'] = 2;

        // Create the user with the provided data
        $user = User::create($request->all());

        // Flash success message to the session
        // Session::flash('status', 'success');
        Session::flash('success', 'Register Berhasil.');

        // Redirect to the register page
        return redirect('register');
    }
}
