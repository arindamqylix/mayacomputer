@extends('center.layouts.base')
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
						<a href="{{ route('generate_admit_card') }}">  <button class="btn btn-success btn-sm" >Generate New Admit</button></a>
				</div>
			<div class="card-body">
				<div class="card-body">{{-- 
					<form method="get" action="{{ route('admission.list') }}">
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
								<a href="{{ route('admission.list') }}" style="margin-top: 26px; "class="btn btn-danger">Reset&nbsp;<i class="fa-solid fa-ban"></i></a>
							</div>
						</div>	
					</form> --}}
				    <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
				        <thead>
					        <tr class="table_main_row">
					        	<th>Reg.No</th>
					        	<th>Student Name</th>
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
								<td>{{ \Carbon\Carbon::parse($val->sl_dob)->format('d-m-Y') }}</td>
								<td>{{ \Carbon\Carbon::parse($val->exam_date)->format('d-m-Y') }}</td>
								<td>{{ $val->exam_venue }}</td>
								<td>{{ \Carbon\Carbon::parse($val->exam_time)->format('h:i A') }}</td>

								<td>
									<a href="{{ route('edit_admit_card',$val->ac_id) }}" class="btn btn-primary btn-sm">
										View
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