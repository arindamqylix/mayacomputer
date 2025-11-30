@extends('admin.layouts.base')
@section('title', 'Edit Student')
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
					Edit Download Form
				</div>
				<div class="card-body"> 
					<div class='row'>
						<div class="col-md-12">
							
							<!-- <div class="form-group mb-3">
                                <label>Select Page</label>
                                <select class="form-select select2" name='download_name' required>
                                    <option value='' disabled>-- Select Page --</option>
                                    <option value='Franchisee Form' {{ $download->download_name == 'Franchisee Form' ? 'selected' : '' }}>Franchisee Form</option>
                                    <option value='Admission Form' {{ $download->download_name == 'Admission Form' ? 'selected' : '' }}>Admission Form</option>
                                    <option value='Company Certificate' {{ $download->download_name == 'Company Certificate' ? 'selected' : '' }}>Company Certificate</option>
                                    <option value='Company PAN Card' {{ $download->download_name == 'Company PAN Card' ? 'selected' : '' }}>Company PAN Card</option>
                                    <option value='Udyam Registration Certificate' {{ $download->download_name == 'Udyam Registration Certificate' ? 'selected' : '' }}>Udyam Registration Certificate</option>
                                    <option value='Startup India Certificate' {{ $download->download_name == 'Startup India Certificate' ? 'selected' : '' }}>Startup India Certificate</option>
                                    <option value='ISO Certificate' {{ $download->download_name == 'ISO Certificate' ? 'selected' : '' }}>ISO Certificate</option>
                                    <option value='Trademark Certificate' {{ $download->download_name == 'Trademark Certificate' ? 'selected' : '' }}>Trademark Certificate</option>
                                </select>
                            </div> -->

                            <div class="form-group mb-3">
                                <label>Name</label>
                                <input type="text" name="download_name" id="" class="form-control" placeholder="Name">
                            </div>

                            <div class="form-group mb-3">
                                <label>Download Type</label>
                                <select class="form-select" name="type" required>
                                    <option value='' disabled>-- Select Type --</option>
                                    <option value='View' {{ $download->type == 'View' ? 'selected' : '' }}>View</option>
                                    <option value='Download' {{ $download->type == 'Download' ? 'selected' : '' }}>Download</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label>Upload File</label><br>
                                <input class="form-control" type='file' name='file' accept='.pdf,.doc,.docx,.jpg,.png,.jpeg'>
                                @if($download->file)
                                    <small class="text-muted">
                                        Current File: 
                                        <a href="{{ asset('storage/'.$download->file) }}" target="_blank">{{ $download->file }}</a>
                                    </small>
                                @endif
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
@endsection
@push('custom-js')

@endpush
