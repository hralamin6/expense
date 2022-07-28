<?php

namespace App\Http\Livewire;

use App\Models\Note;
use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class NoteComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $note, $chapter, $subject, $name;
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

    public function mount(Subject $subject, Chapter $chapter)
    {
        $this->subject = $subject;
        $this->chapter = $chapter;
    }
    public function saveData()
    {
        if ($this->note){
            $data = $this->validate([
                'name' => ['required', 'min:2', 'max:333', Rule::unique('notes', 'name')->ignore($this->note['id'])],
            ]);
            $this->note->update($data);
            $this->emit('dataAdded', ['dataId' => 'item-id-'.$this->note->id]);
            $this->alert('success', __('Data updated successfully'));
            $this->reset('name', 'note');
        }else{
            $data =  $this->validate([
                'name' => ['required', 'min:2', 'max:333', Rule::unique('notes', 'name')],
            ]);
            $data = Note::create(['chapter_id' => $this->chapter->id, 'name'=> $data['name']]);
            $this->emit('dataAdded', ['dataId' => 'item-id-'.$data->id]);
            $this->alert('success', __('Data saved successfully'));
            $this->reset('name');
        }
    }
    public function loadData(Note $note)
    {
        $this->reset('name');
        $this->note = $note;
        $this->name = $note->name;
        $this->emit('openEditModal');
    }

    public function getDataProperty()
    {
        return Note::where('chapter_id',$this->chapter->id)->where('name', 'like', '%'.$this->search.'%')->Paginate($this->itemPerPage);
    }

    public function render()
    {
        $items = $this->data;
        return view('livewire.note-component', compact('items'));
    }
    public function deleteSingle(Note $note)
    {
        $note->delete();
        $this->alert('success', __('Data deleted successfully'));
    }
}
