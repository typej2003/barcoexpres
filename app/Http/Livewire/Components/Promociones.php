<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Models\Promocion;
class Promociones extends Component
{
    public function render()
    {
        $promocionFirst= Promocion::query()
        ->where('active', 'active')
        ->orderBy('order', 'asc')
        ->first();

        $promociones = Promocion::query()
			->where('active', 'active');
        
        if($promocionFirst){
            $promociones = $promociones
                ->whereNotIn('id', [$promocionFirst->id]);
        }
        
        $promociones = $promociones
            ->orderBy('order', 'asc')
            ->get();

        return view('livewire.components.promociones', [
            'promociones' => $promociones,
            'promocionFirst' => $promocionFirst,
        ]);
    }
}
