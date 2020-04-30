@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                         <div class="row">
                            <div class="col-md-12 text-center"> 
                         <p><strong>{{Auth::user()->name}}</strong></p>  
                         <div class="mt-2">
                             
                         </div>
                         <upload-component></upload-component>
                            </div>
                         </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
