<?php

namespace App\Repositories;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Topdot\Core\Contracts\Repositories\CanFilterRecords;

class TestimonialRepository implements CanFilterRecords
{

    public function get(Request $request, $paginate = 50, $sortOrder = 'Asc', $orderBy = 'id')
    {
        $query = Testimonial::query();

        if ( $request->search ){
            $query->where('name','LIKE',"%{$request->search}%");
            $query->where('description','LIKE',"%{$request->search}%");
        }

        $query->orderBy($orderBy, $sortOrder);

        return $paginate !=false ? $query->paginate($paginate) : $query->get();
    }

    public function store(Request $request)
    {
        $testimonial = Testimonial::create([
            'name' => $request->name,
            'title' => $request->title,
            // 'rating' => $request->rating,
            'description' => $request->description
        ]);
        

        // if ( $testimonial instanceof Testimonial ){
        //     $testimonial->addMediaFromRequest('image')->toMediaCollection('image');
        // }

        return $testimonial;
    }


    public function update(Request $request, Testimonial $testimonial)
    {
        $testimonial->update([
            'name' => $request->name,
            'title' => $request->title,
            // 'rating' => $request->rating,
            'description' => $request->description
        ]);
        

        // if ( $testimonial instanceof Testimonial && $request->hasFile('image') ){
        //     $testimonial->addMediaFromRequest('image')->toMediaCollection('image');
        // }

        return $testimonial;
    }
}
