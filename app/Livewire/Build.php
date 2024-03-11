<?php

namespace App\Livewire;

use PDF;
use App\Models\Cart;
use Livewire\Component;

class Build extends Component
{
    public $Product = NULL;
    
    public $Sizes = NULL;
    public $Colors = NULL;
    public $Specifications = NULL;
    
    public $SelectedItem = NULL;
    
    public $SelectedSize = NULL;
    public $SelectedColor = NULL;
    public $SelectedSpecification = NULL;
    
    public function mount($Product)
    {
        $this->Product = $Product;
        $this->SetData();
    }
    
    public function render()
    {
        return view('Client.layouts.build');
    }
    
    public function ChangeSelectedSize($val)
    {
        $this->SetData($val);
    }
    public function ChangeSelectedColor($val)
    {
        $this->SetData($this->SelectedSize,$val);
    }
    
    public function ChangeSpecification($val)
    {
        $this->SelectedSpecification = $val;
        $this->SetData($this->SelectedSize,$this->SelectedColor,$val);
    }
    
    
    
    public function AddToCart()
    {
        Cart::insert([
            'client_id' => client_id(),
            'product_id' => $this->Product->id,
            'color_id' => $this->SelectedColor,
            'item_id' => $this->SelectedSpecification,
            'quantity' => 1,
        ]);
    }

    public function SetData($size_id = NULL,$color_id = NULL,$specification_id = NULL)
    {
        $this->SelectedItem = $this->Product->Items
            ->when($size_id, function ($query) use($size_id) {
                return $query->where('size_id', $size_id);
            })
            ->when($color_id, function ($query) use($color_id) {
                return $query->where('color_id', $color_id);
            })
            ->when($specification_id, function ($query) use($specification_id) {
                return $query->where('id', $specification_id);
            })
            ->first();
            
            
        $this->SelectedSize = $this->SelectedItem->size_id;
        $this->SelectedColor = $this->SelectedItem->color_id;
        $this->SelectedSpecification = $this->SelectedItem->id;
        
        
        $this->Sizes = $this->Product->Items->unique('size_id');
        $this->Colors = $this->Product->Items->where('size_id',$this->SelectedSize)->unique('color_id');
        $this->Specifications = $this->Product->Items->where('size_id',$this->SelectedSize)->where('color_id',$this->SelectedColor);
    }
}
