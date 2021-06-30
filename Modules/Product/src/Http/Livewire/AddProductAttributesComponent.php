<?php

namespace Topdot\Product\Http\Livewire;

use Livewire\Component;

use Topdot\Product\Contracts\Product;
use Topdot\Product\Models\Attribute;
use Topdot\Product\Models\AttributeValue;

class AddProductAttributesComponent extends Component
{
    protected $listeners = [
        'editProductAttribute' => 'edit'
    ];

    public Product $product;

    public $attribute;
    public $attributeValues;

    public function mount($product)
    {
        $this->product = $product;
        $this->attribute = null;
        $this->attributeValues = [];

    }

    public function render()
    {
        return view('product::livewire.add-product-attributes-component');
    }

    public function submit()
    {
        $this->validate([
            'attribute' => 'required|exists:attributes,id',
            'attributeValues' => 'required|array',
            'attributeValues.*' => 'required|exists:attribute_values,id',
        ]);

        $pivotValues = array_fill(0,count($this->attributeValues),['attribute_id'=>$this->attribute]);
        $pivotValues = array_combine($this->attributeValues,$pivotValues);

        $this->product->attributes()->wherePivot('attribute_id',$this->attribute)->sync($this->attribute);
        $this->product->attributeValues()->wherePivot('attribute_id',$this->attribute)->sync($pivotValues);

        $this->attribute = null;
        $this->attributeValues = [];

        $this->emit('alert-success','Attribute Added');
        $this->emit('attributes-updated');
    }

    public function edit(Attribute $attribute)
    {
        $this->attribute = $attribute->id;
        $this->attributeValues = $this->product->attributeValueIds();
    }

    public function attributes()
    {
        return Attribute::select('id','name')->get();
    }

    public function attributeValues()
    {
        if ( !$this->attribute ){
            return [];
        }

        return AttributeValue::select('id','name')->where('attribute_id',$this->attribute)->get();
    }
}
