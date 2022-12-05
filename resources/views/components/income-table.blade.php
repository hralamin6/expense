<div class="rounded-xl mt-4 overflow-x-auto" x-data="{openTable: $persist(true)}">
                        <aside class="border dark:border-gray-600 row-span-4 bg-white dark:bg-darkSidebar">
                            <div class="flex capitalize justify-between gap-3 bg-white border dark:border-gray-600 dark:bg-darkSidebar px-4 py-2">
                                <p class="text-green-600 text-center dark:text-green-200">Income Table</p>
                                <p class="text-gray-600 text-center dark:text-gray-200">{{ $loadBy=='daily'?date('d-l, F-Y', strtotime($searchByDate)) : ($loadBy=='monthly'?date('F-Y', strtotime($searchByDate)):($loadBy=='yearly'?date('Y', strtotime($searchByDate)):'All')) }}</p>
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
                                        <x-field :OB="$orderBy" :OD="$orderDirection" :field="'date'"> date </x-field>
                                        <x-field :OB="$orderBy"> action </x-field>
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
                                                <td class="px-4 py-3 text-sm">
                       <button @click.prevent="$dispatch('open-delete-modal', { title: 'Do you want to delete!', text: 'You can not revert it', icon: 'error', eventName: 'deleteIncome', model: {{$income->id}} })">
                           <x-h-o-x class="h-5 text-red-500 dark:text-pink-200"/>
                       </button>
                                                </td>
                                            </tr>
                                            @endforeach


                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
        <div class="items-center text-center mx-auto my-8">
            {{ $incomes->links() }}
        </div>
                        </aside>
                    </div>
