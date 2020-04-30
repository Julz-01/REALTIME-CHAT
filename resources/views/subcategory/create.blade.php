@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Enter Sub-Category 
                    <a href="/home" class="btn btn-primary btn-sm float-right">back</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
      <form action="/store/subcategory" method="POST">     
        @csrf               
                     <div class="row">
                        <div class="col-md-12">
  <div class="form-group">
    <label for="formGroupExampleInput">Select Category</label>
    <select class="form-control" name="category_id">
        @foreach($data as $data)
        <option value="{{$data->id}}">{{$data->categoryname}}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Enter Sub Category</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" name="subcategoryname">
  </div>       
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block btn-success">Add Sub-Category</button>
                        </div>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
