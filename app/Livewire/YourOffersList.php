<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use App\Models\Offer;
use App\Models\Category;
use App\Models\PlaceOfWork;
use App\Models\TypeOfContract;
use Illuminate\Support\Facades\Auth;

class YourOffersList extends Component
{
    use WithPagination;

    public $editingOfferId = null;

    #[Validate('required|string|max:255')]
    public $title = '';

    #[Validate('required|numeric')]
    public $pay = '';

    #[Validate('required|string|max:255')]
    public $company_name = '';

    #[Validate('required|string|max:255')]
    public $localization = '';

    #[Validate('required|string|max:255')]
    public $contact = '';

    #[Validate('required|string')]
    public $description = '';

    #[Validate('boolean')]
    public $experience_required = false;

    #[Validate('required|integer|exists:categories,id')]
    public $category_id = '';

    #[Validate('required|integer|exists:types_of_contract,id')]
    public $type_of_contract_id = '';

    #[Validate('required|integer|exists:places_of_work,id')]
    public $place_of_work_id = '';

    public function render()
    {
        return view('livewire.your-offers-list', [
            'offers' => $this->getOffers(),
            'categories' => $this->getCategories(),
            'typesOfWork' => $this->getTypesOfWork(),
            'placesOfWork' => $this->getPlacesOfWork(),
        ]);
    }

    private function getOffers()
    {
        return Offer::with(['user', 'category', 'placeOfWork', 'typeOfWork'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(3);
    }

    private function getCategories()
    {
        return Category::all();
    }

    private function getTypesOfWork()
    {
        return TypeOfContract::all();
    }

    private function getPlacesOfWork()
    {
        return PlaceOfWork::all();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->dispatch('open-offer-modal');
    }

    public function openEditModal(int $id)
    {
        $offer = Offer::findOrFail($id);

        $this->editingOfferId = $offer->id;
        $this->title = $offer->title;
        $this->pay = $offer->pay;
        $this->company_name = $offer->company_name;
        $this->localization = $offer->localization;
        $this->contact = $offer->contact;
        $this->description = $offer->description;
        $this->experience_required = (bool) $offer->experience_required;
        $this->category_id = $offer->category_id;
        $this->type_of_contract_id = $offer->type_of_contract_id;
        $this->place_of_work_id = $offer->place_of_work_id;

        $this->dispatch('open-offer-modal');
    }

    public function saveOffer()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'pay' => $this->pay,
            'company_name' => $this->company_name,
            'localization' => $this->localization,
            'contact' => $this->contact,
            'description' => $this->description,
            'experience_required' => $this->experience_required,
            'category_id' => $this->category_id,
            'type_of_contract_id' => $this->type_of_contract_id,
            'place_of_work_id' => $this->place_of_work_id,
            'user_id' => Auth::id(),
        ];

        if ($this->editingOfferId) {
            Offer::findOrFail($this->editingOfferId)->update($data);
        } else {
            Offer::create($data);
        }

        $this->resetForm();
        $this->dispatch('toast', message: 'Oferta została zapisana.', type: 'success');
        $this->js("\$flux.modal('offer-modal').close()");
    }

    public function deleteOffer(int $offerId)
    {
        $offer = Offer::findOrFail($offerId);

        if ($offer->user_id !== Auth::id()) {
            $this->dispatch('toast', message: 'Nie masz uprawnień.', type: 'error');
            return;
        }

        $offer->delete();
        $this->dispatch('toast', message: 'Oferta została usunięta.', type: 'success');
    }

    private function resetForm()
    {
        $this->editingOfferId = null;
        $this->title = '';
        $this->pay = '';
        $this->company_name = '';
        $this->localization = '';
        $this->contact = '';
        $this->description = '';
        $this->experience_required = false;
        $this->category_id = '';
        $this->type_of_contract_id = '';
        $this->place_of_work_id = '';
        $this->resetValidation();
    }

    public function messages()
    {
        return [
            'title.required' => 'Tytuł jest wymagany.',
            'title.string' => 'Tytuł musi być tekstem.',
            'title.max' => 'Tytuł nie może być dłuższy niż 255 znaków.',
            'pay.required' => 'Wynagrodzenie jest wymagane.',
            'pay.numeric' => 'Wynagrodzenie musi być liczbą.',
            'company_name.required' => 'Nazwa firmy jest wymagana.',
            'company_name.string' => 'Nazwa firmy musi być tekstem.',
            'company_name.max' => 'Nazwa firmy nie może być dłuższa niż 255 znaków.',
            'localization.required' => 'Lokalizacja jest wymagana.',
            'localization.string' => 'Lokalizacja musi być tekstem.',
            'localization.max' => 'Lokalizacja nie może być dłuższa niż 255 znaków.',
            'contact.required' => 'Kontakt jest wymagany.',
            'contact.string' => 'Kontakt musi być tekstem.',
            'contact.max' => 'Kontakt nie może być dłuższy niż 255 znaków.',
            'description.required' => 'Opis jest wymagany.',
            'description.string' => 'Opis musi być tekstem.',
            'category_id.required' => 'Kategoria jest wymagana.',
            'category_id.integer' => 'Kategoria musi być liczbą.',
            'category_id.exists' => 'Wybrana kategoria jest nieprawidłowa.',
            'type_of_contract_id.required' => 'Rodzaj umowy jest wymagany.',
            'type_of_contract_id.integer' => 'Rodzaj umowy musi być liczbą.',
            'type_of_contract_id.exists' => 'Wybrany rodzaj umowy jest nieprawidłowy.',
            'place_of_work_id.required' => 'Miejsce pracy jest wymagane.',
            'place_of_work_id.integer' => 'Miejsce pracy musi być liczbą.',
            'place_of_work_id.exists' => 'Wybrane miejsce pracy jest nieprawidłowe.',
        ];
    }
}