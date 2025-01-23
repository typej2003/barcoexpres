<?php

namespace App\Http\Livewire\Category;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Categories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListCategories extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $comercio_id;

	public $category;

	public $showEditModal = false;

	public $categoryIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

	public $img;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

	public function mount($comercioId)
	{
		$this->comercio_id = $comercioId;
	}

	public function addNew()
	{
		$this->reset();

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createCategory()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'description' => 'required',
		])->validate();

        $validatedData['ruta'] = $validatedData['name'];

		if ($this->img) {
			$validatedData['img'] = $this->img->store('/', 'avatarscategories');
		}

		Categories::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Categoria agregada satisfactoriamente!!']);
	}

	public function edit(Categories $category)
	{
		$this->reset();

		$this->showEditModal = true;

		$this->category = $category;

		$this->state = $category->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

    public function newSub($category_id)
	{
	
        return redirect()->route('subcategories',['category_id'=>$category_id]);

	}

	public function updateCategory()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'description' => 'required',
		])->validate();

		if ($this->img) {
			Storage::disk('avatarscategories')->delete($this->category->img);
			$validatedData['img'] = $this->img->store('/', 'avatarscategories');
		}

		$this->category->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Categoria actualizada satisfactoriamente!']);
	}

	public function confirmCategoryRemoval($categoryId)
	{
		$this->categoryIdBeingRemoved = $categoryId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteCategory()
	{
		$category = Categories::findOrFail($this->categoryIdBeingRemoved);

		$category->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Categoria eliminada satisfactoriamente!']);
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
		$categories = Categories::query();

		if(auth()->user()->role !== 'admin'){
			$categories = $categories->where('comercio_id', $this->comercio_id);
		}

    	$categories = $categories
            ->where('parent', 1)
            ->where(function($q){
                $q->where('name', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('description', 'like', '%'.$this->searchTerm.'%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

        return view('livewire.category.list-categories', [
        	'categories' => $categories,
        ]);
    }
}
