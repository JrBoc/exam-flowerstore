<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $price;
    public $quantity;
    public $description;
    public $photo;

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'description' => 'nullable|string',
        'photo' => 'required|image',
    ];

    protected $validationAttributes = [
        'name' => 'product name',
    ];

    public function render()
    {
        return view('livewire.product.create');
    }

    public function store()
    {
        $data = $this->validate();

        $data['photo'] = $this->photo->store('images/products', 'public');
        $data['created_by'] = current_user()->id;

        try {
            Product::create($data);
        } catch (\Illuminate\Database\QueryException $e) {
            $this->clearAndCloseModal();
            $this->emitUp('refresh', [
                'message' => [
                    'type' => 'error',
                    'message' => $e->getMessage(),
                ]
            ]);

            return;
        }

        $this->emitUp('refresh', [
            'message' => [
                'type' => 'success',
                'message' => 'Product successfully created.'
            ]
        ]);

        $this->clearAndCloseModal();
    }

    public function clearAndCloseModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->emit('clearFileInput');
        $this->emit('closeModal');
    }
}
