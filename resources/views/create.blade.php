@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <create-component :tasks="{{$tasks}}" :users="{{$users}}"></create-component>
            </div>
        </div>
    </div>
</div>
@endsection
