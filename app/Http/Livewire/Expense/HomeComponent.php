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
    public $var = [];
    public $income_chart = [];
    public $expense_chart = [];
    public $balance_chart = [];
    public $search = '';
    public $searchByDate = '';
    public $searchBySourceId = '';
    public $searchByStorageId = '';
    public $searchByCategoryId = '';
    public $loadBy = 'daily';
    public $selectPageRows = false;
    public $itemPerPage = 25;
    protected $listeners = ['deleteMultiple', 'deleteIncome', 'deleteExpense', 'searched'];
    public $orderBy = 'date';
    public $searchBy = 'id';
    public $orderDirection = 'desc';
    public function searched($data)
    {
        $this->search = $data;
    }
        public function dataReset()
    {
            $this->reset('name', 'storage_id', 'source_id', 'date', 'amount', 'category_id');
    }
    public function mount(){
                $this->searchByDate = date('Y-m-d');

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
           }elseif($this->category_id!=null) {
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
    public function orderByDirection($field)
    {
        $this->orderBy = $field;
        $this->orderDirection==='asc'? $this->orderDirection='desc': $this->orderDirection='asc';
}
    public function render()
    {
    $this->var = explode("-",$this->searchByDate);

    for ($i=0; $i < 12; $i++) {
     $this->income_chart[$i] = Income::whereYear('date', '=', $this->var[0])->whereMonth('date', '=', $i+1)->where('user_id', auth()->id())->pluck('amount')->sum();
     $this->expense_chart[$i] = Expense::whereYear('date', '=', $this->var[0])->whereMonth('date', '=', $i+1)->where('user_id', auth()->id())->pluck('amount')->sum();
     $this->balance_chart[$i] = $this->income_chart[$i]-$this->expense_chart[$i];
    }
    // dd($income_chart);

     $incomes = Income::with('source', 'storage')
     ->when($this->loadBy=='monthly', function ($query, $var) {
        return $query->whereYear('date', '=', $this->var[0])->whereMonth('date', '=', $this->var[1]);
    })->when($this->loadBy=='yearly', function ($query) {
        return $query->whereYear('date', '=', $this->searchByDate);
    })->when($this->loadBy=='daily', function ($query) {
        return $query->whereDate('date', '=', $this->searchByDate);
    })->when($this->searchBySourceId, function ($query) {
        return $query->where('source_id', $this->searchBySourceId);
    })->when($this->searchByStorageId, function ($query) {
        return $query->where('storage_id', $this->searchByStorageId);
    })->where('user_id', auth()->id())->where($this->searchBy, 'like', '%'.$this->search.'%')->orderBy($this->orderBy, $this->orderDirection)->paginate($this->itemPerPage, ['*'], 'in')->withQueryString();

     $expenses = Expense::with('category', 'storage')
     ->when($this->loadBy=='monthly', function ($query) {
        return $query->whereYear('date', '=', $this->var[0])->whereMonth('date', '=', $this->var[1]);
    })->when($this->loadBy=='yearly', function ($query) {
        return $query->whereYear('date', '=', $this->searchByDate);
    })->when($this->loadBy=='daily', function ($query) {
        return $query->whereDate('date', '=', $this->searchByDate);
    })->when($this->searchByStorageId, function ($query) {
        return $query->where('storage_id', $this->searchByStorageId);
    })->when($this->searchByCategoryId, function ($query) {
        return $query->where('category_id', $this->searchByCategoryId);
    })->where('user_id', auth()->id())->where($this->searchBy, 'like', '%'.$this->search.'%')->orderBy($this->orderBy, $this->orderDirection)->paginate($this->itemPerPage, ['*'], 'ex')->withQueryString();

        $sumOfExpense = Expense::with('category', 'storage')
     ->when($this->loadBy=='monthly', function ($query) {
        return $query->whereYear('date', '=', $this->var[0])->whereMonth('date', '=', $this->var[1]);
    })->when($this->loadBy=='yearly', function ($query) {
        return $query->whereYear('date', '=', $this->searchByDate);
    })->when($this->loadBy=='daily', function ($query) {
        return $query->whereDate('date', '=', $this->searchByDate);
    })->when($this->searchByStorageId, function ($query) {
        return $query->where('storage_id', $this->searchByStorageId);
    })->when($this->searchByCategoryId, function ($query) {
        return $query->where('category_id', $this->searchByCategoryId);
    })->where('user_id', auth()->id())->where($this->searchBy, 'like', '%'.$this->search.'%')->pluck('amount')->sum();


        $sumOfIncome = Income::with('source', 'storage')
     ->when($this->loadBy=='monthly', function ($query, $var) {
        return $query->whereYear('date', '=', $this->var[0])->whereMonth('date', '=', $this->var[1]);
    })->when($this->loadBy=='yearly', function ($query) {
        return $query->whereYear('date', '=', $this->searchByDate);
    })->when($this->loadBy=='daily', function ($query) {
        return $query->whereDate('date', '=', $this->searchByDate);
    })->when($this->searchBySourceId, function ($query) {
        return $query->where('source_id', $this->searchBySourceId);
    })->when($this->searchByStorageId, function ($query) {
        return $query->where('storage_id', $this->searchByStorageId);
    })->where('user_id', auth()->id())->pluck('amount')->sum();
        $sumOfBalance = $sumOfIncome-$sumOfExpense;

     $categories = Category::where('status', 'active')->where('user_id', auth()->id())->get();
     $sources = Source::where('status', 'active')->where('user_id', auth()->id())->get();
     $storages = Storage::where('status', 'active')->where('user_id', auth()->id())->get();
     $income = Income::where('user_id', auth()->id())->pluck('amount')->sum();
     $expense = Expense::where('user_id', auth()->id())->pluck('amount')->sum();
     $balance = $income-$expense;
     $this->emit('loadAll');
        return view('livewire.expense.home-component', compact('expense', 'income', 'balance', 'sources', 'storages', 'categories', 'incomes', 'expenses', 'sumOfIncome', 'sumOfExpense', 'sumOfBalance'));
    }
        public function deleteIncome(Income $income)
    {
        Storage::find($income->storage_id)->decrement('amount', $income->amount);
        $income->delete();
        $this->alert('success', __('Data deleted successfully'));
    }
        public function deleteExpense(Expense $expense)
    {
        Storage::find($expense->storage_id)->increment('amount', $expense->amount);
        $expense->delete();
        $this->alert('success', __('Data deleted successfully'));
    }

}
