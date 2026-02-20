<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\PlaceOfWork;
use App\Models\TypeOfContract;

class FilterForm extends Component
{
    public $keyword;
    public $location;
    public $category;
    public $type_of_contract;
    public $place_of_work;
    public $company;
    public $date_posted;
    public $experience_required;



    public function render()
    {
        return view('livewire.filter-form',[
            'categories' => Category::all(),
            'typesOfWork' => TypeOfContract::all(),
            'placesOfWork' => PlaceOfWork::all(),
        ]);
    }
}
