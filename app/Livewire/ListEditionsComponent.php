<?php

namespace App\Livewire;

use App\Models\Edition;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ListEditionsComponent extends Component
{
    #[Computed]
    public function editions(): Collection
    {
        return Edition::limit(500)->orderBy('updated_at', 'desc')->get();
    }
}