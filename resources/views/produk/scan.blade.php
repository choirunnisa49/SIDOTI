@extends('layouts.app-maps')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <video id="preview"></video>
                    <script type="text/javascript">
                        var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
                        scanner.addListener('scan',function(content){
                            // alert(content);
                            window.location.href=content;
                        });
                        Instascan.Camera.getCameras().then(function (cameras){
                            if(cameras.length>0){
                                scanner.start(cameras[0]);
                                $('[name="options"]').on('change',function(){
                                    if($(this).val()==1){
                                        if(cameras[0]!=""){
                                            scanner.start(cameras[0]);
                                        }else{
                                            alert('No Front camera found!');
                                        }
                                    }else if($(this).val()==2){
                                        if(cameras[1]!=""){
                                            scanner.start(cameras[1]);
                                        }else{
                                            alert('No Back camera found!');
                                        }
                                    }
                                });
                            }else{
                                console.error('No cameras found.');
                                alert('No cameras found.');
                            }
                        }).catch(function(e){
                            console.error(e);
                            alert(e);
                        });
                    </script>
                    <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
                    </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection