<?php


namespace Topdot\Category\Repositories;

use Exception;
use Illuminate\Http\Request;
use Topdot\Core\Models\TempMedia;
use Topdot\Category\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Topdot\Core\Contracts\Repositories\CanFilterRecords;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository implements CanFilterRecords
{

    /**
     * @param Request $request
     * @param int $paginate
     * @param string $sortOrder
     * @param string $orderBy
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function get(Request $request, $paginate = 50, $sortOrder = 'Asc', $orderBy = 'id')
    {
        $query = Category::query();

        if ( $request->name ){
            $query->where('name','LIKE',"%{$request->name}%");
        }

        if ( $request->active ){
            $query->active();
        }

        $query->withCount('subCategories');
        $query->orderBy($orderBy,$sortOrder);
        return $paginate == false ? $query->get() : $query->paginate($paginate);
    }

    public function getExcept(int $id)
    {
        return
            Category::query()->whereDoesntHave('parentCategory',function ($query) use($id){
                $query->where('id',$id);
            })
            ->active()
            ->where('id','<>',$id)
            ->get();
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws CategoryCreateException
     */
    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'parent_category_id' => $request->parent,
            'is_active' => $request->status,
            'is_featured' => $request->is_featured,
        ]);

        foreach (TempMedia::find($request->get('image', [])) as $tempThumbnail) {
            $tempThumbnail->getImage()->move($category, 'default');
        }

        return $category;
    }

    /**
     * @param Category $category
     * @param Request $request
     * @return bool
     * @throws CategoryUpdateException
     */
    public function update(Category $category, Request $request): bool
    {
        $category->update([
            'name' => $request->name,
            'parent_category_id' => $request->parent,
            'is_active' => $request->status,
            'is_featured' => $request->is_featured,
        ]);

        if ( $request->has('image') && TempMedia::find($request->get('image', []))){
            $category->clearMediaCollection('default');
        }
        
        foreach (TempMedia::find($request->get('image', [])) as $tempThumbnail) {
            $tempThumbnail->getImage()->move($category, 'default');
        }

        return (bool) $category;
    }

    /**
     * @param Category $category
     * @throws CategoryDeleteException
     */
    public function delete(Category $category)
    {
        return $category->delete();
    }

    public function getSingleCategory(Category $category)
    {
        return $category;
    }
}
