@extends('layouts.master')

@section('page')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Manage Faqs
                        </h4>
                        <a href="{{ route('admin.faqs.create')  }}" class="btn btn-primary">Create Faq</a>
                    </div>
                    <div class="card-content">
                        <livewire:admin.faq.table-component/>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
