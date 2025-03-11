<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Embarcacion; 
use App\Models\Category; 
use App\Models\Menu; 

class MenuComponent extends AdminComponent
{
    public $comercio_id;
    public $manufacturer_id;
    public $modelo_id;
    public $motor_id;

    protected $listeners = [
        'recibirSearch' => 'recibirSearch',
    ];

    public function mount($comercioId = 1, $manufacturer_id = 0, $modelo_id = 0, $motor_id = '0')
    {
        $this->comercio_id = $comercioId;
        $this->manufacturer_id = $manufacturer_id;
        $this->modelo_id = $modelo_id;
        $this->motor_id = $motor_id;
        //dd($this->motor_id);
    }

    public function validar($menu)
    {
        $texto = $menu->texto;
        
        $search = Embarcacion::where(function($q) use ($texto){
            $q->where(function($s) use ($texto){
                $s->where('artepesca','like', '%'. $texto . '%')
                ->orWhere('details1', 'like', '%'. $texto . '%');
            })
                ->orwhereHas('categorias', function($q) use ($texto){
                    $q->where('name','like', '%'. $texto . '%');
                });                
        })->get();

        if($search->count() > 0)
        {
            return true;
        }else{
            return false;
        }        
    }

    public function render()
    {
        $embarcacion = Embarcacion::all();

        $array = $embarcacion->toArray();


        $menus = Menu::where('comercio_id', $this->comercio_id)
            ->where('menu', 1)
            ->orderBy('posicion', 'asc')
            ->get();

        return view('livewire.components.menu-component', [
            'menus' => $menus,
        ]);
    }
}
