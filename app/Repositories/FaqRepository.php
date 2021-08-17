<?php

namespace App\Repositories;

use App\Models\Faq;
use Illuminate\Http\Request;
use Topdot\Core\Contracts\Repositories\CanFilterRecords;
use Topdot\Core\Models\TempMedia;

class FaqRepository implements CanFilterRecords
{
    public function get(Request $request, $paginate = 50, $sortOrder = 'Asc', $orderBy = 'id')
    {
        $query = Faq::query();

        if ( $request->search ){
            $query->where('question','LIKE',"%{$request->search}%");
            $query->orWhere('answer','LIKE',"%{$request->search}%");
        }

        $query->orderBy($orderBy,$sortOrder);

        return $paginate !==false ? $query->paginate($paginate) : $query->get();
    }

    public function store(Request $request)
    {
        $faq = Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order??1,
            'type' => Faq::TYPE_HOMEPAGE,
        ]);

        if ( !$request->has('image') ){
            return $faq;
        }

        /**
         * @var TempMedia $tempImage
         */
        foreach (TempMedia::find($request->get('image',[])) as $tempImage) {
            $tempImage->getFirstMedia('default')->move($faq, 'image');
        }

        return $faq;
    }

    public function update(Request $request, Faq $faq)
    {
        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order??1,
            'type' => Faq::TYPE_HOMEPAGE,
        ]);

        if ( !$request->has('image') ){
            return $faq;
        }

        $faq->clearMediaCollection('image');
        
        /**
         * @var TempMedia $tempImage
         */
        foreach (TempMedia::find($request->get('image',[])) as $tempImage) {
            $tempImage->getFirstMedia('default')->move($faq, 'image');
        }

        return $faq;
    }

    public function delete(Faq $faq)
    {
        return $faq->delete();
    }
}
