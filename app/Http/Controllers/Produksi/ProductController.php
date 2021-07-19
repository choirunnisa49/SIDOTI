<?php

namespace App\Http\Controllers\Produksi;

use Auth;
use App\Models\Box;
use App\Models\Pabrik;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index() {
        $pabrik = Pabrik::all();
        $kategori = Kategori::all();
        $product = Product::all();
        return view('produksi.product.index', compact('pabrik', 'kategori', 'product'));
    }

    public function idBox($factory, $category) {
        $checkBox = Box::where('kategori_id', $category)->get();

        $boxKe = 0;
        $dataBox = 0;
        for ($hitungBox = 0; $hitungBox < count($checkBox); $hitungBox++) {
            if($checkBox[$hitungBox]->kategori_id == $category && $checkBox[$hitungBox]->isi < $checkBox[$hitungBox]->max) {
                $boxKe = $boxKe + 1;
                $dataBox = $checkBox[$hitungBox]->id;

                $boxUpdate = Box::where('kode_box', $checkBox[$hitungBox]->kode_box)->first();
                $boxUpdate->isi = $checkBox[$hitungBox]->isi + 1;
                $boxUpdate->save();
            }
        }

        if($boxKe == 0) {
            $box = New Box;
            $box->kode_box = rand(10000, 99999);
            $box->kategori_id = $category;
            $box->isi = 1;
            $box->max = 10;
            $box->pabrik_id = $factory;
            $box->dibuat_oleh = Auth::user()->id;
            $box->save();
            $callBox = Box::latest()->get('id');
            $dataBox = $callBox[0]->id;
        }

        return $dataBox;
    }

    public function store(Request $request) {
        $this->validate(
        	$request, 
        	[
                'pabrik' => 'required',
                'kategori' => 'required',
                'jumlah' => 'required'
        	]
        );

        $pabriknya = Pabrik::where('id', $request->input('pabrik'))->get('kode_pabrik');
        // Kode Produk EAN-13
        $kode = array(8,9,9);
        $hasil = 44;

        $kode_pabrik = str_split($pabriknya[0]->kode_pabrik);

        for ($kali=0; $kali < count($kode_pabrik); $kali++) { 
            array_push($kode, (int)$kode_pabrik[$kali]);
            if($kali % 2 == 0) {
                $hasil = $hasil + ($kode_pabrik[$kali] * 3);
            } else {
                $hasil = $hasil + ($kode_pabrik[$kali] * 1);
            }
        }

        $kategorinya = Kategori::where('id', $request->input('kategori'))->get('kode_kategori');
        // Kode Produk EAN-13
        $kode_kategori = str_split($kategorinya[0]->kode_kategori);

        for ($produkke=0; $produkke < count($kode_kategori); $produkke++) { 
            array_push($kode, (int)$kode_kategori[$produkke]);
            if($produkke % 2 == 0) {
                $hasil = $hasil + ($kode_kategori[$produkke] * 3);
            } else {
                $hasil = $hasil + ($kode_kategori[$produkke] * 1);
            }
        }

        $hasil = $hasil%10;
        $hasil = 10 - $hasil;
        if($hasil == 10) { 
            array_push($kode, 0);
        } else {   
            array_push($kode, $hasil);
        }
        $barcode = implode($kode);
        // dd($barcode);

        $checkProduk = Product::all();
        for ($kode=0; $kode < count($checkProduk); $kode++) { 
            if($checkProduk[$kode]->pabrik_id == $request->input('pabrik') && $checkProduk[$kode]->kategori_id == $request->input('kategori')) {
                $barcode = $checkProduk[$kode]->kode_produk;
            }
        }
        // dd($dataBox);

        // Create Produk
        for ($produkKe=0; $produkKe < $request->input('jumlah'); $produkKe++) { 
            $produk = new Product;
            $produk->pabrik_id = $request->input('pabrik');
            $produk->kategori_id = $request->input('kategori');
            $produk->kode_produk = $barcode;
            $produk->kode_produksi = $barcode;
            $produk->box_id = $this->idBox($request->input('pabrik'), $request->input('kategori'));
            $produk->status = "gudang";
            $produk->dibuat_oleh = Auth::user()->id;
            $produk->save();
            // dd($produkKe);
        }

        return redirect('produksi/produk');
    }
}
