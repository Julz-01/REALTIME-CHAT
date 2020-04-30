@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/create/category" class="btn btn-block btn-success mt-2">Add Category</a>
                        </div>
                        <div class="col-md-6">
                            <a href="/create/subcategory" class="btn btn-block btn-primary mt-2">Add Sub-Category</a>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-6">
                            <a href="/show/category" class="btn btn-block mt-2 btn-outline-success">Show Categories</a>
                        </div>
                        <div class="col-md-6">
                            <a href="/create/domain" class="btn mt-2 btn-block btn-primary">Add Domain</a>
                        </div>
                    </div>

                    <display-component :domains = "{{$domains}}" :categories="{{$categories}}" :subcategories="{{$subcategories}}"></display-component>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
