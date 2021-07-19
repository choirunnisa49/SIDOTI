<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Toko;
use App\Models\User;
use App\Models\Product;
use App\Models\Pabrik;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public static function penjualan($tahun, $bulan) {
        $data = count(Product::where('CREATED_AT', 'like', $tahun.'-'.$bulan.'%')->where('status', 'terjual')->get());
        $ubahData = (int)$data;
        return $ubahData;
    }

    public static function produk($statusnya) {
        $data = count(Product::where('status', $statusnya)->get());
        $ubahData = (int)$data;
        return $ubahData;
    }

    public static function hitungProdukPabrik($kode_pabrik, $kategorinya) {
        $datanya = count(Product::where([['pabrik_id', $kode_pabrik], ['kategori_id', $kategorinya]])->get());
        $ubahDatanya = (int)$datanya;
        return $ubahDatanya;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $toko = Toko::all();
        $user = User::all();
        $kategori = Kategori::all();
        $produk = Product::all();
        $pabrik = Pabrik::all();
        $keuntungan = Product::where('status', 'terjual')->get();
        return view('home', compact('toko', 'user', 'kategori', 'produk', 'pabrik', 'keuntungan'));
    }
}
