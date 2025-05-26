<?php

namespace App\Livewire\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $perPage = 10;

    public function render()
    {
        $news = News::orderByDesc('date')->paginate($this->perPage);

        return view('livewire.news.listing', [
            'news' => $news,
        ]);
//        return view('livewire.news.listing');
    }
}
