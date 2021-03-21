@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header border-0 d-flex justify-content-between align-items-center">
                        <span>Products</span>
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#mdl_create">Create</button>
                    </div>
                    @livewire('product.table')
                </div>
            </div>
        </div>
    </div>
@endsection
