@props(['field' => 'id', 'OB'=>'', 'OD' => ''])
<th {{ $attributes }} wire:click.prevent="orderByDirection('{{$field}}')" class="px-4 cursor-pointer py-3 capitalize"> {{$slot}}
    <span class="text-xs text-purple-400">{{$OB==$field?'('.$OD.')':''}}</span>
</th>
