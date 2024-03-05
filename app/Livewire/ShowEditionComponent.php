<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\GetPostsFromEditionQuery;
use App\Domain\ValueObjects\Edition;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ShowEditionComponent extends Component
{
    #[Locked]
    public Edition $edition;

    private GetPostsFromEditionQuery $getPostsFromEditionQuery;

    public function boot(GetPostsFromEditionQuery $getPostsFromEditionQuery): void
    {
        $this->getPostsFromEditionQuery = $getPostsFromEditionQuery;
    }

    #[Computed]
    public function posts(): Collection
    {
        return $this->getPostsFromEditionQuery->get($this->edition);
    }
}