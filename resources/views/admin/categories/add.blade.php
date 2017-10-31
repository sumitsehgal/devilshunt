@extends('layouts.admin')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1> Categories </h1>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <header>
                    <h5>@if(isset($id) &&  $id != "") Edit @else Add @endif </h5>
                    <div class="toolbar">
                        <div class="btn-group">
                        	<a href="{{ URL::to('categories')}}" class="btn btn-default btn-sm">
                                <i class="icon-user"></i>
                            </a>
                            <a href="#sortableTable" data-toggle="collapse" class="btn btn-default btn-sm accordion-toggle minimize-box">
                                <i class="icon-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                </header>
                <div id="sortableTable" class="body collapse in">
                @if(isset($id) &&  $id != "")
                	{!! Form::open(['url' => 'categories/'.$id,'method' => 'put','files'=>true]) !!}
                @else
                	{!! Form::open(['url' => 'categories','files'=>true]) !!}
                @endif
                		{{ Form::token() }}
					    <!-- First  input -->
					    <div class="form-group">
					    	{{ Form::label('name', 'Category Name:') }}
					    	{{ Form::text('name',old('name', @$category->name),['class'=>'form-control']) }}
					    </div>
					     <!-- Address form input -->
					    <div class="form-group">
					        {{ Form::label('description', 'Description:') }}
					    	{{ Form::textarea('description',old('description',@$category->description),['class'=>'form-control']) }}
					    </div>
					    <!-- Category  input -->
					    <div class="form-group">
					        {{ Form::label('status', 'Status:') }}
					        {{ Form::select('status', config('enum.status'),old('status',@$category->status),['class'=>'form-control']) }}
					    </div>
                        <!-- Category  Thumbnail -->
                        <div class="form-group">
                            {{ Form::label('image', 'Category Image:') }}
                            {{ Form::file('image',  ['class'=>'form-control imgpicker', 'onchange'=>'readURL(this)','data-selector'=>'#imgpicker']) }}

                            {{ Form::hidden('filehidden',@$category->file) }}

                        </div>
                        @if(isset($category) && isset($category->file) && $category->file != "")
                        <div class="form-group">
                            <img src="{{ '/uploads/'.$category->file }}" width="150" height="165" id="imgpicker" />
                        </div>
                        @endif
					    <!-- Submit -->
					    <div class="form-group">
					        <input type="submit" value="Save" class="btn btn-primary" />
					    </div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection