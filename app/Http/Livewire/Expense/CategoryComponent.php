<?php

namespace App\Http\Livewire\Expense;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $category,$color, $name;
    protected $queryString = [
        'page'
    ];
    public $selectedRows = [];
    public $search = '';
    public $selectPageRows = false;
    public $itemPerPage = 25;
    protected $listeners = ['deleteMultiple', 'deleteSingle', 'searched'];

    public function searched($data)
    {
        $this->search = $data;
    }
    public function saveData()
    {
        if ($this->category){
            $data = $this->validate([
                'name' => ['required', 'min:2', 'max:44', Rule::unique('categories', 'name')->ignore($this->category['id'])],
                'color' => ['required', 'min:2', 'max:44', Rule::unique('categories', 'color')->ignore($this->category['id'])],
            ]);
            $this->category->update($data);
            $this->emit('dataAdded', ['dataId' => 'item-id-'.$this->category->id]);
            $this->alert('success', __('Data updated successfully'));
            $this->reset('name', 'category', 'color');
        }else{
            $data =  $this->validate([
                'name' => ['required', 'min:2', 'max:44', Rule::unique('categories', 'name')],
                'color' => ['required', 'min:2', 'max:44', Rule::unique('categories', 'color')],
            ]);
            $data = Category::create(['user_id' => auth()->id(), 'name'=> $data['name'], 'color' => $data['color']]);
            $this->emit('dataAdded', ['dataId' => 'item-id-'.$data->id]);
            $this->alert('success', __('Data saved successfully'));
            $this->reset('name', 'color');
        }
    }
    public function loadData(Category $category)
    {
        $this->reset('name', 'color');
        $this->category = $category;
        $this->name = $category->name;
        $this->color = $category->color;
        $this->emit('openEditModal');
    }

    public function getDataProperty()
    {
        return Category::where('user_id', auth()->id())->where('name', 'like', '%'.$this->search.'%')->Paginate($this->itemPerPage);
    }

    public function render()
    {
        $items = $this->data;
        return view('livewire.expense.category-component', compact('items'));
    }
    public function deleteSingle(Category $category)
    {
        $category->delete();
        $this->alert('success', __('Data deleted successfully'));
    }

}
