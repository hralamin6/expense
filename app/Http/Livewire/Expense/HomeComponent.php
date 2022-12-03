<?php

namespace App\Http\Livewire\Expense;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Category;
use App\Models\Source;
use App\Models\Storage;
use Illuminate\Validation\Rule;


class HomeComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $subject, $name, $source_id, $storage_id, $amount, $date, $category_id;
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
        public function dataReset()
    {
            $this->reset('name', 'storage_id', 'source_id', 'date', 'amount', 'category_id');
    }

    public function saveData()
    {
           $data = $this->validate([
                'name' => ['required', 'min:2', 'max:44'],
                'storage_id' => ['required'],
                'date' => ['required'],
                'amount' => ['numeric', 'required'],
            ]);
           if ($this->source_id!=null) {
        $storage = Storage::find($this->storage_id);
        $storage->increment('amount', $this->amount);
            $data = Income::create(['user_id' => auth()->id(), 'name'=> $data['name'], 'storage_id'=> $data['storage_id'], 'source_id'=> $this->source_id, 'date'=> $data['date'], 'amount'=> $data['amount']]);
                        $this->emit('dataAdded', ['dataId' => 'item-id-'.$data->id]);
            $this->alert('success', __('Income saved successfully'));
            $this->reset('name', 'storage_id', 'source_id', 'date', 'amount');
           }elseif ($this->category_id!=null) {
        $storage = Storage::find($this->storage_id);
        $storage->decrement('amount', $this->amount);
            $data = Expense::create(['user_id' => auth()->id(), 'name'=> $data['name'], 'storage_id'=> $data['storage_id'], 'category_id'=> $this->category_id, 'date'=> $data['date'], 'amount'=> $data['amount']]);
                        $this->emit('dataAdded', ['dataId' => 'item-id-'.$data->id]);
            $this->alert('success', __('Expense saved successfully'));
            $this->reset('name', 'storage_id', 'source_id', 'date', 'amount');

           }else{
                        $this->alert('error', __('enter source or category'));
           }

    }

    public function render()
    {
     $categories = Category::where('status', 'active')->get();
     $sources = Source::where('status', 'active')->get();
     $storages = Storage::where('status', 'active')->get();
     $income = Income::pluck('amount')->sum();
     $expense = Expense::pluck('amount')->sum();
     $balance = $income-$expense;
        return view('livewire.expense.home-component', compact('expense', 'income', 'balance', 'sources', 'storages', 'categories'));
    }
}
