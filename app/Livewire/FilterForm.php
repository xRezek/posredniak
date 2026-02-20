<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\PlaceOfWork;
use App\Models\TypeOfContract;

class FilterForm extends Component
{
    public string $keyword = '';
    public string $location = '';
    public string $category = '';
    public string $type_of_contract = '';
    public string $place_of_work = '';
    public string $experience_required = '';
    public string $sort = 'desc';

    public function search()
    {
        $this->dispatch('filtersUpdated',
            keyword: $this->keyword,
            location: $this->location,
            category: $this->category,
            type_of_contract: $this->type_of_contract,
            place_of_work: $this->place_of_work,
            experience_required: $this->experience_required,
            sort: $this->sort,
        );
    }

    public function render()
    {
        return view('livewire.filter-form', [
            'categories' => Category::all(),
            'typesOfWork' => TypeOfContract::all(),
            'placesOfWork' => PlaceOfWork::all(),
        ]);
    }
}
