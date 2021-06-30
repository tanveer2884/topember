<?php 

namespace Topdot\Product;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Topdot\Product\Contracts\CreateProductRequest;
use Topdot\Product\Contracts\Product;
use Topdot\Product\Contracts\ProductRepository;
use Topdot\Product\Contracts\UpdateProductRequest;
use Topdot\Product\Http\Controllers\ProductController;
use Topdot\Product\Http\Livewire\AddEditAttributeValueComponent;
use Topdot\Product\Http\Livewire\AddProductAttributesComponent;
use Topdot\Product\Http\Livewire\AttributeTableComponent;
use Topdot\Product\Http\Livewire\AttributeValueTableComponent;
use Topdot\Product\Http\Livewire\ProductAttributesTableComponent;
use Topdot\Product\Http\Livewire\TableComponent;

class ProductServiceProvider extends ServiceProvider
{
    public $routeFilePath = '/routes';
    public $publishedViewPath = '/views/admin/product';
    public $configPath = '/config/product.php';

    public function boot()
    {
        $this->setUpConfig();
        $this->setUpClasses();
        $this->setUpRoutes();
        $this->setUpViews();

        if ( $this->app->runningInConsole() ){
            $this->publishAssets();
        }

        Livewire::component('product::table-component',TableComponent::class);
        Livewire::component('product::attribute-table-component',AttributeTableComponent::class);
        Livewire::component('product::attribute-value-table-component',AttributeValueTableComponent::class);
        Livewire::component('product::add-edit-attribute-value-component',AddEditAttributeValueComponent::class);
        Livewire::component('product::add-product-attributes-component',AddProductAttributesComponent::class);
        Livewire::component('product::product-attributes-table-component',ProductAttributesTableComponent::class);
    }

    private function setUpClasses()
    {
        $this->app->bind(
            Product::class,
            config('product.classes.product')
        );

        $this->app->bind(
            ProductRepository::class,
            config('product.classes.prodctRepository')
        );

        $this->app->bind(
            CreateProductRequest::class,
            config('product.classes.createRequest')
        );

        $this->app->bind(
            UpdateProductRequest::class,
            config('product.classes.updateRequest')
        );
    }

    private function setUpRoutes()
    {
        Route::mixin(new ProductRoutes);

        $this->app->bind('productRoutes',function(){
            return new ProductRoutes;
        });
    }

    private function setUpViews()
    {
        $this->loadViewsFrom([
            resource_path($this->publishedViewPath),
            __DIR__.('/resources/views')
        ],'product');
    }

    private function setUpConfig()
    {
        $this->mergeConfigFrom( __DIR__.$this->configPath, 'product');
    }

    private function publishAssets()
    {
        $this->publishes([
            __DIR__.'/resources/views' => resource_path($this->publishedViewPath),
        ],'views');

        $this->publishes([
            __DIR__.'/routes' => base_path($this->routeFilePath),
        ],'routes');

        $this->publishes([
            __DIR__.$this->configPath => base_path( $this->configPath ),
        ],'config');

        $this->publishes([
            __DIR__.'/database/migrations' => database_path( 'migrations' ),
        ],'migrations');
    }
}