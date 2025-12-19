@extends('admin.layouts.base')
@section('title', 'Admit Card List')
@push('custom-css')
	<style type="text/css">
		
	</style>
@endpush
@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-secondary text-white font-weight-bold">
					Admit Card List
					<span class='float-right' style='float:right'>
						<a href="{{ route('admin.generate_admit_card') }}">  <button class="btn btn-success btn-sm" >Generate New Admit</button></a>
				</div>
			<div class="card-body">
				@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						{{ session('success') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				@if(session('error'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						{{ session('error') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				<div class="card-body">
				    <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
				        <thead>
					        <tr class="table_main_row">
					        	<th>Reg.No</th>
					        	<th>Student Name</th>
					        	<th>Center</th>
					            <th>DOB</th>
					            <th>Exam Date</th>
					            <th>Venue</th>
					            <th>Time</th>
					            <th>Action</th>
					        </tr>
				        </thead>
				        <tbody>
							@foreach($admitCards as $val)
							<tr>
								<td>{{ $val->sl_reg_no }}</td>
								<td>{{ $val->sl_name }}</td>
								<td>{{ $val->center_name ?? 'N/A' }}</td>
								<td>{{ \Carbon\Carbon::parse($val->sl_dob)->format('d-m-Y') }}</td>
								<td>{{ \Carbon\Carbon::parse($val->exam_date)->format('d-m-Y') }}</td>
								<td>{{ $val->exam_venue }}</td>
								<td>{{ \Carbon\Carbon::parse($val->exam_time)->format('h:i A') }}</td>

								<td>
									<a href="{{ route('admin.edit_admit_card', $val->ac_id) }}" class="btn btn-primary btn-sm">
										Edit
									</a>
									<a href="{{ route('admin.print_admit_card', $val->ac_id) }}" class="btn btn-success btn-sm" target="_blank">
										Print
									</a>
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

