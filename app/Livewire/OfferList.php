<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Offer;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class OfferList extends Component
{
    use WithPagination;

    #[Validate('string|max:255')]
    public $keyword = '';

    #[Validate('string|max:255')]
    public $location = '';

    #[Validate('integer|exists:categories,id')]
    public $category = '';

    #[Validate('integer|exists:type_of_contracts,id')]
    public $type_of_contract = '';

    #[Validate('integer|exists:place_of_works,id')]
    public $place_of_work = '';

    #[Validate('boolean')]
    public $experience_required = '';

    #[Validate('in:asc,desc')]
    public $sort = 'desc';

    public function render()
    {
        $keyword = $this->keyword;
        $location = $this->location;
        $category = $this->category;
        $type_of_contract = $this->type_of_contract;
        $place_of_work = $this->place_of_work;
        $experience_required = $this->experience_required;
        $sort = in_array($this->sort, ['asc', 'desc']) ? $this->sort : 'desc';

        $offers = Offer::with(['user', 'category', 'placeOfWork', 'typeOfWork'])
            ->when($keyword, function($q) use ($keyword) {
                $q->where(function($q) use ($keyword) {
                    $q->whereLike('title', '%' . $keyword . '%', false)
                    ->orWhereLike('description', '%' . $keyword . '%')
                    ->orWhereHas('category', fn($q) => $q->whereLike('name', '%' . $keyword . '%'));
                });
            })
            ->when($location, fn($q) => $q->whereLike('localization', '%' . $location . '%'))
            ->when($category, fn($q) => $q->where('category_id', $category))
            ->when($type_of_contract, fn($q) => $q->where('type_of_contract_id', $type_of_contract))
            ->when($place_of_work, fn($q) => $q->where('place_of_work_id', $place_of_work))
            ->when($experience_required !== '', fn($q) => $q->where('experience_required', $experience_required))
            ->orderBy('created_at', $sort)
            ->paginate(4);

        return view('livewire.offer-list', compact('offers'));
    }

        #[On('filtersUpdated')]
        public function applyFilters($keyword, $location, $category, $type_of_contract, $place_of_work, $experience_required, $sort)
        {
            $this->keyword = $keyword;
            $this->location = $location;
            $this->category = $category;
            $this->type_of_contract = $type_of_contract;
            $this->place_of_work = $place_of_work;
            $this->experience_required = $experience_required;
            $this->sort = $sort;
            $this->resetPage();
        }

    public function select(int $id)
    {
        $this->dispatch('offerSelected', id: $id);
    }

public function mount()
    {
        $this->keyword = request('keyword', '');
        $this->location = request('location', '');
        $this->category = request('category', '');
        $this->type_of_contract = request('type', '');
        $this->place_of_work = request('mode', '');
        $this->experience_required = request('experience_required', '');
        $this->sort = request('sort', 'desc');
        
    }
}
