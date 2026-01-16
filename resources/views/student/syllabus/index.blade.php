@extends('student.layouts.base')
@section('title', 'Course Syllabus')
<style type="text/css">
	.syllabus-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.syllabus-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
	}
	
	.syllabus-item {
		border: 1px solid #e9ecef;
		border-radius: 0.5rem;
		padding: 1.5rem;
		margin-bottom: 1.5rem;
		background: white;
		transition: all 0.3s ease;
	}
	
	.syllabus-item:hover {
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
		transform: translateY(-2px);
	}
	
	.syllabus-item-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 1rem;
	}
	
	.syllabus-title {
		font-size: 1.25rem;
		font-weight: 600;
		color: #1e3a8a;
		margin: 0;
	}
	
	.badge-video {
		background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
		color: white;
		padding: 0.375rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
	}
	
	.badge-pdf {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.375rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
	}
	
	.video-container {
		position: relative;
		padding-bottom: 56.25%; /* 16:9 aspect ratio */
		height: 0;
		overflow: hidden;
		border-radius: 0.5rem;
		margin-top: 1rem;
	}
	
	.video-container iframe {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		border: none;
	}
	
	.pdf-container {
		margin-top: 1rem;
		padding: 1rem;
		background: #f8f9fa;
		border-radius: 0.5rem;
		text-align: center;
	}
	
	.btn-download {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		transition: all 0.3s ease;
	}
	
	.btn-download:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(37, 99, 235, 0.4);
		color: white;
		text-decoration: none;
	}
	
	.empty-state {
		text-align: center;
		padding: 3rem;
		color: #6c757d;
	}
	
	.empty-state i {
		font-size: 4rem;
		margin-bottom: 1rem;
		opacity: 0.5;
	}
	
	.course-info {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		padding: 1rem;
		border-radius: 0.5rem;
		margin-bottom: 1.5rem;
	}
	
	.course-info h5 {
		margin: 0;
		font-weight: 600;
	}
</style>

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="modern-card">
				<div class="syllabus-header">
					<h4>
						<i class="fas fa-book"></i>
						Course Syllabus
					</h4>
				</div>
				
				@if(session('error'))
					<div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
						<i class="fas fa-exclamation-circle"></i> {{ session('error') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
				@endif
				
				<div class="card-body">
					@if($course)
						<div class="course-info">
							<h5><i class="fas fa-graduation-cap"></i> {{ $course->c_full_name ?? $course->c_short_name }}</h5>
						</div>
					@endif
					
                    @php
                        $syllabusData = [];
                        if(!empty($course->course_syllabus)) {
                            $decoded = json_decode($course->course_syllabus);
                            if(is_array($decoded)) {
                                $syllabusData = $decoded;
                            }
                        }
                    @endphp

					@if(count($syllabusData) > 0)
                        <div class="accordion" id="syllabusAccordion">
                            @foreach($syllabusData as $index => $item)
                                <div class="accordion-item mb-3 border rounded overflow-hidden">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button class="accordion-button {{ $index != 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                            <strong>{{ $item->name ?? 'Topic ' . ($index + 1) }}</strong>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#syllabusAccordion">
                                        <div class="accordion-body bg-light">
                                            {!! $item->desc ?? 'No description available.' !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
					@else
						<div class="empty-state">
							<i class="fas fa-book"></i>
							<h5>No Syllabus Available</h5>
							<p>Syllabus content will be available soon.</p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

