<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class YourOffersList extends Component
{
    public $offers;

    public $editingOfferId = null;
    public $title = '';
    public $pay = '';
    public $company_name = '';
    public $localization = '';
    public $contact = '';
    public $description = '';
    public $experience_required = false;

    public function render()
    {
        $this->offers = Offer::with(['user', 'category', 'placeOfWork', 'typeOfWork'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.your-offers-list');
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->dispatch('open-offer-modal');
    }

    public function openEditModal($id)
    {
        $offer = Offer::findOrFail($id);
        $this->editingOfferId      = $offer->id;
        $this->title               = $offer->title;
        $this->pay                 = $offer->pay;
        $this->company_name        = $offer->company_name;
        $this->localization        = $offer->localization;
        $this->contact             = $offer->contact;
        $this->description         = $offer->description;
        $this->experience_required = (bool) $offer->experience_required;
        $this->dispatch('open-offer-modal');
    }

    public function saveOffer()
    {
        $this->validate([
            'title'        => 'required|string|max:255',
            'pay'          => 'required|numeric',
            'company_name' => 'required|string|max:255',
            'localization' => 'required|string|max:255',
            'contact'      => 'required|string|max:255',
        ]);

        $data = [
            'title'               => $this->title,
            'pay'                 => $this->pay,
            'company_name'        => $this->company_name,
            'localization'        => $this->localization,
            'contact'             => $this->contact,
            'description'         => $this->description,
            'experience_required' => $this->experience_required,
            'user_id'             => Auth::id(),
        ];

        if ($this->editingOfferId) {
            Offer::findOrFail($this->editingOfferId)->update($data);
        } else {
            Offer::create($data);
        }

        $this->resetForm();
        $this->js("$flux.modal('offer-modal').close()");
    }

    public function deleteOffer($offerId)
    {
        $offer = Offer::findOrFail($offerId);

        if ($offer->user_id === Auth::user()->id) {
            $offer->delete();
            session()->flash('message', 'Oferta została usunięta.');
        } else {
            session()->flash('error', 'Nie masz uprawnień do usunięcia tej oferty.');
        }
    }

    private function resetForm()
    {
        $this->editingOfferId      = null;
        $this->title               = '';
        $this->pay                 = '';
        $this->company_name        = '';
        $this->localization        = '';
        $this->contact             = '';
        $this->description         = '';
        $this->experience_required = false;
        $this->resetValidation();
    }
}