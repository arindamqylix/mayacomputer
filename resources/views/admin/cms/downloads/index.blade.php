@extends('admin.layouts.base')
@section('title', 'Download Form List')
@push('custom-css')
	<style type="text/css">
		
	</style>
@endpush
@section('content')
<div class="row mt-3" >
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-secondary text-white font-weight-bold">
					Download Form List
					<span class='float-right' style='float:right'>
						<a href="{{ route('add_download_form') }}">  <button class="btn btn-success btn-sm" > Add New Form</button></a>
				</div>
			<div class="card-body">
				<div class="card-body">{{-- 
					<form method="get" action="{{ route('all_download_form') }}">
						<div class="row">
							<div class="col-lg-3">
								<label>From Date</label>
								<input required="" type="date" value="{{ $from_date }}" class="form-control" name="from_date">
							</div>
							<div class="col-lg-3">
								<label>To Date</label>
								<input required="" type="date" value="{{ $to_date }}" class="form-control" name="to_date">
							</div>
							<div class="col-lg-3">
								<label></label>
								<button style="margin-top: 26px; "class="btn btn-primary">Filter&nbsp;<i class="fa-solid fa-filter"></i></button>
								<a href="{{ route('all_download_form') }}" style="margin-top: 26px; "class="btn btn-danger">Reset&nbsp;<i class="fa-solid fa-ban"></i></a>
							</div>
						</div>	
					</form> --}}
				    <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
				        <thead>
					        <tr class="table_main_row">
					        	<th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>File</th>
                                <th>Actions</th>
					        </tr>
				        </thead>
				        <tbody>
				        	@php $i=1; @endphp
				        	@foreach($downloads as $download)
                                <tr>
                                    <td>{{ $download->id }}</td>
                                    <td>{{ $download->download_name }}</td>
                                    <td>{{ $download->type }}</td>
                                    <td>
										<a href="{{ asset('storage/'.$download->file) }}" target="_blank" class="badge bg-primary text-decoration-none">
											View
										</a>
									</td>
                                    <td>
                                        <a href="{{ route('edit_download_form', $download->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('delete_download_form', $download->id) }}" class="btn btn-danger btn-sm">Edit</a>
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