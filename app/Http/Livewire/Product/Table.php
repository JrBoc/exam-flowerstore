<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $message = [];

    protected $listeners = [
        'refresh'
    ];

    public function render()
    {
        $flash_message = $this->message['message'] ?? [];

        $this->message = [];

        return view('livewire.product.table', [
            'products' => Product::latest('created_at')->paginate(5),
            'flash_message' => $flash_message,
        ]);
    }

    public function refresh($message = [])
    {
        $this->render();

        $this->message = $message;
    }
}
