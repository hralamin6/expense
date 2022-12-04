<div class="container mx-auto grid" x-data="{ isOpen: false, isIncome: true }" x-init="
$wire.on('dataAdded', (e) => { isOpen = false});
$wire.on('openEditModal', (e) => { add = true; $nextTick(() => $refs.input.focus());})
">
    @include('components.form')

        <div class="bg-white dark:bg-darkSidebar p-4 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 capitalize">

            <div @click="isOpen = true; isIncome = true" class="flex items-center justify-between max-w-2xl p-4 mx-auto border border-blue-500 cursor-pointer rounded-xl">
                <div class="flex items-center">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-600 sm:h-9 sm:w-9">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>

                    <div class="flex flex-col items-center mx-5 space-y-1">
                        <h2 class="text-lg font-medium text-blue-700 sm:text-2xl dark:text-blue-200">add income</h2>
                    </div>
                </div>
            </div>
            <div @click="isOpen = true; isIncome = false" class="flex items-center justify-between max-w-2xl p-4 mx-auto border border-red-500 cursor-pointer rounded-xl">
                <div class="flex items-center">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-600 sm:h-9 sm:w-9">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
                    <div class="flex flex-col items-center mx-5 space-y-1">
                        <h2 class="text-lg font-medium text-red-700 sm:text-2xl dark:text-red-200">add expense</h2>
                    </div>
                </div>
            </div>
    </div>

<div class="flex overflow-x-auto overflow-y-hidden border-b border-gray-200 whitespace-nowrap dark:border-gray-700">
    <button wire:click="$set('loadBy', 'daily')" class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center text-blue-600 bg-transparent border-b-2 border-blue-500 sm:px-4 -px-1 dark:border-blue-400 dark:text-blue-300 whitespace-nowrap focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
        </svg>

        <span class="mx-1 text-sm sm:text-base">
            Daily
        </span>
    </button>


    <button wire:click="$set('loadBy', 'monthly')" class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center bg-transparent border-b-2 sm:px-4 -px-1  whitespace-nowrap focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
        </svg>

        <span class="mx-1 text-sm sm:text-base">
            Monthly
        </span>
    </button>


    <button wire:click="$set('loadBy', 'yearly')" class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center text-blue-600 bg-transparent border-b-2 border-blue-500 sm:px-4 -px-1 dark:border-blue-400 dark:text-blue-300 whitespace-nowrap focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
        </svg>

        <span class="mx-1 text-sm sm:text-base">
            Yearly
        </span>
    </button>


</div>


    <div class="w-24 flex justify-between gap-2 mb-2">
                <div class="mt-1 rounded-md shadow-sm">
                    <input wire:model.debounce.1000ms="itemPerPage" type="number" class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-600 dark:text-gray-300 dark:focus:border-blue-300" />
                </div>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input type="date" max="2014-02" wire:model="searchByDate"  class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-300 dark:bg-gray-600"/>
                    </div>

                @error('itemPerPage')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
<div class="rounded-xl mt-4 overflow-x-auto" x-data="{openTable: $persist(true)}">
                        <aside class="border dark:border-gray-600 row-span-4 bg-white dark:bg-darkSidebar">
                            <div class="flex capitalize justify-between gap-3 bg-white border dark:border-gray-600 dark:bg-darkSidebar px-4 py-2">
                                <p class="text-gray-600 text-center dark:text-gray-200">Products Table</p>
                                <div class="flex justify-center gap-4 text-gray-500 dark:text-gray-300">
                                    <button class="" @click="openTable = !openTable">
                                        <svg x-show="openTable" xmlns="http://www.w3.org/2000/svg" class="h-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <svg x-show="!openTable" xmlns="http://www.w3.org/2000/svg" class="h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>

                                </div>
                            </div>
                            <div x-show="openTable" x-collapse>
                                <div class="mb-1 overflow-y-scroll scrollbar-none">
                                    <div class="w-full overflow-x-auto">
                                        <table class="w-full whitespace-no-wrap">
                                            <thead>
                                            <tr
                                                class="text-xs font-semibold capitalize tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-darkSidebar"
                                            >
                                        <x-field :OB="$orderBy" :OD="$orderDirection" :field="'name'"> details </x-field>
                                        <x-field :OB="$orderBy" :OD="$orderDirection" :field="'amount'"> amount </x-field>
                                        <x-field :OB="$orderBy" :OD="$orderDirection" :field="'source_id'"> source </x-field>
                                        <x-field :OB="$orderBy" :OD="$orderDirection" :field="'storage_id'"> storage </x-field>
                                        <x-field :OB="$orderBy" :OD="$orderDirection" :field="'nadame'"> date </x-field>
                                            </tr>
                                            </thead>
                                            <tbody
                                                class="bg-white divide-y text-xs dark:divide-gray-700 dark:bg-darkSidebar"
                                            >
                                            @foreach($incomes as $i=> $income)
                                            <tr class="text-gray-700 dark:text-gray-400">
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center">
                                                        <div>
                                                            <p class="font-semibold">{{ $income->name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                   {{ $income->amount }}
                                                </td>
                                                <td class="px-4 py-3 text-xs">
                        <span style="color: {{ $income->source->color }};">
                          {{ $income->source->name }}
                        </span>
                                             </td>
                                                  <td class="px-4 py-3 text-xs">
                        <span style="color: {{ $income->storage->color }};">
                          {{ $income->storage->name }}
                        </span>
                        </span>
                                               </td>
                                                <td class="px-4 py-3 text-sm">
                                                    {{ $income->date }}
                                                </td>
                                            </tr>
                                            @endforeach


                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="text-center flex justify-between bg-white border dark:border-gray-600 dark:bg-darkSidebar py-2 bg-gray-50 px-4">
                                <a href="" class="rounded-md px-2 py-1 bg-purple-600 text-sm text-white">Place New Order</a>
                                <a href="" class="rounded-md px-2 py-1 bg-indigo-600 text-sm text-white">View All Users</a>
                            </div>
                        </aside>
                    </div>


    @include('components.form')
</div>
