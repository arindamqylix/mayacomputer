@extends('admin.layouts.base')
@section('title', 'Add Student')
@push('custom-css')
<style type="text/css">
		
</style>
@endpush
@section('content')
<div class="row mt-3">
	<div class="col-lg-6">
		<form id='update_frm' method="post" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-header bg-secondary text-white font-weight-bold">
					Add Download Form
				</div>
				<div class="card-body"> 
					<div class='row'>
						<div class="col-md-12">
							
							<div class="form-group mb-3">
								<label>Name</label>
								<input type="text" name="download_name" id="download_name" class="form-control" placeholder="Name">
							</div>

							<div class="form-group mb-3 ">
								<label>Slug</label>
								<input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" readonly>
							</div>


							<div class="form-group mb-3">
								<label>Download Type</label>
								<select class="form-select" name="type" required>
									<option value='' selected disabled>-- Select Type --</option>
									<option value='View'>View</option>
									<option value='Download'>Download</option>
								</select>
							</div>
		
							<div class="form-group mb-3">
								<label>Upload File</label><br>
								<input class="form-control" type='file' name='file' accept='.pdf,.doc,.docx,.jpg,.png,.jpeg'>
							</div>

						</div>
					</div>
				</div>

				{{-- Buttons moved to footer --}}
				<div class="card-footer bg-light text-right">
					<a href="{{ route('student_list') }}" class="btn btn-dark btn-sm">View All</a>
					<button type="submit" class="btn btn-success btn-sm" id="update_btn" accesskey="s">Save</button>
				</div>

			</div>
		</form>
	</div>
</div>
<script>
		document.getElementById('download_name').addEventListener('keyup', function () {
			let name = this.value;
			let slug = name.toLowerCase()
						.replace(/[^a-z0-9]+/g, '-')  // replace non-alphanumeric with -
						.replace(/^-+|-+$/g, '');     // remove starting/ending -  
			document.getElementById('slug').value = slug;
		});
</script>
@endsection
@push('custom-js')
	

@endpush
