<?php

namespace App\Http\Livewire;

use App\Traits\FetchesUrls;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;
use Lunar\Models\Collection;

class CollectionPage extends Component
{
    use FetchesUrls,
        PerformsRedirects;

    /**
     * {@inheritDoc}
     *
     *
     * @throws \Http\Client\Exception\HttpException
     */
    public function mount(string $slug): void
    {
        $this->url = $this->fetchUrl(
            $slug,
            Collection::class,
            [
                'element.thumbnail',
                'element.products.variants.basePrices',
                'element.products.defaultUrl',
            ]
        );

        if (! $this->url) {
            abort(404);
        }
    }

    /**
     * Computed property to return the collection.
     */
    public function getCollectionProperty(): Collection
    {
        return $this->url->element;
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('livewire.collection-page');
    }
}
