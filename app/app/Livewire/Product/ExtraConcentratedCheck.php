<?php

namespace App\Livewire\Product;

use Livewire\Component;

class ExtraConcentratedCheck extends Component {

    /**
     * Property: Whether the extra concentrated option is selected
     */
    public bool $extraConcentrated = false;

    /**
     * Lifecycle hook: Render the component
     */
    public function render() {
        return view('livewire.product.extra-concentrated-check');
    }

    /**
     * Event: Handle changes to the extra concentrated option
     */
    public function updatedExtraConcentrated(bool $value) {
        $this->dispatch('extraConcentratedUpdated', $value);
    }
}
