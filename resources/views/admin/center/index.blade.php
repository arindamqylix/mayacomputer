@extends('admin.layouts.base')
@section('title', 'Center')
<style type="text/css">
	.dataTables_wrapper{
			overflow: scroll !important;
		}
</style>
@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-secondary text-white font-weight-bold">
					Center List
					<span class='float-right' style='float:right'>
						<a href="{{ route('add_center') }}">  <button class="btn btn-success btn-sm" > Add New Center</button></a>
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
					        	<th>Center Code</th>
					            <th>Center Name</th>
					            <th>Director Name</th>
					            <th>Center Address</th>
					            <th>Email</th>
					            <th>Mobile</th>
					            <th>Balance</th>
					            <th>Account Status</th>
					            <th>Action</th>
					        </tr>
				        </thead>
				        <tbody>
				        	@php $i=1; @endphp
				        	@foreach($center as $data) 
				        		<tr>
				        			<td>{{ $data->cl_code }}</td>
				        			<td>{{ $data->cl_center_name }}</td>
				        			<td>{{ $data->cl_director_name }}</td>
				        			<td>{{ $data->cl_center_address}}</td>
				        			<td>{{ $data->cl_email}}</td>
				        			<td>{{ $data->cl_mobile}}</td>
				        			<td>{{ $data->cl_wallet_balance}}</td>
				        			<td>
				        			    {{ $data->cl_account_status }}
				        			</td>
				        			<td>
				        			    <select class="mb-1" onchange="centerStatus({{$data->cl_code}}, this.value);" id="center_status" name="center_status">
				        			        <option value="">--Select--</option>
				        			        <option value="ACTIVE">ACTIVE</option>
				        			        <option value="PENDING">PENDING</option>
				        			    </select>
				        				<a href="{{ route('edit_center', $data->cl_id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-eye"></i></a>
				        				<a href="{{ route('view_center_certificate', $data->cl_id) }}" class="btn btn-warning btn-sm"><i class="fa fa-share-square"></i></a>
				        				<a href="{{ route('delete_center', $data->cl_id) }}" 
											class="btn btn-danger btn-sm"
											onclick="return confirm('Are you sure you want to delete this center?')">
											<i class="fa fa-trash"></i>
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
<script>
	function centerStatus(center_code, center_status){
	if(center_status == ''){
		alert("Please Select Account Status");
		location.reload();
	}else{
		$.ajax({
			url: "{{ route('center.status') }}",
			type: "get",
			data: {center_code:center_code,center_status:center_status},
			dataType: "json",
			success: function(response){
				if(response.status == 1){
					alert(response.msg);
					location.reload();
				}else{
					alert(response.msg);
					location.reload();
				}
			}
		});
	}
	
}
</script>