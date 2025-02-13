<?php

namespace App\Http\Livewire\Operacion;

use Livewire\Component;

use App\Models\Embarcacion;
use App\Models\Menu;

class Prueba extends Component
{
    public function mount()
    {
        $embarcacion = Embarcacion::select('id','name', 'artepesca', 'category_id')
                ->with('categorias')->get();

        $array = $embarcacion->toArray();

        //dd($array);

        //$menu = Menu::where('comercio_id', $this->comercio_id);
        $menu = Menu::query()->where('comercio_id', 1);

        foreach($array as $valor){
            $menu = $menu->where(function($q) use ($valor) {
                $q->orwhere('texto', $valor['name'])
                ->orwhere('texto', $valor['categorias'][0]['name']);
            });
        }

        $menu = $menu
            ->where('menu', 1)
            ->orderBy('posicion', 'asc')
            ->get();

    }

    public function render()
    {
        return view('livewire.operacion.prueba');
    }
}
