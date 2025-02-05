<?php

namespace App\Http\Livewire\Afiliado\Product\Barcoexpres;

use App\Http\Livewire\Admin\AdminComponent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use App\Models\Area;
use App\Models\Comercio;
use App\Models\Manufacturer;
use App\Models\Category;
use App\Models\Embarcacion;
use App\Models\Subcategory;
use App\Models\ValoracionBoat;

class NewBoat extends AdminComponent
{
    use WithFileUploads;
    
    public $comercio_id; 
    public $comercio; 
    public $embarcacion_id; 
    public $embarcacion;
    public $editModal;
    public $controlActivity = true;
    public $state = [];

    public $photo1;
    public $photo2;
    public $photo3;
    public $photo4;

    public function mount($comercioId, $embarcacionId, $editModal )
    {
        
        $this->comercio_id = $comercioId;
        $this->embarcacion_id = $embarcacionId;
        $this->editModal = $editModal;

        // dd($this->showEditModal);

        if($editModal == 'false'){
            $this->controlActivity = false;
            $this->state['in_delivery'] = false;
            $this->state['container_id'] = "0";
            $this->comercio = Comercio::find($this->comercio_id);
            $this->state['area_id'] = $this->comercio->area_id;
            $this->state['in_pedido'] = "0";
            $this->state['in_envio_gratis'] = "0";
            $this->state['in_offer'] = "0";
            $this->state['in_fragil'] = "0";
            $this->state['in_por_encargo'] = "0";
            $this->state['in_valido'] = "1";
        }else{
            $this->comercio = Comercio::find($this->comercio_id);
            $this->embarcacion = Embarcacion::find($this->embarcacion_id);
            
		    $this->state = $this->embarcacion->toArray();
            
            $this->state['in_cart'] = $this->checkear($this->state['in_cart']);
            $this->state['in_pedido'] = $this->checkear($this->state['in_pedido']);
            $this->state['in_pickup'] = $this->checkear($this->state['in_pickup']);
            $this->state['in_delivery'] = $this->checkear($this->state['in_delivery']);
            $this->state['in_envio_nacional'] = $this->checkear($this->state['in_envio_nacional']);
            $this->state['in_offer'] = $this->checkear($this->state['in_offer']);
            $this->state['in_valido'] = $this->checkear($this->state['in_valido']);
            
        }
        
    }

    public function checkear($value)
    {
        switch ($value) {
            case '0':
                return false;
                break;
            case '1':
                return true;
                break;
        }
    }

    public function changeCategory($categoryId, $subcategory)
	{	
		$subcategories = Subcategory::where('category_id', $categoryId)->get();	

		if($subcategories->count() > 0){
			$msg = 'Seleccione una opción';
			$this->state['subcategory_id'] = 0;
		}else{
			$msg = 'No posee Subcategoria';
			$this->state['subcategory_id'] = 0;
		}

        $this->skipRender();
        		
		$this->dispatchBrowserEvent('sendSubcategories', ['subcategories' => $subcategories, 'subcategory' => $subcategory, 'msg' => $msg]);
	}

    public function createProduct()
	{
        $validatedData = Validator::make($this->state, [
            'area_id' => 'required|not_in:0',
            'category_id' => 'required|not_in:0',
            'subcategory_id' => 'nullable',
            'code' => 'required',
			'name' => 'required',
            'manufacturer_id' => 'nullable',
            'details1' => 'nullable',
            'additional_information' => 'nullable',
            'price1' => 'required',
            'price2' => 'nullable',
            'price_divisa' => 'nullable',
            'stock_min' => 'nullable',
            'stock_max' => 'nullable',
            'stock' => 'nullable',
            'fe_fabricacion' => 'nullable',
            'madein' => 'nullable',
            'in_cart' => 'nullable',
            'in_pedido' => 'nullable',
            'in_pickup'  => 'nullable',
            'in_envio_nacional' => 'nullable',
            'in_delivery' => 'nullable',            
            'in_offer' => 'nullable',
            'tx_recomendacion_consumo' => 'nullable',
            'ca_valoracion' => 'nullable',
            'in_valido' => 'nullable',
            'condition' => 'nullable',
            'eslora' => 'nullable',
            'manga' => 'nullable',
            'color' => 'nullable',
            'material' => 'nullable',
            'maximumcrew' => 'nullable',
            'nroengines' => 'nullable',
            'anno_motor' => 'nullable',
            'enginebrand' => 'nullable',
            'enginemodel' => 'nullable',
            'enginetype' => 'nullable',
            'hoursofuse' => 'nullable',
            'power' => 'nullable',
            'estereo' => 'nullable',
            'negotiable' => 'nullable',
            'matricula' => 'nullable',
            'distintivollamada' => 'nullable',
            'nroomi' => 'nullable',
            'nrommsi' => 'nullable',
            'armador' => 'nullable',
            'puntal' => 'nullable',
            'arqueobruto' => 'nullable',
            'arqueoneto' => 'nullable',
            'capaciadadcombustible' => 'nullable',
            'capaciadadalmacenamiento' => 'nullable',
            'puertoregistro' => 'nullable',
            'artepesca' => 'nullable',
		])->validate();

        $filename = $validatedData['code'].'-'.$this->comercio_id;

		if ($this->photo1) {
            // $validatedData['avatar'] = $this->photo->store('/', 'avatarscomercios');
			$validatedData['image_path1'] = $this->photo1->storeAs(null,
                $filename . '-1.png', 'avatarsboats'
            );     
		}
        if ($this->photo2) {
			//$validatedData['image_path1'] = $this->photo->store('/', 'avatarsproducts');
            $validatedData['image_path2'] = $this->photo2->storeAs(null,
                $filename . '-1.png', 'avatarsboats'
            ); 
		}
        if ($this->photo3) {
			//$validatedData['image_path1'] = $this->photo->store('/', 'avatarsproducts');
            $validatedData['image_path3'] = $this->photo3->storeAs(null,
                $filename . '-1.png', 'avatarsboats'
            ); 
		}
        if ($this->photo4) {
			//$validatedData['image_path1'] = $this->photo->store('/', 'avatarsproducts');
            $validatedData['image_path4'] = $this->photo4->storeAs(null,
                $filename . '-1.png', 'avatarsboats'
            ); 
		}

        $comercio = Comercio::find($this->comercio_id);

        $validatedData['user_id'] = $comercio->user_id;
        $validatedData['userCreated_at'] = auth()->user()->id;
        $validatedData['userUpdated_at'] = auth()->user()->id;
        $validatedData['comercio_id'] = $this->comercio_id;
        $validatedData['currencyValue'] = request()->cookie('currency');

		$embarcacion = Embarcacion::create($validatedData);

        ValoracionBoat::create([
            'user_id' => $embarcacion->user_id,
            'embarcacion_id' => $embarcacion->id,
            'ca_valoracion' => '5',
            'class' => 'five',
            'comment' => 'Excelente',
        ]);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Embarcación agregada satisfactoriamente!']);

        return redirect()->route('listBoats', ['comercioId' => $this->comercio_id, ] );
	}

    public function updateProduct()
	{
        $validatedData = Validator::make($this->state, [
            'area_id' => 'required|not_in:0',
            'category_id' => 'required|not_in:0',
            'subcategory_id' => 'nullable',
            'code' => 'required',
			'name' => 'required',
            'manufacturer_id' => 'nullable',
            'details1' => 'nullable',
            'additional_information' => 'nullable',
            'price1' => 'required',
            'price2' => 'nullable',
            'price_divisa' => 'nullable',
            'stock_min' => 'nullable',
            'stock_max' => 'nullable',
            'stock' => 'nullable',
            'fe_fabricacion' => 'nullable',
            'madein' => 'nullable',
            'in_cart' => 'nullable',
            'in_pedido' => 'nullable',
            'in_pickup'  => 'nullable',
            'in_envio_nacional' => 'nullable',
            'in_delivery' => 'nullable',            
            'in_offer' => 'nullable',
            'tx_recomendacion_consumo' => 'nullable',
            'ca_valoracion' => 'nullable',
            'in_valido' => 'nullable',
            'condition' => 'nullable',
            'eslora' => 'nullable',
            'manga' => 'nullable',
            'color' => 'nullable',
            'material' => 'nullable',
            'maximumcrew' => 'nullable',
            'nroengines' => 'nullable',
            'anno_motor' => 'nullable',
            'enginebrand' => 'nullable',
            'enginemodel' => 'nullable',
            'enginetype' => 'nullable',
            'hoursofuse' => 'nullable',
            'power' => 'nullable',
            'estereo' => 'nullable',
            'negotiable' => 'nullable',
            'matricula' => 'nullable',
            'distintivollamada' => 'nullable',
            'nroomi' => 'nullable',
            'nrommsi' => 'nullable',
            'armador' => 'nullable',
            'puntal' => 'nullable',
            'arqueobruto' => 'nullable',
            'arqueoneto' => 'nullable',
            'capaciadadcombustible' => 'nullable',
            'capaciadadalmacenamiento' => 'nullable',
            'puertoregistro' => 'nullable',
            'artepesca' => 'nullable',
		])->validate();
        //
        
        $filename = $validatedData['code'].'-'.$this->comercio_id;
        $validatedData['currencyValue'] = request()->cookie('currency');

        if ($this->photo1) {
            // $validatedData['avatar'] = $this->photo->store('/', 'avatarscomercios');
			if (Storage::disk('avatarsboats')->exists($this->embarcacion->image_path1)) {
				Storage::disk('avatarsboats')->delete($this->embarcacion->image_path1);
			}
			$validatedData['image_path1'] = $this->photo1->storeAs(null,
                $filename . '-1.png', 'avatarsboats'
            );     
		}

        if ($this->photo2) {
			//$validatedData['image_path1'] = $this->photo->store('/', 'avatarsproducts');
            $validatedData['image_path2'] = $this->photo2->storeAs(null,
                $filename . '-1.png', 'avatarsboats'
            ); 
		}
        if ($this->photo3) {
			//$validatedData['image_path1'] = $this->photo->store('/', 'avatarsproducts');
            $validatedData['image_path3'] = $this->photo3->storeAs(null,
                $filename . '-1.png', 'avatarsboats'
            ); 
		}
        if ($this->photo4) {
			//$validatedData['image_path1'] = $this->photo->store('/', 'avatarsproducts');
            $validatedData['image_path4'] = $this->photo4->storeAs(null,
                $filename . '-1.png', 'avatarsboats'
            ); 
		}

        $this->embarcacion->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Embarcación actualizada satisfactoriamente!']);
    }

    public function render()
    {
        $areas = Area::all();
        $manufacturers = Manufacturer::where('comercio_id', $this->comercio_id)->get();
        $categories = Category::where('comercio_id', $this->comercio_id)->get();
        $years = range(date('Y'), 1900);
        return view('livewire.afiliado.product.barcoexpres.new-boat', [
            'areas' => $areas,
            'categories' => $categories,
            'manufacturers' => $manufacturers,    
            'years' => $years,
        ]);
    }
}
