<?php

namespace App\Http\Controllers;

use App\Models\Pabrik;
use Illuminate\Http\Request;
use App\Http\Requests\FormMapRequest;


class GoogleMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kode_pabrik)
    {
        $pabrik = Pabrik::where('kode_pabrik', $kode_pabrik)->get();

        $dataMap  = Array();
        $dataMap['type']='FeatureCollection';
        $dataMap['features']=array();
        foreach($pabrik as $value){
                $feaures = array();
                $feaures['type']='Feature';
                $geometry = array("type"=>"Point","coordinates"=>[$value->lat, $value->lng]);
                $feaures['geometry']=$geometry;
                $properties=array('title'=>$value->nama_pabrik,"description"=>$value->alamat);
                $feaures['properties']= $properties;
                array_push($dataMap['features'],$feaures);
        }
    //    dd(json_encode($dataMap));
        return View('google-map', compact('pabrik'))->with('dataArray',json_encode($dataMap));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
        	$request, 
        	[
                'title' => 'required',
                'description' => 'required',
                'lat' => 'required',
                'lng' => 'required'
        	]
        );
        Boxmap::create($request->all());
        return redirect('/google-map')->with('success',"Add map success!");
    }
}
