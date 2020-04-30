@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Enter Category 
                    <a href="/home" class="btn btn-primary btn-sm float-right">back</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                         <form action="/store/category" method="POST">
                     <div class="row">
                        <div class="col-md-8">
                                @csrf
                                <input class="form-control" name="categoryname">
                                @error('categoryname')
                                <div><small class="text-danger">{{$message}}</small></div>
                                @enderror
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-block btn-success">Add Category</button>
                        </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
