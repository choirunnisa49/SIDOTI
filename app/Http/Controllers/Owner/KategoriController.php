<?php

namespace App\Http\Controllers\Owner;

use DB;
use Auth;
use Alert;
use App\Models\Pabrik;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
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
        $kategori = Kategori::all();
        return view('owner.produk.index', compact('kategori'));
    }
    
    public function create() {
        $pabrik = Pabrik::all();
        return view('owner.produk.create', compact('pabrik'));
    }

    public function store(Request $request) {
        $this->validate(
        	$request, 
        	[
                'produk' => 'required',
                'netto' => 'required|min:0',
                'harga' => 'required|min:0',
                'keuntungan' => 'required|min:0',
                'komposisi' => 'required',
                'saran' => 'required',
                'alergen' => 'required',
        	]
        );

        /*
        // Kode Produk EAN-13
        $kode = array(8,9,9);
        $hasil = 44;

        $kode_pabrik = str_split($request->input('pabrik'));

        for ($kali=0; $kali < count($kode_pabrik); $kali++) { 
            $datanya = 
            array_push($kode, (int)$kode_pabrik[$kali]);
            if($kali % 2 == 0) {
                $hasil = $hasil + ($kode_pabrik[$kali] * 3);
            } else {
                $hasil = $hasil + ($kode_pabrik[$kali] * 1);
            }
        }
        echo implode($kode);

        for ($i=0; $i < 5; $i++) { 
            $bebas = rand(1, 9);
            if($i%2 == 1) {
                array_push($kode, $bebas);
                $hasil = $hasil + ($bebas * 1);
            } else {
                array_push($kode, $bebas);
                $hasil = $hasil + ($bebas * 3);
            }
            echo $bebas;
        }
        $hasil = $hasil%10;
        $hasil = 10 - $hasil;
        array_push($kode, $hasil);
        $barcode = implode($kode);
        dd($barcode);
        */

        // Create Kategori
        $cat = new Kategori;
        $cat->nama_kategori = $request->input('produk');
        $cat->kode_kategori = rand(1000, 9999);
        $cat->komposisi = $request->input('komposisi');
        $cat->informasi_alergen = $request->input('alergen');
        $cat->saran_penyimpanan = $request->input('saran');
        $cat->netto = $request->input('netto');
        $cat->harga = $request->input('harga');
        $cat->keuntungan = $request->input('keuntungan');
        $cat->dibuat_oleh = Auth::user()->id;
        $cat->save();

        return redirect('owner/produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($kode_kategori) {
        $kategori = Kategori::where('kode_kategori', $kode_kategori)->get();
        return view('owner.produk.edit', compact('kategori'));
    }

    public function update(Request $request) {
        $this->validate(
        	$request, 
        	[
                'kode' => 'required',
                'produk' => 'required',
                'netto' => 'required|min:0',
                'harga' => 'required|min:0',
                'keuntungan' => 'required|min:0',
                'komposisi' => 'required',
                'saran' => 'required',
                'alergen' => 'required',
        	]
        );

        $cat = Kategori::where('kode_kategori', $request->input('kode'))->first();
        $cat->nama_kategori = $request->input('produk');
        $cat->komposisi = $request->input('komposisi');
        $cat->informasi_alergen = $request->input('alergen');
        $cat->saran_penyimpanan = $request->input('saran');
        $cat->netto = $request->input('netto');
        $cat->harga = $request->input('harga');
        $cat->keuntungan = $request->input('keuntungan');
        $cat->dibuat_oleh = Auth::user()->id;
        $cat->save();

        return redirect('owner/produk')->with('success', 'Produk berhasil diubah!');
    }

    public function delete($kode_kategori) {
        Kategori::where('kode_kategori',$kode_kategori)->first()->delete();

        alert()->success('Berhasil', 'Kategori anda berhasil dihapus');
        return redirect('owner/produk/');
    }
}
