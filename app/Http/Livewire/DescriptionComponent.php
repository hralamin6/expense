<?php

namespace App\Http\Livewire;

use App\Models\Note;
use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
//use niklasravnsborg\LaravelPdf\Facades\Pdf;
use niklasravnsborg\LaravelPdf\Pdf;

class DescriptionComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $note, $chapter, $subject, $name;
    protected $queryString = [
        'page'
    ];
    public $selectedRows = [];
    public $selectPageRows = false;
    public $itemPerPage = 25;
    protected $listeners = ['deleteMultiple', 'deleteSingle'];

    public function mount(Subject $subject, Chapter $chapter, Note $note)
    {
        $this->subject = $subject;
        $this->chapter = $chapter;
        $this->note = $note;
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
        return Note::where('id',$this->note->id)->firstOrFail();
    }

    public function render()
    {
        $item = $this->data;
        return view('livewire.description-component', compact('item'));
    }
    public function deleteSingle(Note $note)
    {
        $note->delete();
        $this->alert('success', __('Data deleted successfully'));
    }
    public function generate_pdf()
    {
        $data = [
            'foo' => 'bar'
        ];
        $pdf = PDF::loadView('pdf.products', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');

        return response()->streamDownload(function () {
            $products = $this->data;
            $pdf = PDF::loadView('pdf.products', compact('products'));
            return $pdf->stream('document.pdf');
        }, 'products.pdf');

    }
}
