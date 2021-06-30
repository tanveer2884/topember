<?php


namespace Topdot\Product\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Topdot\Product\Models\Attribute;
use Topdot\Core\Contracts\Repositories\CanFilterRecords;
use Topdot\Product\Models\AttributeValue;

class AttributeRepository implements CanFilterRecords
{
    public function get(Request $request, $paginate = 50, $sortOrder = 'Asc', $orderBy = 'id')
    {
        $query = Attribute::query();

        if ($request->search) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        if ($request->active) {
            $query->active();
        }

        $query->orderBy($orderBy, $sortOrder);

        return false !== $paginate ? $query->paginate($paginate) : $query->get();
    }

    public function store(Request $request)
    {
        $attribute = Attribute::create([
            'name' => $request->name,
            // 'position' => $request->position
        ]);

        return $attribute;
    }

    public function update(Attribute $attribute, Request $request)
    {
        $attribute->update([
            'name' => $request->name,
            // 'position' => $request->position,
        ]);

        return $attribute;
    }

    public function delete(Attribute $attribute)
    {
        DB::transaction(function () use ($attribute) {

            $attribute->values->each(function($key, AttributeValue $attributeValue){
                $attributeValue->products()->sync([]);
                $attributeValue->delete();
            });

            $attribute->products()->sync([]);
            $attribute->delete();
        });
    }
}
