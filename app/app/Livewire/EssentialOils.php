<?php

namespace App\Livewire;

use App\Support\EssentialOilCatalogue;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class EssentialOils extends Component
{
    #[Url(as: 'q')]
    public string $query = '';

    public function render(): View
    {
        $catalogue = app(EssentialOilCatalogue::class);

        return view('livewire.essential-oils', [
            'total' => $catalogue->all()->count(),
            'oils' => $catalogue->search($this->query),
        ]);
    }
}
