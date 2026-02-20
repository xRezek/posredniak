<?php

namespace App\Livewire;

use App\Models\Offer;
use Livewire\Component;
use Livewire\Attributes\On;


class OfferDetails extends Component
{
    public $offer;
    public $keyword;
    public $location;
    
    public function render()
    {
        return view('livewire.offer-details');
    }
        
    #[On('offerSelected')]
    public function loadOfferDetails($id){

        $this->offer = Offer::with(['user', 'category', 'placeOfWork', 'typeOfWork'])->find($id);
        

    }

    public function mount($keyword, $location)
    {
        $this->keyword = $keyword;
        $this->location = $location;
        $this->offer = Offer::with(['user', 'category', 'placeOfWork', 'typeOfWork'])
            ->whereLike('title', '%' . $this->keyword . '%')
            ->whereLike('localization', '%' . $this->location . '%')
            ->first();
    }
}
