<?php

namespace Topdot\Product\Http\Livewire;

use Livewire\Component;
use Topdot\Product\Models\Attribute;
use Topdot\Product\Models\AttributeValue;
use Topdot\Product\Repositories\AttributeValueRepository;

class AddEditAttributeValueComponent extends Component
{
    protected $listeners = [
        'edit' => 'editValue'
    ];

    public Attribute $attribute;
    public AttributeValue $attributeValue;

    public $name;

    public function mount(Attribute $attribute)
    {
        $this->attributeValue = new AttributeValue();
        $this->attribute = $attribute;
        $this->name = '';
    }

    public function render()
    {
        return view('product::livewire.add-edit-attribute-value-component');
    }

    public function submit(AttributeValueRepository $attributeValueRepository)
    {
        $this->validate([
            'name' => 'required|max:191|unique:attribute_values,name'
        ]);

        try {

            if ( !$this->attributeValue->id ) {
                $attributeValueRepository->store($this->attribute, request()->merge(['name' => $this->name]));
                $this->emit('alert-success', 'Attribute Value Created Successfully');
                $this->emit('values-updated');
                $this->name = '';
                return;
            }

            $attributeValueRepository->update($this->attributeValue, request()->merge(['name' => $this->name]));
            $this->emit('alert-success', 'Attribute Value Updated Successfully');
            $this->emit('values-updated');
            $this->name ='';
            $this->attributeValue = new AttributeValue();
        } catch (\Exception $exception) {
            $this->emit('alert-danger', $exception->getMessage());
        }
    }

    public function cancel()
    {
        $this->name ='';
        $this->attributeValue = new AttributeValue();
    }

    public function editValue(AttributeValue $attributeValue)
    {
        $this->attributeValue = $attributeValue;
        $this->name = $attributeValue->name;
    }
}
