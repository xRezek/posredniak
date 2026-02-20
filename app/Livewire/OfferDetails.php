<?php

namespace App\Livewire;

use App\Models\Offer;
use Livewire\Component;
use Livewire\Attributes\On;


class OfferDetails extends Component
{
    public $offer = null;

    public function mount()
    {
        // $this->offer = Offer::with(['user', 'category', 'placeOfWork', 'typeOfWork'])->first();
    }

    #[On('offerSelected')]
    public function loadOfferDetails(int $id)
    {
        $this->offer = Offer::with(['user', 'category', 'placeOfWork', 'typeOfWork'])->find($id);
    }

    public function render()
    {
        return view('livewire.offer-details');
    }
}
