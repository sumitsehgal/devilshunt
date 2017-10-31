@extends('layouts.admin')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1> Media </h1>
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
                        	<a href="{{ URL::to('media')}}" class="btn btn-default btn-sm">
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
                	{!! Form::open(['url' => 'media/'.$id,'method' => 'put']) !!}
                @else
                	{!! Form::open(['url' => 'media']) !!}
                @endif
                		{{ Form::token() }}
					    <!-- First  input -->
					    <div class="form-group">
					    	{{ Form::label('name', 'Media Title:') }}
					    	{{ Form::text('name',old('name', @$media->name),['class'=>'form-control']) }}
					    </div>
                        <!-- Category  Thumbnail -->
                        <div class="form-group">
                            {{ Form::label('file', 'Media File:') }}
                        
                            <a href="javascript:void(0);" id="browseButton">Select files</a>
                        </div>
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