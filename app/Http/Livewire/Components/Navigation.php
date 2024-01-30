<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Lunar\Models\Collection;

class Navigation extends Component
{
    /**
     * The search term for the search input.
     *
     * @var string
     */
    public $term = null;

    /**
     * {@inheritDoc}
     */
    protected $queryString = [
        'term',
    ];

    /**
     * Return the collections in a tree.
     */
    public function getCollectionsProperty(): \Illuminate\Database\Eloquent\Collection
    {
        return Collection::with(['defaultUrl'])->get()->toTree();
    }

    public function render()
    {
        return view('livewire.components.navigation');
    }
}
