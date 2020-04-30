@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories
                    <a href="/home" class="btn btn-primary btn-sm float-right">back</a>
                </div>

                <div class="card-body">
                   @foreach($categories as $category)
                   <h2> {{$category->categoryname}}</h2>
                    @foreach($category->subcategories as $subcat)
                    <li>
                      {{$subcat->subcategoryname}}
                    </li>
                    @endforeach
                   @endforeach
                   <show-category :categories="{{$categories}}"></show-category>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
