<?php

namespace App\Http\Livewire;

use App\Models\Note;
use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class EditNoteComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $note, $chapter, $subject, $name, $body;
    protected $queryString = [
        'page'
    ];
    public $editmode = false;
    public $selectedRows = [];
    public $selectPageRows = false;
    public $itemPerPage = 25;
    protected $listeners = ['deleteMultiple', 'deleteSingle'];

    public function mount(Subject $subject, Chapter $chapter, Note $note)
    {
        $this->subject = $subject;
        $this->chapter = $chapter;
        $this->note = $note;
        $this->name = $note->name;
        $this->body = $note->description;
    }
    public function saveData()
    {
        if ($this->note){
            $data = $this->validate([
                'name' => ['required', 'min:2', 'max:333', Rule::unique('notes', 'name')->ignore($this->note['id'])],
                'body' => ['required', 'min:2', 'max:333333'],
            ]);
            $this->note->update(['name'=> $data['name'], 'description'=> $data['body']]);
            $this->alert('success', __('Data updated successfully'));
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
        return Note::where('id',$this->note->id)->firstOrFail();
    }

    public function render()
    {
        $item = $this->data;
        return view('livewire.edit-note-component', compact('item'));
    }
    public function deleteSingle(Note $note)
    {
        $note->delete();
        $this->alert('success', __('Data deleted successfully'));
    }
}
