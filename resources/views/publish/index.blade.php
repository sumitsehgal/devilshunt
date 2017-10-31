@extends('layouts.front')
@section('content')

<div class="banner-sec">
    <div class="about-banner">
        <h1>Publish Media</h1>
    </div>
</div>

<div class="publish-section">

	{!! Form::open(['url' => 'publish-store','files'=>true]) !!}

		{{ Form::token() }}

		 <!-- Upload Media  -->
	    <div class="form-group">
	    	{{ Form::label('media', 'Upload Media:') }}
	    	<a href="javascript:void(0);" id="browseButton">Select file</a>
	    	<div id="myProgress">
			  <div id="myBar"></div>
			</div>
			{{ Form::hidden('media',old('media',@$media->media),['id'=>'media-hidden']) }}
			{{ Form::hidden('media_type',old('media_type',@$media->media_type),['id'=>'media-type-hidden']) }}
			
			@if(old('media',@$media->media)) 
				Added
			@endif
	    </div>

	    <!-- Category  Thumbnail -->
        <div class="form-group">
            {{ Form::label('image', 'Thumbnail:') }}
            {{ Form::file('image',  ['class'=>'form-control imgpicker', 'onchange'=>'readURL(this)','data-selector'=>'#imgpicker']) }}

            {{ Form::hidden('thumbnail',@$media->thumbnail) }}

        </div>
        @if(isset($media) && isset($media->thumbnail) && $media->thumbnail != "")
	        <div class="form-group">
	            <img src="{{ '/uploads/'.$media->thumbnail }}" width="150" height="165" id="imgpicker" />
	        </div>
        @endif

        <!-- Media Title -->
	    <div class="form-group">
	    	{{ Form::label('title', 'Title:') }}
	    	{{ Form::text('title',old('title', @$media->title),['class'=>'form-control']) }}
	    </div>
	     <!-- Address form input -->
	    <div class="form-group">
	        {{ Form::label('description', 'Description:') }}
	    	{{ Form::textarea('description',old('description',@$media->description),['class'=>'form-control']) }}
	    </div>
		<!-- Media Title -->
	    <div class="form-group">
	    	{{ Form::label('meta_keywords', 'Meta:') }}
	    	{{ Form::text('meta_keywords',old('meta_keywords', @$media->meta_keywords),['class'=>'form-control']) }}
	    </div>
	    <div class="form-group">
            {{ Form::label('category_id', 'Category:') }}
            {{ Form::select('category_id', $categories,old('category_id',@$media->category_id),['class'=>'form-control']) }}
        </div>
         <div class="form-group">
            {{ Form::label('media_target', 'Scope:') }}
            {{ Form::select('media_target', config('enum.target_type'),old('media_target',@$media->media_target),['class'=>'form-control']) }}
        </div>

	    <!-- Submit -->
	    <div class="form-group">
	        <input type="submit" value="Save" class="btn btn-primary" id="media-submit-btn" />
	    </div>

	{!! Form::close() !!}

</div>


@endsection