@extends('layouts.admin')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1> Competition </h1>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <header>
                    <h5>@if(isset($competition->id) &&  $competition->id != "") Edit @else Add @endif </h5>
                    <div class="toolbar">
                        <div class="btn-group">
                        	<a href="{{ URL::to('competitions')}}" class="btn btn-default btn-sm">
                                <i class="icon-user"></i>
                            </a>
                            <a href="#sortableTable" data-toggle="collapse" class="btn btn-default btn-sm accordion-toggle minimize-box">
                                <i class="icon-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                </header>
                <div id="sortableTable" class="body collapse in">
                @if(isset($competition->id) &&  $competition->id != "")
                	{!! Form::open(['url' => 'competitions/'.$competition->id,'method' => 'put','files'=>true]) !!}
                @else
                	{!! Form::open(['url' => 'competitions','files'=>true]) !!}
                @endif
                		{{ Form::token() }}
					    <!-- First  input -->
					    <div class="form-group">
					    	{{ Form::label('title', 'Competition Name:') }}
					    	{{ Form::text('title',old('title', @$competition->title),['class'=>'form-control']) }}
					    </div>
					     <!-- Address form input -->
					    <div class="form-group">
					        {{ Form::label('description', 'Description:') }}
					    	{{ Form::textarea('description',old('description',@$competition->description),['class'=>'form-control']) }}
					    </div>
					   <!-- Category  input -->
                        <div class="form-group">
                            {{ Form::label('category_id', 'Category:') }}
                            {{ Form::select('category_id', $categories,old('category_id',@$competition->category_id),['class'=>'form-control']) }}
                        </div>
                        <!-- Category  input -->
					    <div class="form-group">
					        {{ Form::label('status', 'Status:') }}
					        {{ Form::select('status', config('enum.status'),old('status',@$competition->status),['class'=>'form-control']) }}
					    </div>
                        <!-- Category  Thumbnail -->
                        <div class="form-group">
                            {{ Form::label('image', 'Competition Image:') }}
                            {{ Form::file('image',  ['class'=>'form-control imgpicker', 'onchange'=>'readURL(this)','data-selector'=>'#imgpicker']) }}

                            {{ Form::hidden('filename',@$competition->filename) }}

                        </div>
                        @if(isset($competition) && isset($competition->filename) && $competition->filename != "")
                        <div class="form-group">
                            <img src="{{ '/uploads/'.$competition->filename }}" width="150" height="165" id="imgpicker" />
                        </div>
                        @endif
                        
                        <div class="form-group">
                            {{ Form::label('minimum_candidates', 'Minimum Candidates:') }}
                            {{ Form::text('minimum_candidates',old('minimum_candidates', @$competition->minimum_candidates),['class'=>'form-control']) }}
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label('minimum_points', 'Minimum Points:') }}
                            {{ Form::text('minimum_points',old('minimum_points', @$competition->minimum_points),['class'=>'form-control']) }}
                        </div>

                        <!-- Level Section -->
                        <div class="row">
                            <div class="col-xs-6">
                                <h3>Levels</h3>
                            </div>
                        </div>
                        <div class="container" id="level-section">
                            @if(isset($competition->levels) && $competition->levels->count() > 0)
                                @foreach($competition->levels as $key => $singleLevel)

                                <div class="row level-row" data-index="{{$key}}" id="index-{{$key}}">
                                    <div class="col-xs-2">
                                        <input type="text" name="levels[{{$key}}][title]" placeholder="Level Title" class="form-control" value="{{ $singleLevel->title }}" />
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="date" name="levels[{{$key}}][end_date]" placeholder="Finishing date" class="form-control" value="{{ $singleLevel->end_date }}" />
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="date" name="levels[{{$key}}][end_time]" placeholder="00:00" class="form-control" value="{{ $singleLevel->end_time }}" />
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="text" name="levels[{{$key}}][minimum_candidate]" placeholder="Minimum Candidates" class="form-control" value="{{ $singleLevel->minimum_candidate }}" />
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="text" name="levels[{{$key}}][minimum_points]" placeholder="Minimum Points" class="form-control" value="{{ $singleLevel->minimum_points }}" />
                                    </div>
                                    <input type="hidden" name="levels[{{$key}}]['id']" value="{{$singleLevel->id}}">
                                    <div class="col-xs-2">
                                        <a href="javascript:void(0);" data-index="#index-{{$key}}" class="level-delete" >Delete</a>
                                    </div>
                                </div>

                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <a href="javascript:void(0);" class="btn btn-default" id="add-level">Add</a>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
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