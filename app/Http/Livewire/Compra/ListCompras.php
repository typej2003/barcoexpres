<?php

namespace App\Http\Livewire\Compra;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Transaccion;
use App\Models\Comercio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListCompras extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $compra;

	public $comercio_id;

	public $showEditModal = false;

	public $compraIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public function mount($comercioId = 0)
    {
    	$this->comercio_id = $comercioId;
    	
    }

    public function addNew()
	{
		$comercio_id = $this->comercio_id;
		$this->reset();
		$this->comercio_id = $comercio_id;

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createCompra()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
		])->validate();

		$validatedData['comercio_id']=$this->comercio_id;

		Transaccion::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Compra agregada satisfactoriamente!']);
	}

	public function edit(Transaccion $compra)
	{
		$comercio_id = $this->comercio_id;
		$this->reset();
		$this->comercio_id = $comercio_id;

		$this->showEditModal = true;

		$this->compra = $compra;

		$this->state = $compra->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateCompra()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
		])->validate();

		$this->compra->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Compra actualizada satisfactoriamente!']);
	}

	public function confirmCompraRemoval($compraId)
	{
		$this->compraIdBeingRemoved = $compraId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteCompra()
	{
		$compra = Transaccion::findOrFail($this->compraIdBeingRemoved);

		$compra->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Compra eliminada satisfactoriamente!']);
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
    	$compras = Transaccion::query()
    		->where('comercio_id', $this->comercio_id)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

            $comercio = Comercio::find($this->comercio_id);

        return view('livewire.compra.list-compras', [
        	'compras' => $compras,
            'comercio' => $comercio,
        ]);
    }
}
