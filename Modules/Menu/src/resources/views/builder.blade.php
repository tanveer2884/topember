@extends('layouts.master')

@section('page')
<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Build Menu <u><strong>({{ $menu->name }})</strong></u></h4>
                    <div class="actions">
                        <a href="{{ route(config('cms.routeNamePrefix').'menus.index') }}" class="btn btn-primary">
                            Back to List
                        </a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div>
                            <livewire:menu::create-edit-menu-item :menu="$menu" />
                        </div>
                        <hr>
                        <div>
                            <livewire:menu::menu-builder :menu="$menu" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
