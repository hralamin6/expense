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
            <span class="text-gray-500 dark:text-gray-300">Chapters</span>
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
    <center> <h1 style="color: #2563eb" class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl pb-2 dark:text-white">{{$subject->name}}</h1> </center>
    <center><a href="javascript:void(0);" onclick="printPageArea('printableArea')"><x-h-o-printer class="h-8 text-gray-600 dark:text-gray-200"/></a></center>
    <div id="printableArea">
    @forelse($items as $i => $item)
            <div class="container p-3 mx-auto">
                <center>
                    <h1 style="color: green" class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl pb-2 dark:text-white">{{$item->name}}</h1>
                </center>
                @foreach($item->notes as $j => $note)
                <div class="container p-3 mx-auto">
                    <center>
                        <h1 style="color: red" class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl pb-2 dark:text-white">{{$note->name}}</h1>
                    </center>
                    {!!$note->description!!}
                </div>
                @endforeach
            </div>
        @empty
        @endforelse
    </div>

</div>

@push('js')
    <script>
        function printPageArea(areaID){
            var printContent = document.getElementById(areaID);
            var WinPrint = window.open('', '', 'width=900,height=650');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.onload = WinPrint.print;
            // WinPrint.print();
            // WinPrint.close();
        }
    </script>
@endpush
