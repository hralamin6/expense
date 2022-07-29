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
    <div class="flex justify-between gap-4 mb-2">
        <div class="flex text-sm gap-1">
            <a href="{{route('home')}}" class="text-blue-500 dark:text-blue-400">Subjects</a>
            <span class="text-gray-500 dark:text-gray-200">/</span>
            <a href="{{route('chapter', $subject)}}" class="text-blue-500 dark:text-blue-400">Chapters</a>
            <span class="text-gray-500 dark:text-gray-200">/</span>
            <span class="text-gray-500 dark:text-gray-300">Notes</span>
        </div>
    </div>

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
    <div x-cloak x-show="add"  x-on:click.stop class="w-full absolute inset-0 inline-flex items-center justify-center z-50 flex space-x-2 text-gray-500 text-sm mt-5 font-bold"
         x-transition:enter.scale.60
         x-transition:leave.scale.40
    >
        <input x-ref="input" id="input" wire:model.lazy="name" type="text" class="dark:bg-gray-600 dark:placeholder-gray-300 w-full bg-gray-300 text-gray-500 h-8 rounded-xl border-none text-sm" autofocus placeholder="Type your query…">
        @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        <button wire:click.prevent="saveData" class="cursor-pointer"><x-h-o-plus-circle class="w-8 text-gray-600 dark:text-gray-200"/></button>
        <a href="" class="cursor-pointer" @click.prevent="add=false"><x-h-o-x class="w-8 text-gray-600 dark:text-gray-200"/></a>

    </div>

    <div class="container p-3 mx-auto">
            <h1 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl pb-2 dark:text-white">{{$subject->name}}</h1>
        <center><button @click.prevent="add=!add; $nextTick(() => $refs.input.focus());" x-on:click.stop><x-h-o-plus-circle class="h-8 text-gray-600 dark:text-gray-200"/></button></center>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @forelse($items as $i => $item)

                    <div class="group flex gap-3 bg-white border justify-between dark:border-gray-600 dark:bg-darkSidebar px-4 py-2 rounded-md">
                        <a href="{{route('description', ['subject'=>$subject, 'chapter'=>$chapter, 'note'=>$item])}}" class="flex gap-2">
                            <div class="rounded-md bg-blue-100 dark:bg-darkBg px-4 py-3 text-white">
                                <center> <x-h-o-information-circle class="h-8 md:h-10 text-purple-500 dark:text-purple-200"/></center>
                            </div>
                            <div class="flex flex-col gap-2 text-sm text-gray-500 font-semibold dark:text-gray-200">
                                <p class="font-bold text-center text-gray-800 capitalize lg:text-lg dark:text-white">{{$item->name}}</p>
                            </div>
                        </a>

                        <div class="flex flex-col justify-between invisible group-hover:visible">
{{--                            <button wire:click.prevent="loadData({{$item->id}})"><x-h-o-pencil class="h-5 text-purple-500 dark:text-purple-200"/></button>--}}
                            <a data-turbolinks="false" href="{{route('edit.note', ['subject'=>$subject, 'chapter'=>$chapter, 'note'=>$item])}}"><x-h-o-pencil-alt class="h-5 text-purple-500 dark:text-purple-200"/></a>
                            <button @click.prevent="$dispatch('open-delete-modal', { title: 'Do you want to delete!', text: 'You can not revert it', icon: 'error', eventName: 'deleteSingle', model: {{$item->id}} })">
                                <x-h-o-x class="h-5 text-red-500 dark:text-pink-200"/>
                            </button>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
</div>
