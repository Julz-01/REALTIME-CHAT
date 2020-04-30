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
                            <div class="col-md-12 text-center">
                         @if(Auth::user()->userprofile) 
                         <img src="{{Auth::user()->userprofile->thumbnail}}" class="figure-img img-fluid rounded" style="max-height:100px;">
                         @else
                         <p>No profile Image</p>
                         @endif 
                         
                         <p><strong>{{Auth::user()->name}}</strong></p>  
                         <a href="/upload">upload user image</a>
                            </div>
                         </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
