<?php

namespace App\Http\Livewire;

use App\Models\Label;
use App\Models\Subject;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class HomeComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $label, $name;
    protected $queryString = [
        'page'
    ];
    public $selectedRows = [];
    public $selectPageRows = false;
    public $itemPerPage = 5;
    protected $listeners = ['deleteMultiple', 'deleteSingle'];
    public function saveData()
    {
        $data =  $this->validate([
            'name' => ['required', 'min:2', 'max:44', Rule::unique('subjects', 'name')],
        ]);
        $data = Subject::create(['user_id' => auth()->id(), 'name'=> $data['name']]);
//        $this->goToPage($this->getDataProperty()->lastPage());
        $this->emit('dataAdded', ['dataId' => 'item-id-'.$data->id]);
        $this->alert('success', __('Data saved successfully'));
        $this->reset('name');
    }


    public function getDataProperty()
    {
        return Subject::Paginate($this->itemPerPage);
    }

    public function render()
    {
        $items = $this->data;
        return view('livewire.home-component', compact('items'));
    }
}
