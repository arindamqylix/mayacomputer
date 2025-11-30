@extends('admin.layouts.base')
@section('title', 'gallery Form List')
@push('custom-css')
	<style type="text/css">
		
	</style>
@endpush
@section('content')
<div class="row mt-3" >
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-secondary text-white font-weight-bold">
					Gallery List
					<span class='float-right' style='float:right'>
						<a href="{{ route('add_gallery') }}">  <button class="btn btn-success btn-sm" > Add Gallery</button></a>
				</div>
			<div class="card-body">
				<div class="card-body">
				    <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
				        <thead>
					        <tr class="table_main_row">
					        	<th>ID</th>
                                <th>Image</th>
                                <th>Actions</th>
					        </tr>
				        </thead>
				        <tbody>
				        	@php $i=1; @endphp
				        	@foreach($gallery as $gallery)
                                <tr>
                                    <td>{{ $gallery->id }}</td>
                                    <td>
										<img src="{{ asset($gallery->file) }}" style="width: 60px;height: 55px;" alt="">
									</td>
                                    <td>
                                        <a href="{{ route('edit_gallery', $gallery->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('delete_gallery', $gallery->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
				        </tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('custom-js')
	
@endpush