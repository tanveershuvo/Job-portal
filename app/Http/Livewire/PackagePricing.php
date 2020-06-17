<?php

namespace App\Http\Livewire;

use App\Pricing;
use Livewire\Component;

class PackagePricing extends Component
{
    public $packagePrices;
    public function render()
    {
        $this->packagePrices = Pricing::all();
        return view('livewire.package-pricing');
    }
}
