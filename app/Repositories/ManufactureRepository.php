<?php

namespace App\Repositories;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Topdot\Core\Contracts\Repositories\CanFilterRecords;
use Topdot\Core\Models\TempMedia;

class ManufactureRepository implements CanFilterRecords
{
    public function get(Request $request, $paginate = 50, $sortOrder = 'Asc', $orderBy = 'id')
    {
        $query = Manufacturer::query();

        if ( $request->search ){
            $query->where('name','LIKE',"%{$request->search}%");
        }

        $query->orderBy($orderBy,$sortOrder);

        return $paginate !==false ? $query->paginate($paginate) : $query->get();
    }

    public function store(Request $request)
    {
        $manufacture = Manufacturer::create([
            'name' => $request->name
        ]);

        if ( !$request->has('image') ){
            return $manufacture;
        }

        /**
         * @var TempMedia $tempImage
         */
        foreach (TempMedia::find($request->get('image',[])) as $tempImage) {
            $tempImage->getImage()->move($manufacture, 'image');
        }


        return $manufacture;
    }

    public function update(Request $request, Manufacturer $manufacturer)
    {
        $manufacturer->update([
            'name' => $request->name
        ]);

        if ( !$request->has('image') ){
            return $manufacturer;
        }

        $manufacturer->clearMediaCollection('image');

        /**
         * @var TempMedia $tempImage
         */
        foreach (TempMedia::find($request->get('image',[])) as $tempImage) {
            $tempImage->getImage()->move($manufacturer, 'image');
        }

        return $manufacturer;
    }

    public function delete(Manufacturer $manufacturer)
    {
        $manufacturer->products()->sync([]);
        return $manufacturer->delete();
    }
}
