<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Offer;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class OfferList extends Component
{
    use WithPagination;

    public $keyword;
    public $location;

    public function render()
    {
        $offers = Offer::with(['user', 'category', 'placeOfWork', 'typeOfWork'])
            ->whereLike('title', '%' . $this->keyword . '%')
            ->whereLike('localization', '%' . $this->location . '%')
            ->paginate(10);
        // dd($offers);

        return view('livewire.offer-list', [
            'offers' => $offers
        ]);
    }

    public function mount($keyword, $location)
    {
        $this->keyword = $keyword;
        $this->location = $location;
    }

    #[On('filtersUpdated')]
    public function applyFilters(string $keyword, string $location): void
    {
        $this->keyword = $keyword;
        $this->location = $location;
        $this->resetPage(); // wróć do strony 1 po zmianie filtrów
    }
}
