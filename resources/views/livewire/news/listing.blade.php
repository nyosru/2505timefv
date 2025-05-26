<div>
    <h2 class="text-2xl font-bold mb-4">Новости</h2>
    <ul>
        @forelse($news as $item)
            <li class="mb-4 border-b pb-2">
                <a href="{{ route('news.show', $item->id) }}" class="text-blue-600 hover:underline">
                    <strong>{{ $item->title }}</strong>
                </a>
                <div class="text-gray-500 text-sm">{{ $item->date->format('d.m.Y') }}</div>
                @if($item->short_text)
                    <div>{{ $item->short_text }}</div>
                @endif
            </li>
        @empty
            <li>Новостей пока нет.</li>
        @endforelse
    </ul>
    <div class="mt-4">
        {{ $news->links() }}
    </div>
</div>
