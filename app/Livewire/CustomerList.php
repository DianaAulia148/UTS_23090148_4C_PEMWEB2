<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer;

class CustomerList extends Component
{
    use WithPagination;

    public $sortBy = 'name';  // Default sort by 'name'
    public $sortDirection = 'asc';  // Default sort direction

    // Sort logic when clicking on column headers
    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    // Fetch customers with sorting and pagination
    public function render()
    {
        $customers = Customer::query()
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10); // Adjust number of items per page if needed

        return view('livewire.customer-list', compact('customers'));
    }
}
