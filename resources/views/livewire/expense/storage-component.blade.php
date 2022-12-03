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
            <h1 class="text-3xl pb-3 font-semibold capitalize text-center text-gray-800 capitalize lg:text-4xl dark:text-white">all storage</h1>
            <center><button @click.prevent="add=!add; $nextTick(() => $refs.input.focus());" x-on:click.stop><x-h-o-plus-circle class="h-8 text-gray-600 dark:text-gray-200"/></button></center>

            <div  class="grid grid-cols-2 gap-4 md:gap-8 mt-3 xl:mt-8 xl:gap-12 md:grid-cols-3 lg:grid-cols-4">
                @forelse($items as $i => $item)
                <div style="background:{{$item->color}};" class="w-full p-3 lg:p-8 group text-center dark:bg-gray-700 hover:bg-green-300 dark:hover:bg-green-700 bg-gray-400 rounded-lg hover:shadow-2xl">
                   <div class="flex justify-between invisible group-hover:visible">
                       <button wire:click.prevent="loadData({{$item->id}})"><x-h-o-pencil class="h-5 text-purple-500 dark:text-purple-200"/></button>
                       <a href="{{route('all.chapter', $item)}}" class="cursor-pointer" ><x-h-o-eye class="h-5 text-indigo-500 dark:text-purple-200"/></a>
                       <button @click.prevent="$dispatch('open-delete-modal', { title: 'Do you want to delete!', text: 'You can not revert it', icon: 'error', eventName: 'deleteSingle', model: {{$item->id}} })">
                           <x-h-o-x class="h-5 text-red-500 dark:text-pink-200"/>
                       </button>
                   </div>
                    <a href="{{route('chapter', $item)}}" class="flex flex-col">
{{--                         <h2 class="text-5xl font-bold text-gray-800 uppercase dark:text-gray-100">
                            <center> <x-h-o-book-open class="h-16 text-gray-600 dark:text-gray-200"/></center>
                        </h2>
 --}}                        <p  class="text-lg font-semibold text-center text-gray-800 capitalize lg:text-xl dark:text-white">{{$item->name}}</p>
                    </a>
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
