<?php

namespace App\Http\Livewire;

use App\Models\Subject;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class HomeComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $subject, $name;
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
        if ($this->subject){
            $data = $this->validate([
                'name' => ['required', 'min:2', 'max:44', Rule::unique('subjects', 'name')->ignore($this->subject['id'])],
            ]);
            $this->subject->update($data);
            $this->emit('dataAdded', ['dataId' => 'item-id-'.$this->subject->id]);
            $this->alert('success', __('Data updated successfully'));
            $this->reset('name', 'subject');
        }else{
            $data =  $this->validate([
                'name' => ['required', 'min:2', 'max:44', Rule::unique('subjects', 'name')],
            ]);
            $data = Subject::create(['user_id' => auth()->id(), 'name'=> $data['name']]);
            $this->emit('dataAdded', ['dataId' => 'item-id-'.$data->id]);
            $this->alert('success', __('Data saved successfully'));
            $this->reset('name');
        }
    }
    public function loadData(Subject $subject)
    {
        $this->reset('name');
        $this->subject = $subject;
        $this->name = $subject->name;
        $this->emit('openEditModal');
    }

    public function getDataProperty()
    {
        return Subject::where('user_id', auth()->id())->where('name', 'like', '%'.$this->search.'%')->Paginate($this->itemPerPage);
    }

    public function render()
    {
        $items = $this->data;
        return view('livewire.home-component', compact('items'));
    }
    public function deleteSingle(Subject $subject)
    {
        $subject->delete();
        $this->alert('success', __('Data deleted successfully'));
    }

}
