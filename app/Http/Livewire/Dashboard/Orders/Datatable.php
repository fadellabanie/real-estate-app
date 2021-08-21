<?php

namespace App\Http\Livewire\Dashboard\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $data_id;
    public $city_id = 'all';
    public $contract_type_id = 'all';
    public $realestate_type_id = 'all';
    public $count = 20;
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';

    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }
        return $this->sortBy = $field;
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirm($id)
    {
        $this->emit('openDeleteModal'); // Open model to using to jquery

        $this->data_id = $id;
    }

    public function destroy()
    {
        $row = Order::findOrFail($this->data_id);
        $row->delete();

        $this->emit('closeDeleteModal'); // Close model to using to jquery
    }
    public function active($id)
    {
        Order::whereId($id)->update(['is_active' => true]);

        session()->flash('alert', __('Active Successfully.'),'fhggfhfgh');
    }



    public function render()
    {

        return view('livewire.dashboard.orders.datatable', [
            'orders' => Order::with('user', 'city', 'contractType', 'realestateType')

                ->when($this->city_id != 'all', function ($q) {
                    $q->where('city_id', $this->city_id);
                })->when($this->contract_type_id != 'all', function ($q) {
                    $q->where('contract_type_id', $this->contract_type_id);
                })->when($this->realestate_type_id != 'all', function ($q) {
                    $q->where('realestate_type_id', $this->realestate_type_id);
                })

                ->search('name', $this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->count),
        ]);
    }
}