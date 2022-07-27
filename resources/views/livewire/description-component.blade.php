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
            <a href="{{route('note', ['subject' => $subject, 'chapter' => $chapter])}}" class="text-blue-500 dark:text-blue-400">Notes</a>
            <span class="text-gray-500 dark:text-gray-200">/</span>
            <span class="text-gray-500 dark:text-gray-300">Details</span>
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
    <center><button wire:click.prevent="generate_pdf"><x-h-o-plus-circle class="h-8 text-gray-600 dark:text-gray-200"/></button></center>

    <div class="container p-3 mx-auto">
            <h1 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl pb-2 dark:text-white">{{$item->name}}</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                {!!$item->description!!}
            </div>
        </div>
</div>
