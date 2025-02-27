<nav x-cloak @click.outside="nav = false" class="md:block overflow-x-hidden overflow-y-hidden shadow-2xl bg-white inset-y-0 z-10 fixed md:relative flex-shrink-0 w-64 overflow-y-auto bg-white dark:bg-darkSidebar"
     :class="{'hidden': nav == false}">
    <div class="h-14 border-b dark:border-gray-600 flex px-4 py-2 gap-3">
        <span class="w-10 h-10 rounded-full bg-purple-600 border dark:border-gray-600 shadow-xl"></span>
        <span class="my-auto text-xl text-gray-500 font-mono dark:text-gray-300">Hranote</span>
    </div>
    <div class="h-16 border-b dark:border-gray-600 flex px-4 py-2 gap-3">
            <img class="object-cover rounded-full" src="https://www.gravatar.com/avatar/{{md5(auth()->user()->email)}}?d=mp" alt="" aria-hidden="true"/>
        <span class="my-auto font-semibold text-gray-600 font-medium dark:text-gray-300">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
    </div>
    <div class="m-2 mt-4 flex">
        <input type="search"  class="border dark:border-gray-500 dark:bg-gray-600 dark:placeholder-gray-300 text-gray-200 text-sm border-gray-300 bg-gray-100 px-2 w-48 h-9 rounded-md rounded-r-none" placeholder="Search">
        <a href="" class="border  dark:bg-gray-600 border-gray-300 dark:border-gray-500 bg-gray-100 rounded-l-none p-2 h-9 rounded-md"><x-h-o-search class="w-5 text-gray-600 dark:text-gray-200"/></a>
    </div>
    <div class="overflow-hidden h-screen scrollbar-none overflow-y-scroll scrollbar-thumb-gray-400 scrollbar-track-white  scrollbar-thin">
        <div class="capitalize">
            <a href="{{route('expense.home')}}" class="navMenuLink {{Route::is('expense.home')?'navActive':'navInactive'}}">
                <x-h-o-home class="w-5"/>
                <span class="">{{__('dashboard')}}</span>
            </a>
            <a href="{{route('expense.source')}}" class="navMenuLink {{Route::is('expense.source')?'navActive':'navInactive'}}">
                <x-h-o-home class="w-5"/>
                <span class="">{{__('source')}}</span>
            </a>
            <a href="{{route('expense.storage')}}" class="navMenuLink {{Route::is('expense.storage')?'navActive':'navInactive'}}">
                <x-h-o-home class="w-5"/>
                <span class="">{{__('storage')}}</span>
            </a>
            <a href="{{route('expense.category')}}" class="navMenuLink {{Route::is('expense.category')?'navActive':'navInactive'}}">
                <x-h-o-home class="w-5"/>
                <span class="">{{__('category')}}</span>
            </a>
            <a href="{{route('home')}}" class="navMenuLink {{Route::is('home')?'navActive':'navInactive'}}">
                <x-h-o-home class="w-5"/>
                <span class="">{{__('note')}}</span>
            </a>


        </div>
    </div>
</nav>
