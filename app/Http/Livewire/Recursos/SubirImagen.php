<?php

namespace App\Http\Livewire\Recursos;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use Livewire\Component;
use App\Models\Embarcacion;

class SubirImagen extends Component
{

    public function guardarImagen(Request $request)
    {   
        $files = $request->file('photo-file-hs5jg');

        $nombres = '';

        foreach ($files as $InputFile) {
            $nombres .= '/' . $InputFile->getClientOriginalName();
        }

        dd($nombres);

    }

    public function deleteImagen(Request $request)
    {
        $files = $request->post();

        return $files;
    }

    public function render()
    {
        //$images = Embarcacion::select('image_path1','image_path2','image_path3','image_path4','image_path5','image_path6','image_path7','image_path8')->find(1)->toArray();
        $embarcacion = Embarcacion::find(2);
        
        //$images = Arr::only($embarcacion->toArray(), ['image1_url', 'image2_url']);

        $images = [];

        if( strpos($embarcacion->image1_url, 'noimage.png') == 0 ){
            $resp = array_push($images, $embarcacion->image1_url);
        }

        if( strpos($embarcacion->image2_url, 'noimage.png') == 0 ){
            $resp = array_push($images, $embarcacion->image2_url);
        }
        
        if( strpos($embarcacion->image3_url, 'noimage.png') == 0 ){
            $resp = array_push($images, $embarcacion->image3_url);
        }

        if( strpos($embarcacion->image4_url, 'noimage.png') == 0 ){
            $resp = array_push($images, $embarcacion->image4_url);
        }

        if( strpos($embarcacion->image5_url, 'noimage.png') == 0 ){
            $resp = array_push($images, $embarcacion->image5_url);
        }

        if( strpos($embarcacion->image6_url, 'noimage.png') == 0 ){
            $resp = array_push($images, $embarcacion->image6_url);
        }
        
        if( strpos($embarcacion->image7_url, 'noimage.png') == 0 ){
            $resp = array_push($images, $embarcacion->image7_url);
        }

        if( strpos($embarcacion->image8_url, 'noimage.png') == 0 ){
            $resp = array_push($images, $embarcacion->image8_url);
        }

        return view('livewire.recursos.subir-imagen', [
            'images' => $images,
        ]);
    }
}
