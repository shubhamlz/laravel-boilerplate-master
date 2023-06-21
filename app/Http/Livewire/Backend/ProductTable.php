<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

use App\Domains\Auth\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
class ProductTable extends Component
{
    public function render()
    {
        return view('livewire.backend.product-table');
    }
}
