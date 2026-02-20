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
        $keyword = $this->keyword;
        $location = $this->location;

        $offers = Offer::with(['user', 'category', 'placeOfWork', 'typeOfWork'])
            ->when($keyword, function($q) use ($keyword, $location) {
                $q->where(function($q) use ($keyword) {
                    $q->whereLike('title', '%' . $keyword . '%', false)
                    ->orWhereLike('description', '%' . $keyword . '%')
                    ->orWhereHas('category', fn($q) => $q->whereLike('name', '%' . $keyword . '%'));
                });
            })
            ->when($location, fn($q) => $q->whereLike('localization', '%' . $location . '%'))
            ->paginate(4);

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
    public function applyFilters(string $keyword, string $location)
    {
        $this->keyword = $keyword;
        $this->location = $location;
        $this->resetPage(); // wróć do strony 1 po zmianie filtrów
    }

    public function select(int $id)
    {
        $this->dispatch('offerSelected', id: $id);
    }
}
