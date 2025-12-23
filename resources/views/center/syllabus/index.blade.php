@extends('center.layouts.base')
@section('title', 'Course Syllabus')
@push('custom-css')
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
	
	.course-card {
		border: 1px solid #e9ecef;
		border-radius: 0.5rem;
		padding: 1.5rem;
		margin-bottom: 1.5rem;
		background: white;
		transition: all 0.3s ease;
	}
	
	.course-card:hover {
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
		transform: translateY(-2px);
	}
	
	.course-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 1rem;
		padding-bottom: 1rem;
		border-bottom: 2px solid #e9ecef;
	}
	
	.course-title {
		font-size: 1.5rem;
		font-weight: 600;
		color: #1e3a8a;
		margin: 0;
	}
	
	.syllabus-count {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
	}
	
	.syllabus-item {
		border-left: 3px solid #2563eb;
		padding: 1rem;
		margin-bottom: 1rem;
		background: #f8f9fa;
		border-radius: 0 0.5rem 0.5rem 0;
	}
	
	.syllabus-item-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 0.5rem;
	}
	
	.syllabus-item-title {
		font-weight: 600;
		color: #1e3a8a;
		margin: 0;
	}
	
	.badge-video {
		background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
		color: white;
		padding: 0.25rem 0.5rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
	}
	
	.badge-pdf {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.25rem 0.5rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
	}
	
	.btn-view {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		transition: all 0.3s ease;
		font-size: 0.875rem;
	}
	
	.btn-view:hover {
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
</style>
@endpush

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
				
				<div class="card-body">
					@if(count($syllabusByCourse) > 0)
						@foreach($syllabusByCourse as $courseData)
							<div class="course-card">
								<div class="course-header">
									<h5 class="course-title">{{ $courseData['course']->c_full_name ?? $courseData['course']->c_short_name }}</h5>
									<span class="syllabus-count">
										{{ count($courseData['syllabus']) }} Item(s)
									</span>
								</div>
								
								@foreach($courseData['syllabus'] as $item)
									<div class="syllabus-item">
										<div class="syllabus-item-header">
											<h6 class="syllabus-item-title">{{ $item->cs_title }}</h6>
											@if($item->cs_type == 'video')
												<span class="badge-video">
													<i class="fas fa-video"></i> Video
												</span>
											@else
												<span class="badge-pdf">
													<i class="fas fa-file-pdf"></i> PDF
												</span>
											@endif
										</div>
										@if($item->cs_description)
											<p class="text-muted mb-2" style="font-size: 0.875rem;">{{ $item->cs_description }}</p>
										@endif
										<a href="{{ route('center.syllabus.view', $courseData['course']->c_id) }}" class="btn-view">
											<i class="fas fa-eye"></i> View Details
										</a>
									</div>
								@endforeach
							</div>
						@endforeach
					@else
						<div class="empty-state">
							<i class="fas fa-book"></i>
							<h5>No Syllabus Available</h5>
							<p>No course syllabus available at the moment.</p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

