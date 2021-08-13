<?php

namespace Topdot\Cms\Models;

use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\File;
use Topdot\Core\Contracts\HasStatus;
use Topdot\Core\Traits\WithUniqueId;
use LaraEditor\App\Contracts\Editable;
use Illuminate\Database\Eloquent\Model;
use LaraEditor\App\Traits\EditableTrait;
use LaravelJsonColumn\Traits\JsonColumn;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model implements HasMedia, Editable, HasStatus
{
    use HasFactory,
        JsonColumn,
        WithUniqueId,
        InteractsWithMedia,
        HasSlug,
        EditableTrait;

    protected $guarded = [];

    protected $casts = [
        'extra_data' => 'array'
    ];
    
    const STANDARD_HOMEPAGE_PAGE_ID = 1001;

    public function scopeStandard(Builder $builder)
    {
        return $builder->where('is_standard', true);
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where('is_active', true);
    }

    public function isStandard()
    {
        return $this->is_standard;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function markActive($active = true)
    {
        $this->update([
            'is_active' => $active
        ]);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return is_numeric($value) ? self::query()->where('id', $value)->firstOrFail() : $this->where('slug', $value)->orWhere('title', $value)->firstOrFail();
    }

    public function getSlugOptions(): SlugOptions
    {
        $options = SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
        if ( $this->slug && strlen($this->slug) >= 0 ){
            $options->preventOverwrite();
        }

        return $options;
    }

    public function getEditorLoadUrl(): ?string
    {
        return route(config('cms.routeNamePrefix').'page-customize.index',$this->id);    
    }

    public function getEditorStoreUrl(): string
    {
        return route(config('cms.routeNamePrefix').'page-customize.store', $this->id);
    }

    public function getEditorTemplatesUrl(): ?string
    {
        return route(config('cms.routeNamePrefix').'page-customize.templates', $this);
    }

    public static function getPage($pageId, $title = null, $isStandard = true)
    {
        $page = Page::find($pageId);
        if ($page) {
            return $page;
        }

        return Page::create([
            'id' => $pageId,
            'title' => $title,
            'is_standard' => $isStandard
        ]);
    }

    public function getTemplatesFromPath($templatesPath=null)
    {
        if ( !$templatesPath ){
            return [];
        }

        $templates = [];
        foreach (File::allFiles($templatesPath) as $fileInfo) {
            $templates [] = [
                'category' => 'Templates',
                'id' => $fileInfo->getFilename(),
                'label' => Str::title(str_replace([".blade.php","-"]," ",$fileInfo->getBasename())),
                'content' => $fileInfo->getContents()
            ];
        }

        return $templates;
    }

    public function getBlocksFromPath($blocksPath=null)
    {
        if ( !$blocksPath ){
            return [];
        }
        
        $templates = [];
        foreach (File::allFiles($blocksPath) as $fileInfo) {
            $templates [] = [
                'category' => 'Blocks',
                'id' => $fileInfo->getFilename(),
                'label' => Str::title(str_replace([".blade.php","-"]," ",$fileInfo->getBasename())),
                'content' => view()->file($fileInfo->getPathname())->render()
            ];
        }

        return $templates;
    }
}
