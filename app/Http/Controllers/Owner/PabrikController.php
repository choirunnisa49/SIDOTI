<?php

namespace App\Http\Controllers\Owner;

use DB;
use Auth;
use Alert;
use App\Models\Pabrik;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PabrikController extends Controller
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
    
    public function get_province(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 1a854acdf61d345b0003dbe13af16d78"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //ini kita decode data nya terlebih dahulu
            $response=json_decode($response,true);
            //ini untuk mengambil data provinsi yang ada di dalam rajaongkir resul
            $data_pengirim = $response['rajaongkir']['results'];
            return $data_pengirim;
        }
    }

    public function get_city($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 1a854acdf61d345b0003dbe13af16d78"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response=json_decode($response,true);
            $data_kota = $response['rajaongkir']['results'];
            return json_encode($data_kota);
        }
    }
    
    public function index() {
        $pabrik = DB::table('pabrik')->get();
        $provinsi = $this->get_province();
        return view('owner.pabrik.index', compact('pabrik', 'provinsi'));
    }

    public function store(Request $request) {
        $this->validate(
        	$request, 
        	[
                'pabrik' => 'required',
                'nama_provinsi' => 'required',
                'kota_id' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'alamat' => 'required',
                'lng' => 'required',
                'lat' => 'required',
        	]
        );

        $kode = rand(1000, 9999);
        try
        {
            $cek = Pabrik::findOrFail($kode);
        }
        // catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
        {
            // Create Pabrik
            $pabrik = new Pabrik;
            $pabrik->nama_pabrik = $request->input('pabrik');
            $pabrik->kode_pabrik = $kode;
            $pabrik->provinsi = $request->input('nama_provinsi');
            $pabrik->kota = $request->kota_id;
            $pabrik->kecamatan = $request->input('kecamatan');
            $pabrik->kelurahan = $request->input('kelurahan');
            $pabrik->alamat = $request->input('alamat');
            $pabrik->lng = $request->input('lng');
            $pabrik->lat = $request->input('lat');
            $pabrik->dibuat_oleh = Auth::user()->id;
            $pabrik->save();
        }
        
        return redirect('owner/pabrik');
    }

    public function show($kode_pabrik) {
        $pabrik = Pabrik::where('kode_pabrik', $kode_pabrik)->get();

        $dataMap  = Array();
        $dataMap['type']='FeatureCollection';
        $dataMap['features']=array();
        foreach($pabrik as $value){
                $feaures = array();
                $feaures['type']='Feature';
                $geometry = array("type"=>"Point","coordinates"=>[$value->lng, $value->lat]); // lng first
                $feaures['geometry']=$geometry;
                $properties=array('title'=>$value->nama_pabrik,"description"=>$value->alamat);
                $feaures['properties']= $properties;
                array_push($dataMap['features'],$feaures);
       }
        
	    return view('owner.pabrik.lokasi', compact('pabrik'))->with('dataArray',json_encode($dataMap));
    }

    public function edit($kode_pabrik) {
        $pabrik = Pabrik::where('kode_pabrik',  $kode_pabrik)->get();
        $provinsi = $this->get_province();

        return view('owner.pabrik.edit', compact('pabrik', 'provinsi'));
    }

    public function update(Request $request)
    {
        $this->validate(
            $request, 
            [
                'kode' => 'required',
        		'pabrik' => 'required',
        		'lat' => 'required',
        		'lng' => 'required',
        		'nama_provinsi' => 'required',
        		'kota_id' => 'required',
        		'kecamatan' =>  'required',
        		'kelurahan' =>  'required',
        		'alamat' =>  'required',
            ]
        );

        // Update Pabrik
        $pabrik = Pabrik::where('kode_pabrik', $request->input('kode'))->first();
        $pabrik->nama_pabrik = $request->input('pabrik');
        $pabrik->lat = $request->input('lat');
        $pabrik->lng = $request->input('lng');
        $pabrik->provinsi = $request->input('nama_provinsi');
        $pabrik->kota = $request->input('kota_id');
        $pabrik->kecamatan = $request->input('kecamatan');
        $pabrik->kelurahan = $request->input('kelurahan');
        $pabrik->alamat = $request->input('alamat');
        $pabrik->save();

        Alert::success('Berhasil', 'Pabrik telah dirubah!');
        return redirect('owner/pabrik');
    }

    public function delete($kode_pabrik) {
        Pabrik::where('kode_pabrik',$kode_pabrik)->first()->delete();

        Alert::success('Berhasil', 'Pabrik anda berhasil dihapus');
        return redirect('owner/pabrik');
    }
}
