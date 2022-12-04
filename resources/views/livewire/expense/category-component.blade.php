<div class="container mx-auto grid" x-data="{add: false}" x-init="
$wire.on('dataAdded', (e) => { add = false});
$wire.on('openEditModal', (e) => { add = true; $nextTick(() => $refs.input.focus());})
"
     @open-delete-modal.window="
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
    <div x-cloak
         x-show="add"
         x-transition:enter="transition ease-in-out duration-150"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in-out duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    ></div>

        <div class="container p-3 mx-auto">
            <h1 class="text-3xl pb-3 font-semibold capitalize text-center text-gray-800 capitalize lg:text-4xl dark:text-white">all category</h1>
            <center><button @click.prevent="add=!add; $nextTick(() => $refs.input.focus());" x-on:click.stop><x-h-o-plus-circle class="h-8 text-gray-600 dark:text-gray-200"/></button></center>

<div class="container py-4 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 capitalize">
                @forelse($items as $i => $item)
                   <div style="border-color:{{$item->color}};" class="flex items-center group justify-between max-w-2xl p-4 mx-auto border border-green-500 cursor-pointer rounded-xl">
                        <div class=" justify-between invisible group-hover:visible">
                       <button wire:click.prevent="loadData({{$item->id}})"><x-h-o-pencil class="h-5 text-purple-500 dark:text-purple-200"/></button>
{{--                        <button @click.prevent="$dispatch('open-delete-modal', { title: 'Do you want to delete!', text: 'You can not revert it', icon: 'error', eventName: 'deleteSingle', model: {{$item->id}} })">
                           <x-h-o-x class="h-5 text-red-500 dark:text-pink-200"/>
                       </button>
 --}}                   </div>

                <div class="flex items-center">
                    <svg style="color:{{$item->color}};" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600 sm:h-9 sm:w-9" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>

                    <div class="flex flex-col items-center mx-5 space-y-1">
                        <h2 class="text-lg font-medium text-gray-700 sm:text-2xl dark:text-gray-200">{{ $item->name }}</h2>
                    </div>
                </div>

                <h2 style="color:{{$item->color}};" class="text-2xl font-semibold text-green-600 sm:text-3xl">{{ $expenses->where('category_id', $item->id)->pluck('amount')->sum() }} <span class="text-base font-medium"></span></h2>
            </div>
                @empty
                @endforelse
            </div>
        </div>

    <div x-cloak x-show="add"  x-on:click.stop class="w-full absolute inset-0 inline-flex items-center justify-center z-50 flex space-x-2 text-gray-500 text-sm mt-5 font-bold"
         x-transition:enter.scale.60
         x-transition:leave.scale.40
    >
        <input x-ref="input" id="input" wire:model.lazy="name" type="text" class="dark:bg-gray-600 dark:placeholder-gray-300 w-full bg-gray-300 text-gray-500 h-8 rounded-xl border-none text-sm" autofocus placeholder="type category">
        @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        <input wire:model.lazy="color" type="color" class="dark:bg-gray-600 dark:placeholder-gray-300 w-full bg-gray-300 text-gray-500 h-8 rounded-xl border-none text-sm" autofocus placeholder="type colour">
        @error('color')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        <button wire:click.prevent="saveData" class="cursor-pointer"><x-h-o-plus-circle class="w-8 text-gray-800 dark:text-gray-200"/></button>
        <a href="" class="cursor-pointer" @click.prevent="add=false"><x-h-o-x class="w-8 text-gray-800 dark:text-gray-200"/></a>

    </div>
</div>
