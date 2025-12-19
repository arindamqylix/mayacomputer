@extends('admin.layouts.base')
@section('title', 'All Banner')
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
						<a href="{{ route('add_banner') }}">  <button class="btn btn-success btn-sm" > Add Banner</button></a>
				</div>
			<div class="card-body">
				<div class="card-body">
				    <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
				        <thead>
					        <tr class="table_main_row">
					        	<th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Heading</th>
                                <th>Button</th>
                                <th>Sort Order</th>
                                <th>Status</th>
                                <th>Actions</th>
					        </tr>
				        </thead>
				        <tbody>
				        	@php $i=1; @endphp
				        	@foreach($banner as $banner)
                                <tr>
                                    <td>{{ $banner->id }}</td>
                                    <td>
										<img src="{{ asset($banner->file) }}" style="width: 60px;height: 55px; object-fit: cover; border-radius: 5px;" alt="">
									</td>
                                    <td>
                                        @if($banner->title)
                                            <span class="badge bg-warning text-dark">{{ \Illuminate\Support\Str::limit($banner->title, 25) }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($banner->header)
                                            <strong>{{ \Illuminate\Support\Str::limit($banner->header, 30) }}</strong>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($banner->button_name)
                                            <span class="badge bg-info">{{ $banner->button_name }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $banner->sort_order ?? 0 }}</td>
                                    <td>
                                        @if(($banner->status ?? 1) == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit_banner', $banner->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('delete_banner', $banner->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this banner?');">Delete</a>
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