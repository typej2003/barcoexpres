<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\Admin\AdminComponent;

use App\Models\Comercio;
use App\Models\Category;

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

    public function render()
    {

        return view('livewire.components.navigation-map');
    }
}
