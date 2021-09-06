@extends('layouts.master')

@section('page')
<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Menus</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <livewire:menu::create-edit-menu />
                        <div>
                            <livewire:menu::menu-table-component />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection