@include('components.tinymce')
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
    <center><button @click.prevent="add=!add; $nextTick(() => $refs.input.focus());" x-on:click.stop><x-h-o-plus-circle class="h-8 text-gray-600 dark:text-gray-200"/></button></center>
    <div x-cloak x-show="add"  x-on:click.stop class="w-full absolute inset-0 inline-flex items-center justify-center z-50 flex space-x-2 text-gray-500 text-sm mt-5 font-bold"
         x-transition:enter.scale.60
         x-transition:leave.scale.40
    >
        <input x-ref="input" id="input" wire:model.lazy="name" type="text" class="dark:bg-gray-600 dark:placeholder-gray-300 w-full bg-gray-300 text-gray-500 h-8 rounded-xl border-none text-sm" autofocus placeholder="Type your query…">
        @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        <button wire:click.prevent="saveData" class="cursor-pointer"><x-h-o-plus-circle class="w-8 text-gray-600 dark:text-gray-200"/></button>
        <a href="" class="cursor-pointer" @click.prevent="add=false"><x-h-o-x class="w-8 text-gray-600 dark:text-gray-200"/></a>

    </div>
    <div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pb-4">
            <label class="block mt-3">
                <span class="text-gray-700 dark:text-gray-400">{{__("Enter page name")}}</span>
                <input type="text" wire:model.lazy="name" class="form-control-tw @error('name') is-invalid @enderror form-input" placeholder="{{__("Enter page name")}}">
                @error('name')<span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror
            </label>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <label wire:ignore class="block mt-3">
                <span class="text-gray-700 dark:text-gray-400">{{__("Enter page details")}}</span>
                <textarea id="open-source-plugins"  wire:model.defer="body" class="form-control-tw @error('body') is-invalid @enderror form-input">{!! @$body !!}</textarea>
            </label>
            @error('body') <span class="text-danger text-bold"> {{$message}}</span>@enderror
        </div>

        <div class="mt-4">
                <button wire:click="saveData" type="button" class="btn btn-primary float-right">Update
                    <span wire:loading wire:target="Update" class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></span>
                </button>
        </div>
    </div>
</div>
