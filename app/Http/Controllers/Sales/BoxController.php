<?php

namespace App\Http\Controllers\Sales;

use DB;
use Auth;
use App\Models\Box;
use App\Models\Toko;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoxController extends Controller
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

    public function index() {
        $box = Box::all();

        return view('sales.box.index', compact('box'));
    }

    public function cariToko($id) {
        $tokonya = Toko::where('id', $id)->get();

        return $tokonya;
    }

    public function edit($kode_box) {
        $boxnya = DB::table('box')
                    ->join('kategori', 'box.kategori_id', '=', 'kategori.id')
                    ->select('box.*', 'kategori.nama_kategori')
                    ->where('kode_box', '=', $kode_box)
                    ->get();

        // dd($boxnya[0]);

        $toko = Toko::all();

        return view('sales.box.edit', compact('boxnya', 'toko'));
    }

    public function update(Request $request) {
        if($request->input('status') == 'dijual' || $request->input('status') == 'terjual' || $request->input('status') == 'dikembalikan') {
            $this->validate(
                $request, 
                [
                    'kode' => 'required',
                    'kategori' => 'required',
                    'status' => 'required',
                    'toko' => 'required'
                ]
            );            
        
            $ubahBox = Box::where('kode_box', $request->input('kode'))->first();
            $ubahBox->status = $request->input('status');
            $ubahBox->dijual_oleh = $request->input('toko');
            $ubahBox->save();

            $produk = Product::where('box_id', $ubahBox->id)->get();
            // dd($produk);
            
            for ($dataProduk=0; $dataProduk < count($produk); $dataProduk++) { 
                $ubahProduk = Product::where('id', $produk[$dataProduk]->id)->first();
                $ubahProduk->status = $request->input('status');
                $ubahProduk->toko_id = $request->input('toko');
                $ubahProduk->save();
                // dd($ubahProduk->kode_produksi);
            }

            $ubahDataToko = Toko::where('id', $request->input('toko'))->first();
            if ($request->input('status') == 'dijual') {
                $ubahDataToko->proses_menjual = count($produk);
            } else if ($request->input('status') == 'terjual') {
                $ubahDataToko->terjual = count($produk);
            } else {
                $ubahDataToko->dikembalikan = count($produk);
            }                        
            $ubahDataToko->save();
        } else {
            $this->validate(
                $request, 
                [
                    'kode' => 'required',
                    'kategori' => 'required',
                    'status' => 'required'
                ]
            );            
        
            $ubahBox = Box::where('kode_box', $request->input('kode'))->first();
            $ubahBox->status = $request->input('status');
            $ubahBox->dijual_oleh = NULL;
            $ubahBox->save();

            $produk = Product::where('box_id', $ubahBox->id)->get();
            // dd($produk);

            for ($dataProduk=0; $dataProduk < count($produk); $dataProduk++) { 
                $ubahProduk = Product::where('id', $produk[$dataProduk]->id)->first();
                $ubahProduk->status = $request->input('status');
                $ubahProduk->toko_id = $request->input('toko');
                $ubahProduk->save();
                // dd($ubahProduk->status);
            }
        }

        return redirect('sales/box');
    }
}
