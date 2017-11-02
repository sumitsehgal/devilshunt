@extends('layouts.admin')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1> Competitions </h1>
        </div>
    </div>
    <hr />

     <!--TABLE, PANEL, ACCORDION AND MODAL  -->
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <header>
                    <h5>List</h5>
                    <div class="toolbar">
                        <div class="btn-group">
                        	<a href="{{ URL::to('competitions/create')}}" class="btn btn-default btn-sm">
                                <i class="icon-plus"></i>
                            </a>
                            <a href="#sortableTable" data-toggle="collapse" class="btn btn-default btn-sm accordion-toggle minimize-box">
                                <i class="icon-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                </header>
                <div id="sortableTable" class="body collapse in">
                    <table class="table table-bordered sortableTable responsive-table">
                        <thead>
                            <tr>
                                <th>#<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                                <th>Name<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                                <th>Description<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                                <th colspan="3">Action<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach ($competitions as $competition)
                            <tr>
                                <td>{{ $competition->id }}</td>
                                <td>{{ $competition->title }}</td>
                                <td>{!! str_limit($competition->description,50) !!}</td>
                                <td><a href="{{ URL::to('competitions/'.$competition->id.'/edit')}}"><i class="icon-edit"></i> Edit</a></td>
                                <td>
                                	<form action="{{ URL::to('competitions/'.$competition->id)}}" method="post">
                                		<input type="hidden" name="_method" value="DELETE">
                                		{{ csrf_field() }}
                                		<a href="javascript:void(0);" class="delete"><i class="icon-remove"></i> Delete</a>
                                	</form>
                                </td>
                                <td>@if($competition->status == 0) <a href="javascript:void(0);" class="btn btn-danger">Not Active</a> @elseif($competition->isstart == 1 && $competition->isend == 0 ) <a href="javascript:void(0);" class="btn btn-warning">Running</a> @elseif($competition->isend == 1) <a href="javascript:void(0);" class="btn btn-success">Ended</a> @elseif(array_key_exists($competition->id,$readyToStart) && $readyToStart[$competition->id] >= $competition->minimum_candidates) <a href="javascript:void();" onclick="alert('Need to Add functionality');" class="btn btn-primary"> Ready to Start </a>   @endif</td>
                            </tr>
                            @endforeach
						</tbody>
                    </table>
                </div>
                {{ $competitions->links() }}
            </div>
        </div>
    </div>

@endsection