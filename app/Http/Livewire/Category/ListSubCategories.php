<?php

namespace App\Http\Livewire\Category;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Categories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListSubCategories extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $category;

	public $showEditModal = false;

	public $subcategoryIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

	public $img;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $subcategory;

    public function mount($category_id)
    {
        $this->category = Categories::find($category_id);
    }

	public function addNew()
	{
        $category = $this->category;
		$this->reset();
        $this->category = $category;

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createSubCategory()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'description' => 'required',
		])->validate();

        $validatedData['parent'] = 0;
        $validatedData['category_id'] = $this->category->id;
        $validatedData['ruta'] = $this->category->ruta . '>' . $validatedData['name'];

		if ($this->img) {
			$validatedData['img'] = $this->img->store('/', 'avatarscategories');
		}

		Categories::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Categoria agregada satisfactoriamente!!']);
	}

	public function edit(Categories $subcategory)
	{
		$category = $this->category;
		$this->reset();
        $this->category = $category;

		$this->showEditModal = true;

		$this->subcategory = $subcategory;

		$this->state = $subcategory->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

    public function newSub($category_id)
	{
	
        return redirect()->route('subcategories',['category_id'=>$category_id]);

	}

	public function updateSubCategory()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'description' => 'required',
		])->validate();

        $validatedData['ruta'] = $this->category->ruta . '>' . $validatedData['name'];

		if ($this->img) {
			Storage::disk('avatarscategories')->delete($this->category->img);
			$validatedData['img'] = $this->img->store('/', 'avatarscategories');
		}

		$this->subcategory->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Categoria actualizada satisfactoriamente!']);
	}

	public function confirmSubCategoryRemoval($subcategoryId)
	{
		$this->subcategoryIdBeingRemoved = $subcategoryId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteSubCategory()
	{
		$subcategory = Categories::findOrFail($this->subcategoryIdBeingRemoved);

		$subcategory->delete();

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
    	$categories = Categories::query()
            ->where('category_id', $this->category->id)
            ->where(function($q){
                $q->where('name', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('description', 'like', '%'.$this->searchTerm.'%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

        return view('livewire.category.list-sub-categories', [
        	'categories' => $categories,
        ]);
    }
}
