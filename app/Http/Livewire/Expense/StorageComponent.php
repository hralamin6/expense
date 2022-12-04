<?php

namespace App\Http\Livewire\Expense;

use App\Models\Storage;
use App\Models\Income;
use App\Models\Expense;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class StorageComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $storage,$color, $name;
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
        if ($this->storage){
            $data = $this->validate([
                'name' => ['required', 'min:2', 'max:44', Rule::unique('storages', 'name')->ignore($this->storage['id'])],
                'color' => ['required', 'min:2', 'max:44', Rule::unique('storages', 'color')->ignore($this->storage['id'])],
            ]);
            $this->storage->update($data);
            $this->emit('dataAdded', ['dataId' => 'item-id-'.$this->storage->id]);
            $this->alert('success', __('Data updated successfully'));
            $this->reset('name', 'storage', 'color');
        }else{
            $data =  $this->validate([
                'name' => ['required', 'min:2', 'max:44', Rule::unique('storages', 'name')],
                'color' => ['required', 'min:2', 'max:44', Rule::unique('storages', 'color')],
            ]);
            $data = Storage::create(['user_id' => auth()->id(), 'name'=> $data['name'], 'color' => $data['color']]);
            $this->emit('dataAdded', ['dataId' => 'item-id-'.$data->id]);
            $this->alert('success', __('Data saved successfully'));
            $this->reset('name', 'color');
        }
    }
    public function loadData(Storage $storage)
    {
        $this->reset('name', 'color');
        $this->storage = $storage;
        $this->name = $storage->name;
        $this->color = $storage->color;
        $this->emit('openEditModal');
    }

    public function getDataProperty()
    {
        return Storage::where('user_id', auth()->id())->where('name', 'like', '%'.$this->search.'%')->Paginate($this->itemPerPage);
    }

    public function render()
    {
        $items = $this->data;
        $incomes = Income::where('user_id', auth()->id())->get();
        $expenses = Expense::where('user_id', auth()->id())->get();
        return view('livewire.expense.storage-component', compact('items', 'incomes', 'expenses'));
    }
    public function deleteSingle(Storage $storage)
    {
        $storage->delete();
        $this->alert('success', __('Data deleted successfully'));
    }

}
