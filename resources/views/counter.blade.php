@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <chat :messages={{$messages}}></chat>
            </div>
        </div>
    </div>
</div>
@endsection
