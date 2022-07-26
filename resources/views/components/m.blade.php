@props(['route' => 'home'])
<a {{ $attributes }} href="{{route($route)}}" class="px-2 pb-0 rounded-md capitalize
{{Route::is($route.'*')?'text-blue-700 dark:text-blue-400':'text-gray-700 dark:text-gray-300'}}">
    {{ @$icon }}<span class="">{{ $slot }}</span>
</a>
