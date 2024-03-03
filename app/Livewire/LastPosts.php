<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class LastPosts extends Component
{
    #[Computed]
    public function posts()
    {
        // @todo: thea/markdown-blog add new query
        $posts = DB::table('posts as p')
            ->select(
                'p.id',
                'p.title',
                'p.slug',
                'p.date',
                'p.content',
                'c.title as category_title',
                'c.slug as category_slug',
            )
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->orderBy('date', 'desc')
            ->get();

        $posts->each(function ($post) {
            $date = new Carbon($post->date);
            $post->date = $date->format('LLL');
            $post->rawDate = $date->format('Y-m-d');
            $post->authors = DB::table('post_author as pa')
                ->select('a.name', 'a.slug')
                ->join('authors as a', 'pa.author_id', '=', 'a.id')
                ->where('pa.post_id', $post->id)
                ->get();
        });

        return $posts;
    }

    public function render()
    {
        return view('livewire.last-posts');
    }
}
