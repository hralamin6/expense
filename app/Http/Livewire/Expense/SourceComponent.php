<?php

namespace App\Http\Livewire\Expense;

use App\Models\Source;
use App\Models\Income;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class SourceComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $source,$color, $name;
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
        if ($this->source){
            $data = $this->validate([
                'name' => ['required', 'min:2', 'max:44', Rule::unique('sources', 'name')->ignore($this->source['id'])],
                'color' => ['required', 'min:2', 'max:44', Rule::unique('sources', 'color')->ignore($this->source['id'])],
            ]);
            $this->source->update($data);
            $this->emit('dataAdded', ['dataId' => 'item-id-'.$this->source->id]);
            $this->alert('success', __('Data updated successfully'));
            $this->reset('name', 'source', 'color');
        }else{
            $data =  $this->validate([
                'name' => ['required', 'min:2', 'max:44', Rule::unique('sources', 'name')],
                'color' => ['required', 'min:2', 'max:44', Rule::unique('sources', 'color')],
            ]);
            $data = Source::create(['user_id' => auth()->id(), 'name'=> $data['name'], 'color' => $data['color']]);
            $this->emit('dataAdded', ['dataId' => 'item-id-'.$data->id]);
            $this->alert('success', __('Data saved successfully'));
            $this->reset('name', 'color');
        }
    }
    public function loadData(Source $source)
    {
        $this->reset('name', 'color');
        $this->source = $source;
        $this->name = $source->name;
        $this->color = $source->color;
        $this->emit('openEditModal');
    }

    public function getDataProperty()
    {
        return Source::where('user_id', auth()->id())->where('name', 'like', '%'.$this->search.'%')->Paginate($this->itemPerPage);
    }

    public function render()
    {
        $items = $this->data;
        $incomes = Income::where('user_id', auth()->id())->get();
        return view('livewire.expense.source-component', compact('items', 'incomes'));
    }
    public function deleteSingle(Source $source)
    {
        $source->delete();
        $this->alert('success', __('Data deleted successfully'));
    }

}
