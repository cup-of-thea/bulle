<?php

namespace App\Livewire;

use App\Models\Edition;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ShowEditionComponent extends Component
{
    #[Locked]
    public Edition $edition;

    #[Computed]
    public function posts(): Collection
    {
        return $this->edition->posts()->orderBy('date', 'desc')->limit(500)->get();
    }
}
