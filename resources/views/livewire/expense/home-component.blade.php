<div class="container mx-auto grid" x-data="{ income: @entangle('income_chart').defer, expense: @entangle('expense_chart').defer, balance: @entangle('balance_chart').defer, isOpen: false, isIncome: true}" x-init="
$wire.on('dataAdded', (e) => {isOpen = false});
$wire.on('openEditModal', (e) => { add = true; $nextTick(() => $refs.input.focus());});
const barConfig = {
  type: 'bar',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [
      {
        label: 'Income',
        backgroundColor: 'green',
        // borderColor: window.chartColors.red,
        borderWidth: 1,
        data: [income[0], income[1], income[2], income[3], income[4], income[5], income[6], income[7], income[7], income[9], income[10], income[11] ]
      },
      {
        label: 'Expense',
        backgroundColor: 'red',
        // borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: [expense[0], expense[1], expense[2], expense[3], expense[4], expense[5], expense[6], expense[7], expense[7], expense[9], expense[10], expense[11] ],
       },
      {
        label: 'Balance',
        backgroundColor: 'blue',
        // borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: [balance[0], balance[1], balance[2], balance[3], balance[4], balance[5], balance[6], balance[7], balance[7], balance[9], balance[10], balance[11] ],
       },
    ],
  },
  options: {
    responsive: true,
    legend: {
      display: true,
    },
  },
}

const barsCtx = document.getElementById('bars')
window.myBar = new Chart(barsCtx, barConfig)

"  @open-delete-modal.window="
     model = event.detail.model
     eventName = event.detail.eventName
Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit(eventName, model )
                }
            })
">
    @include('components.total')

        <div class="bg-white dark:bg-darkSidebar shadow-xl rounded-2xl my-4 p-4 mx-auto grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-4 capitalize">

            <div @click="isOpen = true; isIncome = true" class="flex items-center justify-between max-w-2xl p-2 mx-auto border border-blue-500 cursor-pointer rounded-xl">
                <div class="flex items-center">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-600 sm:h-6 sm:w-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>

                    <div class="flex flex-col items-center mx-2 space-y-1">
                        <h2 class="text-sm font-medium text-blue-700 sm:text-lg dark:text-blue-200">add income</h2>
                    </div>
                </div>
            </div>
            <div @click="isOpen = true; isIncome = false" class="flex items-center justify-between max-w-2xl p-2 mx-auto border border-red-500 cursor-pointer rounded-xl">
                <div class="flex items-center">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-600 sm:h-6 sm:w-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
                    <div class="flex flex-col items-center mx-2 space-y-1">
                        <h2 class="text-sm font-medium text-red-700 sm:text-lg dark:text-red-200">add expense</h2>
                    </div>
                </div>
            </div>
    </div>

<div class="flex overflow-x-auto justify-center overflow-y-hidden border-b border-gray-200 whitespace-nowrap dark:border-gray-700">
    <button wire:click="$set('loadBy', 'daily')" class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center
     bg-transparent border-b-2  sm:px-4 -px-1  whitespace-nowrap focus:outline-none hover:border-gray-400
{{ $loadBy=='daily'?'text-blue-600 border-blue-500 dark:border-blue-400 dark:text-blue-300':'text-gray-700 border-transparent dark:text-white' }}
     ">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
        </svg>

        <span class="mx-1 text-sm sm:text-base">
            Daily
        </span>
    </button>


     <button wire:click="$set('loadBy', 'monthly')" class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center
     bg-transparent border-b-2  sm:px-4 -px-1  whitespace-nowrap focus:outline-none hover:border-gray-400
{{ $loadBy=='monthly'?'text-blue-600 border-blue-500 dark:border-blue-400 dark:text-blue-300':'text-gray-700 border-transparent dark:text-white' }}
     ">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
        </svg>

        <span class="mx-1 text-sm sm:text-base">
            Monthly
        </span>
    </button>


    <button wire:click="$set('loadBy', 'yearly')" class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center
     bg-transparent border-b-2  sm:px-4 -px-1  whitespace-nowrap focus:outline-none hover:border-gray-400
{{ $loadBy=='yearly'?'text-blue-600 border-blue-500 dark:border-blue-400 dark:text-blue-300':'text-gray-700 border-transparent dark:text-white' }}
     ">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
        </svg>

        <span class="mx-1 text-sm sm:text-base">
            Yearly
        </span>
    </button>

<button wire:click="$set('loadBy', 'all')" class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center
     bg-transparent border-b-2  sm:px-4 -px-1  whitespace-nowrap focus:outline-none hover:border-gray-400
{{ $loadBy=='all'?'text-blue-600 border-blue-500 dark:border-blue-400 dark:text-blue-300':'text-gray-700 border-transparent dark:text-white' }}
     ">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
        </svg>

        <span class="mx-1 text-sm sm:text-base">
            All
        </span>
    </button>
</div>

    <div class="mx-auto grid grid-cols-2 md:grid-cols-3 justify-between lg:grid-cols-5 gap-2 mt-2">
                <div class="rounded-md shadow-sm">
                    <input wire:model.debounce.1000ms="itemPerPage" type="number" class="w-24 p-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-300 dark:bg-gray-700" />
                </div>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input type="date" max="2014-02" wire:model="searchByDate"  class="p-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-300 dark:bg-gray-700"/>
                    </div>
                    <div class="mt-1 rounded-md shadow-sm">
                            <select wire:model.lazy="searchBySourceId" class="p-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:border-blue-300">
                                <option value="">Select source</option>
                                @foreach($sources as $i => $source)
                                <option value="{{ $source->id }}">{{ $source->name }}</option>
                                @endforeach()
                            </select>
                     </div>
                    <div class="mt-1 rounded-md shadow-sm">
                            <select wire:model.lazy="searchByStorageId" class="p-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:border-blue-300">
                                <option value="">Select storage</option>
                                @foreach($storages as $i => $storage)
                                <option value="{{ $storage->id }}">{{ $storage->name }}</option>
                                @endforeach()
                            </select>
                     </div>
                    <div class="mt-1 rounded-md shadow-sm">
                            <select wire:model.lazy="searchByCategoryId" class="p-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:border-blue-300">
                                <option value="">Select category</option>
                                @foreach($categories as $i => $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach()
                            </select>
                     </div>

            </div>
        <div class="flex flex-row gap-4 justify-center mt-2">
            <span class="text-green-600 dark:text-green-300">Income {{ $sumOfIncome }}</span>
            <span class="text-red-600 dark:text-red-300">Expense {{ $sumOfExpense }}</span>
            <span class="text-blue-600 dark:text-blue-300">Balance {{ $sumOfBalance }}</span>
        </div>



    @include('components.income-table')
    @include('components.expense-table')
    @include('components.form')


<div class="flex overflow-x-auto justify-center overflow-y-hidden border-b border-gray-200 whitespace-nowrap dark:border-gray-700">
     <button wire:click="$set('chart_year', '2022')" class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center
     bg-transparent border-b-2  sm:px-4 -px-1  whitespace-nowrap focus:outline-none hover:border-gray-400
{{ $chart_year=='2022'?'text-blue-600 border-blue-500 dark:border-blue-400 dark:text-blue-300':'text-gray-700 border-transparent dark:text-white' }}
     ">
        <span class="mx-1 text-sm sm:text-base">
            2022
        </span>
    </button>


    <button wire:click="$set('chart_year', '2023')" class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center
     bg-transparent border-b-2  sm:px-4 -px-1  whitespace-nowrap focus:outline-none hover:border-gray-400
{{ $chart_year=='2023'?'text-blue-600 border-blue-500 dark:border-blue-400 dark:text-blue-300':'text-gray-700 border-transparent dark:text-white' }}
     ">        <span class="mx-1 text-sm sm:text-base">
            2023
        </span>
    </button>

<button wire:click="$set('chart_year', '2024')" class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center
     bg-transparent border-b-2  sm:px-4 -px-1  whitespace-nowrap focus:outline-none hover:border-gray-400
{{ $chart_year=='2024'?'text-blue-600 border-blue-500 dark:border-blue-400 dark:text-blue-300':'text-gray-700 border-transparent dark:text-white' }} "> <span class="mx-1 text-sm sm:text-base">
            2024
        </span>
    </button>
</div>

{{--           <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Charts
            </h2>

            <div class="grid gap-6 mb-8 md:grid-cols-2">
              <!-- Doughnut/Pie chart -->

              <!-- Bars chart -->
              <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  Bars
                </h4>
<div>
  <canvas id="myChart"></canvas>
</div>
              </div>
            </div>
          </div>
 --}}
 <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  Bars
                </h4>
                <canvas id="bars"></canvas>
              </div>
            </div>
            </div>
{{-- @push('js')
<script>
        window.addEventListener('alpine:init', function () {
            var income = @this.income_chart;
            var expense = @this.expense_chart;
            var balance = @this.balance_chart;
    const barConfig = {
  type: 'bar',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [
      {
        label: 'Income',
        backgroundColor: 'green',
        // borderColor: window.chartColors.red,
        borderWidth: 1,
        data: [income[0], income[1], income[2], income[3], income[4], income[5], income[6], income[7], income[7], income[9], income[10], income[11] ]
      },
      {
        label: 'Expense',
        backgroundColor: 'red',
        // borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: [expense[0], expense[1], expense[2], expense[3], expense[4], expense[5], expense[6], expense[7], expense[7], expense[9], expense[10], expense[11] ],
       },
      {
        label: 'Balance',
        backgroundColor: 'blue',
        // borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: [balance[0], balance[1], balance[2], balance[3], balance[4], balance[5], balance[6], balance[7], balance[7], balance[9], balance[10], balance[11] ],
       },
    ],
  },
  options: {
    responsive: true,
    legend: {
      display: true,
    },
  },
}
const barsCtx = document.getElementById('bars')
window.myBar = new Chart(barsCtx, barConfig)
})
</script>
@endpush
 --}}
