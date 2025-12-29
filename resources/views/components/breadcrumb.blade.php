@props(['items' => []])

@if(count($items) > 0)
<nav class="mb-6 text-sm">
    <ol class="flex items-center gap-2 text-slate-500">
        @foreach($items as $index => $item)
            @if($index > 0)
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </li>
            @endif
            <li>
                @if(isset($item['url']))
                    <a href="{{ $item['url'] }}" class="hover:text-brand-600 transition">{{ $item['label'] }}</a>
                @else
                    <span class="text-slate-900 font-semibold">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif