@extends('layouts.admin')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1> Categories </h1>
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
                        	<a href="{{ URL::to('categories/create')}}" class="btn btn-default btn-sm">
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
                                <th colspan="2">Action<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{!! str_limit($category->description,50) !!}</td>
                                <td><a href="{{ URL::to('categories/'.$category->id.'/edit')}}"><i class="icon-edit"></i> Edit</a></td>
                                <td>
                                	<form action="{{ URL::to('categories/'.$category->id)}}" method="post">
                                		<input type="hidden" name="_method" value="DELETE">
                                		{{ csrf_field() }}
                                		<a href="javascript:void(0);" class="delete"><i class="icon-remove"></i> Delete</a>
                                	</form>
                                </td>
                            </tr>
                            @endforeach
						</tbody>
                    </table>
                </div>
                {{ $categories->links() }}
            </div>
        </div>
    </div>

@endsection