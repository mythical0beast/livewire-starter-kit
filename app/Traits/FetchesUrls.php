<?php

namespace App\Traits;

use Lunar\Models\Url;

trait FetchesUrls
{
    /**
     * The URL model from the slug.
     */
    public ?Url $url = null;

    /**
     * Fetch a url model.
     *
     * @param  string  $slug
     * @param  string  $type
     * @param  array  $eagerLoad
     * @return \Lunar\Models\Url|null
     */
    public function fetchUrl(string $slug, string $type, array $eagerLoad = []): ?Url
    {
        return Url::whereElementType($type)
            ->whereDefault(true)
            ->whereSlug($slug)
            ->with($eagerLoad)->first();
    }
}
