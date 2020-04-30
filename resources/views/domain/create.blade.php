@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
	<domain-component :categories="{{$categories}}" :subcategories="{{$subcategories}}">
	</domain-component>	
	</div>
	<div class="col-md-2"></div>
		</div>
	</div>
</div>
@endsection