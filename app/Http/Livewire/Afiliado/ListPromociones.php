<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Promocion;
use App\Models\Comercio;
use App\Models\Embarcacion;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListPromociones extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $comercio;
    public $embarcacion;
    public $comercios = [], $embarcaciones = [];

	protected $rules = [
        'comercio' => 'required|not_in:0',
        'embarcacion' => 'required|not_in:0',
    ];

	public $promocion;
	public $comercio_id;

	public $showEditModal = false;

	public $promocionIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $photo;

	public function updatedComercio($value)
	{
		$this->embarcaciones = Embarcacion::where('comercio_id', $value)->get();
		$this->embarcacion = $this->embarcaciones->first()->id ?? null;
	}

    public function mount($comercioId)
    {
		$this->comercio_id = $comercioId;
    }

    public function addNew()
	{
		$comercio_id = $this->comercio_id;
		$this->reset();
		$this->comercio_id = $comercio_id;

		$this->comercios = Comercio::all();

		$this->embarcaciones = collect();
        
		$this->showEditModal = false;

        $this->state['active'] = 'active';

		$this->dispatchBrowserEvent('show-form');
	}

	public function createPromocion()
	{
		$validatedData = Validator::make($this->state, [
            'title' => 'required',
			'order' => 'required',
            'active' => 'required',
		])->validate();

        // if ($this->photo) {
		// 	$validatedData['avatar'] = $this->photo->store('/', 'avatarspromociones');
		// }
		if ($this->photo) {
            $validatedData['avatar'] = $this->photo->storeAs(null,
			$this->photo->getClientOriginalName(), 'avatarspromociones'
            );     
		}
		$validatedData['comercio_id'] = $this->comercio_id;
		$validatedData['embarcacion_id'] = $this->embarcacion;

		Promocion::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Promoción agregada satisfactoriamente!']);
	}

	public function edit(Promocion $promocion)
	{
		
		$comercio_id = $this->comercio_id;
		$this->reset();
		$this->comercio_id = $comercio_id;
		
		$this->showEditModal = true;

		$this->promocion = $promocion;

		$this->state = $promocion->toArray();

		$this->comercios = Comercio::all();
        $this->comercio = $this->state['comercio_id'];
        $this->embarcacion = $this->state['embarcacion_id'];

		$this->embarcaciones = Embarcacion::where('comercio_id', $this->comercio)->get();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updatePromocion()
	{
		$validatedData = Validator::make($this->state, [
			'title' => 'required',
			'order' => 'required',
            'active' => 'required',
		])->validate();

        if ($this->photo) {
            // $validatedData['avatar'] = $this->photo->store('/', 'avatarscomercios');
			if (Storage::disk('avatarspromociones')->exists($this->promocion->avatar)) {
				Storage::disk('avatarspromociones')->delete($this->promocion->avatar);
			}
			$validatedData['avatar'] = $this->photo->storeAs(null,
			$this->photo->getClientOriginalName(), 'avatarspromociones'
            );     
		}

		$validatedData['comercio_id'] = $this->comercio;
		$validatedData['embarcacion_id'] = $this->embarcacion;

		$this->promocion->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Promocion actualizada satisfactoriamente!']);
	}

	public function confirmPromocionRemoval($promocionId)
	{
		$this->promocionIdBeingRemoved = $promocionId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deletePromocion()
	{
		$promocion = Promocion::findOrFail($this->promocionIdBeingRemoved);

		$promocion->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Promocion eliminada satisfactoriamente!']);
	}

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
    	$promociones = Promocion::query()
    		->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

        return view('livewire.afiliado.list-promociones', [
        	'promociones' => $promociones,
        ]);
    }
}
