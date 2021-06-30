<?php


namespace Topdot\Product\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Topdot\Core\Contracts\Repositories\CanFilterRecords;
use Topdot\Product\Models\Attribute;
use Topdot\Product\Models\AttributeValue;

class AttributeValueRepository implements CanFilterRecords
{
    public function get(Request $request, $paginate = 50, $sortOrder = 'Asc', $orderBy = 'id')
    {
        $query = AttributeValue::query();

        if ($request->search) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        if ( $request->attribute_id ){
            $query->where('attribute_id',$request->attribute_id);
        }

        $query->orderBy($orderBy, $sortOrder);

        return false !== $paginate ? $query->paginate($paginate) : $query->get();
    }

    public function store(Attribute $attribute, Request $request)
    {
        $attribute = $attribute->values()->create([
            'name' => $request->name
        ]);

        return $attribute;
    }

    public function update(AttributeValue $attribute, Request $request)
    {
        $attribute->update([
            'name' => $request->name
        ]);

        return $attribute;
    }

    public function delete(AttributeValue $attributeValue)
    {
        DB::transaction(function () use ($attributeValue) {
            $attributeValue->products()->sync([]);
            $attributeValue->delete();
        });
    }
}
