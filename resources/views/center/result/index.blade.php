@extends('center.layouts.base')
@section('title', 'Result List')
@push('custom-css')
	<style type="text/css">
		
	</style>
@endpush
@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-secondary text-white font-weight-bold">
					Result List
					{{-- <span class='float-right' style='float:right'>
						<a href="{{ route('generate_admit_card') }}">  <button class="btn btn-success btn-sm" >Generate New Admit</button></a> --}}
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
					        	<th>#ID</th>
					        	<th>Reg.No</th>
					        	<th>Student Name</th>
					            <th>Percentage</th>
					            <th>Grade</th>
					            <th>Action</th>
					        </tr>
				        </thead>
				        <tbody>
				        	@php $i=1; @endphp
				        	@foreach($result as $data) 
				        		<tr>
				        			<td>{{ $i++ }}</td>
				        			<td>{{ $data->sl_reg_no }}</td>
				        			<td>{{ $data->sl_name }}</td>
				        			<td>{{ $data->sr_percentage }}%</td>
				        			<td>{{ $data->sr_grade }}</td>
				        			<td>
				        				<a href="{{ route('edit_result', $data->sl_id) }}" title="Edit Result" class="btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
				        				<a href="{{ route('generatePDF',$data->sr_id) }}" class="btn btn-info btn-sm" target="__blank" title="View Marksheet"><i class="fa-solid fa-eye"></i></a>
				        				
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