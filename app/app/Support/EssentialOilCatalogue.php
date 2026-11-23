<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class EssentialOilCatalogue
{
    public function all(): Collection
    {
        return collect(json_decode(file_get_contents(resource_path('data/oli-essenziali.json')), true, flags: JSON_THROW_ON_ERROR))
            ->map(function (array $oil): array {
                foreach (['olio', 'profumo', 'descrizione', 'consiglio_uso', 'avvertenza', 'pittogrammi', 'frasi_H'] as $field) {
                    $oil[$field] = localized_text($oil[$field]);
                }

                return $oil;
            });
    }

    public function search(string $query): Collection
    {
        $query = trim($query);

        return $this->all()->filter(fn (array $oil) => $query === '' || Str::contains(
            Str::lower($oil['olio'].' '.$oil['nome_latino'].' '.$oil['profumo']),
            Str::lower($query),
        ));
    }
}
