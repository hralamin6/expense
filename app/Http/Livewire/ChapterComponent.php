<?php

namespace App\Http\Livewire;

use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ChapterComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $chapter, $subject, $name;
    protected $queryString = [
        'page'
    ];
    public $selectedRows = [];
    public $selectPageRows = false;
    public $itemPerPage = 25;
    protected $listeners = ['deleteMultiple', 'deleteSingle'];

    public function mount(Subject $subject)
    {
        $this->subject = $subject;
    }
    public function saveData()
    {
        if ($this->chapter){
            $data = $this->validate([
                'name' => ['required', 'min:2', 'max:44', Rule::unique('chapters', 'name')->ignore($this->chapter['id'])],
            ]);
            $this->chapter->update($data);
            $this->emit('dataAdded', ['dataId' => 'item-id-'.$this->chapter->id]);
            $this->alert('success', __('Data updated successfully'));
            $this->reset('name', 'chapter');
        }else{
            $data =  $this->validate([
                'name' => ['required', 'min:2', 'max:44', Rule::unique('chapters', 'name')],
            ]);
            $data = Chapter::create(['subject_id' => $this->subject->id, 'name'=> $data['name']]);
            $this->emit('dataAdded', ['dataId' => 'item-id-'.$data->id]);
            $this->alert('success', __('Data saved successfully'));
            $this->reset('name');
        }
    }
    public function loadData(Chapter $chapter)
    {
        $this->reset('name');
        $this->chapter = $chapter;
        $this->name = $chapter->name;
        $this->emit('openEditModal');
    }

    public function getDataProperty()
    {
        return Chapter::where('subject_id',$this->subject->id)->Paginate($this->itemPerPage);
    }

    public function render()
    {
        $items = $this->data;
        return view('livewire.chapter-component', compact('items'));
    }
    public function deleteSingle(Chapter $chapter)
    {
        $chapter->delete();
        $this->alert('success', __('Data deleted successfully'));
    }
}
