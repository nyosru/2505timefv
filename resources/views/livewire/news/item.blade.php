<div>
    <h2 class="text-2xl font-bold mb-2">{{ $news->title }}</h2>
    <div class="text-gray-500 mb-4">{{ $news->date->format('d.m.Y') }}</div>
    @if($news->short_text)
        <div class="mb-2 font-semibold">{{ $news->short_text }}</div>
    @endif
    <div>{!! nl2br(e($news->full_text)) !!}</div>
    <div class="mt-4">
        <a href="{{ route('news') }}" class="text-blue-600 hover:underline">&larr; К списку новостей</a>
    </div>
</div>
