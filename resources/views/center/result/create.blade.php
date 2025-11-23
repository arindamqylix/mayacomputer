@extends('center.layouts.base')
@section('title', 'Set Result')
@push('custom-css')
<style type="text/css">
		
</style>
@endpush
@section('content')
<!-- start page title -->
<!-- end page title -->
<div class="row mt-3">
	<div class="col-lg-12">
		<form id='update_frm' method="post" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-header bg-secondary text-white font-weight-bold">
					Set Result
					<span class='float-right' style='float:right'>
						<a href="{{ route('student_result_list') }}">  <button class="btn btn-dark btn-sm" > View All </button></a>
					<button class="btn btn-success btn-sm" id="update_btn" accesskey="s"> SAVE </button>                                    </span>
				</div>
				<div class="card-body">
				<div class="row mb-2">
					<div class="col-lg-6">
						<label>Student Reg.No</label>
						<select name="student_id" class="form-control">
							<option value="">--Select Reg.No--</option>
							@foreach($student as $data)
								<option value="{{ $data->sl_id }}">{{ $data->sl_reg_no }} [{{ $data->sl_name }} - {{ $data->c_short_name }}]</option>
							@endforeach
						</select>
					</div>
				</div> 
					<div class='row'>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Written</label>
								<input readonly type="text" value="Written" class="form-control" name="written" placeholder="Written">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Full Marks</label>
								<input type="text" class="form-control" name="wr_full_marks" placeholder="Full Marks">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Pass Marks</label>
								<input type="text" class="form-control" name="wr_pass_marks" placeholder="Pass Marks">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Marks Obtained</label>
								<input type="text" class="form-control" name="wr_marks_obtained" placeholder="Marks Obtained">
							</div>
						</div>
					</div>

					<div class='row'>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Practical</label>
								<input readonly type="text" value="Practical" class="form-control" name="practical" placeholder="Practical">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Full Marks</label>
								<input type="text" class="form-control" name="pr_full_marks" placeholder="Full Marks">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Pass Marks</label>
								<input type="text" class="form-control" name="pr_pass_marks" placeholder="Pass Marks">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Marks Obtained</label>
								<input type="text" class="form-control" name="pr_marks_obtained" placeholder="Marks Obtained">
							</div>
						</div>
					</div>

					<div class='row'>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Assignment/Project</label>
								<input readonly type="text" value="Assignment/Project" class="form-control" name="project" placeholder="Assignment/Project">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Full Marks</label>
								<input type="text" class="form-control" name="ap_full_marks" placeholder="Full Marks">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Pass Marks</label>
								<input type="text" class="form-control" name="ap_pass_marks" placeholder="Pass Marks">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Marks Obtained</label>
								<input type="text" class="form-control" name="ap_marks_obtained" placeholder="Marks Obtained">
							</div>
						</div>
					</div>

					<div class='row'>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Viva Voce</label>
								<input readonly type="text" value="Viva Voce" class="form-control" name="viva" placeholder="Viva Voce">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Full Marks</label>
								<input type="text" class="form-control" name="vv_full_marks" placeholder="Full Marks">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Pass Marks</label>
								<input type="text" class="form-control" name="vv_pass_marks" placeholder="Pass Marks">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group mb-3">
								<label>Marks Obtained</label>
								<input type="text" class="form-control" name="vv_marks_obtained" placeholder="Marks Obtained">
							</div>
						</div>
					</div>
				</div>
				<!-- end select2 -->
			</div>
			<!-- <div class="card-footer bg-white">
					<hr>
					
					<hr>
			</div> -->
		</div>
		<!-- end row -->
		</div> <!-- container-fluid -->
	</div>
	<!-- End Page-content -->
</div>
@endsection
@push('custom-js')
<script type="text/javascript">
	
</script>
@endpush