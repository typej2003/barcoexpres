<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\Admin\AdminComponent;

use App\Models\Comercio;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Embarcacion;

class NavigationMap extends AdminComponent
{
    public $comercio;
    public $categories;

    public function mount($comercio_id)
    {
        $this->comercio = Comercio::find($comercio_id);

        $this->categories = Category::where('comercio_id', $comercio_id)
                                    ->where('parent', 1)
                                    ->get();
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

        $menus = Menu::where('comercio_id', $this->comercio->id)
            ->where('menu', 1)
            ->orderBy('posicion', 'asc')
            ->get();

        return view('livewire.components.navigation-map', [
            'menus' => $menus,
        ]);
    }
}
