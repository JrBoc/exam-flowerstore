<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $product;
    public $edit_mode = false;
    public $photo;

    protected $rules = [
        'product.name' => 'required|string|max:255',
        'product.price' => 'required|numeric|min:0',
        'product.quantity' => 'required|integer|min:0',
        'product.description' => 'nullable|string',
        'photo' => 'nullable|image',
    ];

    protected $validationAttributes = [
        'product.name' => 'product name',
    ];

    public function render()
    {
        return view('livewire.product.edit');
    }

    public function show(Product $product, $edit_mode = false)
    {
        $this->edit_mode = $edit_mode;
        $this->product = $product;

        $this->emit('openModal');
    }

    public function update()
    {
        $this->validate();

        try {
            if (!\is_null($this->photo)) {
                Storage::disk('public')->delete($this->product->photo);
                $this->product->photo = $this->photo->store('images/products', 'public');
            }

            $this->product->updated_by = current_user()->id;
            $this->product->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $this->clearAndCloseModal();
            $this->emitUp('refresh', [
                'message' => [
                    'type' => 'error',
                    'message' => $e->getMessage(),
                ]
            ]);

            return;
        } catch (\Exception $e) {
            $this->clearAndCloseModal();
            $this->emitUp('refresh', [
                'message' => [
                    'type' => 'error',
                    'message' => $e->getMessage(),
                ]
            ]);

            return;
        }

        $this->clearAndCloseModal();
        $this->emitUp('refresh', [
            'message' => [
                'type' => 'success',
                'message' => 'Product successfully updated.'
            ]
        ]);
    }

    public function delete(Product $product)
    {
        $product->delete();

        $this->emitUp('refresh', [
            'message' => [
                'type' => 'success',
                'message' => 'Product successfully deleted.'
            ]
        ]);
    }

    public function clearAndCloseModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->emit('clearFileInput');
        $this->emit('closeModal');
    }
}
