<?php

namespace App\Http\Controllers\Frontend;

use Topdot\Cms\Models\Page;

class PageController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function __invoke($page=null)
    {   
        if ( !$page ){
            $page = 'homepage';
        }

        $page = Page::where('slug',$page)->active()->firstOrFail();

        $this->setPlaceholders($page,$this->getPlaceholders($page->html));

        return view('frontend.pages.index',compact('page'));

    }

    public function setPlaceholders(Page $page, $placeholders = [])
    {
        foreach ($placeholders as $placeholder) {
            $viewPath = 'frontend.placeholders.'. strtolower($placeholder);
            if ( !view()->exists($viewPath) ){
                continue;
            }

            $page->setPlaceholder("[[{$placeholder}-Placeholder]]", view($viewPath,compact('page'))->render() );
        }
    }

    public function getPlaceholders($content)
    {
        $placeholders = [];
        $count = preg_match_all("(\[\[(.*)-Placeholder\]\])",$content,$placeholders);
        return $count>0 ? array_reverse($placeholders)[0] : [];
    }
}
