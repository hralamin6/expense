<div x-cloak x-show="isOpen"
         x-transition:enter="transition ease-in-out duration-150"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in-out duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    ></div>

    <div x-clock x-show="isOpen"
        x-transition:enter="transition duration-300 ease-out"
        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        class="fixed inset-0 z-10 overflow-y-auto"
        aria-labelledby="modal-title" role="dialog" aria-modal="true"
    >
 <div class="flex items-end z-50 justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>

                <div class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-darkSidebar sm:my-8 sm:w-full sm:max-w-sm sm:p-6 sm:align-middle">
                    <h3 class="text-lg font-medium leading-6 text-gray-800 text-center capitalize dark:text-white" id="modal-title">
                        <span x-show='isIncome'>add new income</span>
                        <span x-show='!isIncome'>add new expense</span>
                    </h3>

                    <form class="mt-4" action="#">
                          <label class="block mt-3" for="amount">
                                    @error('amount')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                            <input wire:model.lazy="amount" x-ref="input" id="input" type="text" placeholder="Enter amount" class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:border-blue-300" />
                        </label>
                        <label x-show="isIncome" class="block mt-3" for="email">
                                    @error('source_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                            <select wire:model.lazy="source_id" class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:border-blue-300">
                                <option value="">Select source</option>
                                @foreach($sources as $i => $source)
                                <option value="{{ $source->id }}">{{ $source->name }}</option>
                                @endforeach()
                            </select>
                        </label>
                            <label x-show="!isIncome" class="block mt-3" for="category_id">
                                    @error('category_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                            <select wire:model.lazy="category_id" class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:border-blue-300">
                                <option value="">Select category</option>
                                @foreach($categories as $i => $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach()
                            </select>
                        </label>
                        <label class="block mt-3" for="email">
                                    @error('storage_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                            <select wire:model.lazy="storage_id" class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:border-blue-300">
                                <option value="">Select storage</option>
                                @foreach($storages as $i => $storage)
                                <option value="{{ $storage->id }}">{{ $storage->name }}</option>
                                @endforeach()
                            </select>
                        </label>
                        <label class="block mt-3" for="name">
                                    @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                            <input wire:model.lazy="name" type="text" placeholder="details" class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:border-blue-300" />
                        </label>
                        <label class="block mt-3" for="date">
                                    @error('date')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                            <input wire:model.lazy="date" type="datetime-local" placeholder="date" class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:border-blue-300" />
                        </label>


                        <div class="mt-4 sm:flex sm:items-center sm:-mx-2">
                            <button type="button" wire:click.prevent="dataReset" @click="isOpen = false" class="w-full px-4 py-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                                Cancel
                            </button>

                            <button wire:click.prevent="saveData"  type="button" class="w-full px-4 py-2 mt-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
