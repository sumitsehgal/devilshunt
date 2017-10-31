@extends('layouts.front')
@section('content')

<div class="banner-sec">
    <div class="about-banner">
        <h1>Publish Media</h1>
    </div>
</div>

<div class="publish-section">

	<h3>List of Published Media</h3>
	<div class="row">
		<div class="col-md-3">
			Media
		</div>
		<div class="col-md-2">
			Title
		</div>
		<div class="col-md-2">
			Description
		</div>
		<div class="col-md-2">
			Category
		</div>
		<div class="col-md-3">
			Action
		</div>
	</div>
	@if(isset($medias) && $medias->count() > 0)
		@foreach($medias as $media)
			<div class="row">
				<div class="col-md-3">
					{{$media->thumbnail}}
				</div>
				<div class="col-md-2">
					{{$media->title}}
				</div>
				<div class="col-md-2">
					{{$media->description}}
				</div>
				<div class="col-md-2">
					{{$media->category->name}}
				</div>
				<div class="col-md-3">
					Action
				</div>
			</div>
		@endforeach
	@else
		<div class="row">
			<div class="col-md-12">
				No records Found.
			</div>
		</div>
	@endif
</div>


@endsection