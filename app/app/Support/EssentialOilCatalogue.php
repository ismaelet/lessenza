<?php

namespace App\Support;

use Illuminate\Support\Collection;

class EssentialOilCatalogue
{
    public function all(): Collection
    {
        return collect(json_decode(file_get_contents(resource_path('data/oli-essenziali.json')), true, flags: JSON_THROW_ON_ERROR));
    }
}
