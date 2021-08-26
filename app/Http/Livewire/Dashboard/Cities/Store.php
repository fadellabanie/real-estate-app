<?php

namespace App\Http\Livewire\Dashboard\Cities;

use App\Models\Country;
use App\Models\City;
use Livewire\Component;
use Livewire\WithFileUploads;

class Store extends Component
{
    use WithFileUploads;

    public $ar_name, $en_name;
    public $country_id, $icon, $status;
  
    protected $rules = [

        'ar_name' => 'required|min:4|max:100',
        'en_name' => 'required|min:4|max:100',
        'country_id' => 'required',
        'icon' => 'required',
        'status' => 'required',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $validatedData = $this->validate();

        $validatedData['icon'] = ($this->icon) ? uploadToPublic('cities', $validatedData['icon']) : "";
         
        City::create($validatedData);

        $this->reset();

        session()->flash('alert', __('Saved Successfully.'));
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
   
    public function render()
    {
        return view('livewire.dashboard.cities.store',[
            'countries' => Country::get(),
        ]);
    }
}