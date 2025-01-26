<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;

use App\Models\Comercio;
use App\Models\Embarcacion;
use App\Models\Setting;
use App\Models\SettingComercio;

class ViewDetails extends AdminComponent
{
    public $embarcacion_id;

    public $currencyValue;

    public $is_boat = false;    

    public function mount($productId)
    {
        $this->embarcacion_id = $productId;

        $embarcacion = Embarcacion::find($this->embarcacion_id);

        if($embarcacion->in_cart == 0)
        {
            $this->is_boat = $this->embarcacion_id;
        }
        
        $this->currencyValue = request()->cookie('currency');
    }
    public function cambiarSrc($src)
    {
        $this->dispatchBrowserEvent('addSrc', ['src' => $src]);
    }

    public function render()
    {
        $embarcacion = Embarcacion::find($this->embarcacion_id);
        $comercio = Comercio::find($embarcacion->comercio_id);
        
        $setting = SettingComercio::where('comercio_id', $comercio->id)->first();
        
        if($setting == null)
        {
            $setting = SettingComercio::where('comercio_id', 1)->first();
        }        
        
        return view('livewire.afiliado.view-details', [
            'product' => $embarcacion,
            'comercio' => $comercio,
            'in_cellphonecontact' => $setting->in_cellphonecontact,
            'in_sliderprincipal' => $setting->in_sliderprincipal,
            'in_marcasproductos' => $setting->in_marcasproductos,
        ]);
    }
}
