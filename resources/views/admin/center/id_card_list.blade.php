@extends('admin.layouts.base')
@section('title', 'Center ID Cards')
@push('custom-css')
<style type="text/css">
	.dataTables_wrapper{
		overflow: scroll !important;
	}
	
	/* Modern Card Header */
	.center-list-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.center-list-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	/* Modern Card */
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
	}
	
	/* Modern Table */
	.modern-table {
		margin: 0;
	}
	
	.modern-table thead th {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		font-weight: 600;
		text-transform: uppercase;
		font-size: 0.75rem;
		letter-spacing: 0.5px;
		padding: 1rem;
		border: none;
		white-space: nowrap;
	}
	
	.modern-table tbody td {
		padding: 1rem;
		vertical-align: middle;
		border-bottom: 1px solid #f0f0f0;
	}
	
	.modern-table tbody tr {
		transition: all 0.3s ease;
	}
	
	.modern-table tbody tr:hover {
		background-color: #f8f9ff;
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
	}

	.action-btn-idcard {
		background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
		color: #000077;
		border: none;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		transition: all 0.3s ease;
		box-shadow: 0 2px 4px rgba(0,0,0,0.1);
	}
	
	.action-btn-idcard:hover {
		background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
		color: #000077;
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0,0,0,0.15);
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card modern-card">
			<!-- Modern Header -->
			<div class="card-header center-list-header">
				<div class="d-flex justify-content-between align-items-center">
					<h4>
						<i class="fas fa-id-card"></i>
						Center ID Cards
					</h4>
				</div>
			</div>
			
			<!-- Table Section -->
			<div class="card-body p-0">
				<div class="table-responsive">
					<table id="datatable-buttons" class="table modern-table table-hover w-100">
						<thead>
							<tr>
								<th><i class="fas fa-hashtag me-2"></i>Center Code</th>
								<th><i class="fas fa-building me-2"></i>Center Name</th>
								<th><i class="fas fa-user-tie me-2"></i>Director Name</th>
								<th><i class="fas fa-map-marker-alt me-2"></i>Address</th>
								<th><i class="fas fa-tools me-2"></i>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($center as $data)
								<tr>
									<td>
										<span class="center-code" style="font-family: 'Courier New', monospace; font-weight: 600; color: #495057; background: #f8f9fa; padding: 0.25rem 0.5rem; border-radius: 0.25rem;">{{ $data->cl_code }}</span>
									</td>
									<td>
										<strong>{{ $data->cl_center_name ?? 'N/A' }}</strong>
									</td>
									<td>{{ $data->cl_director_name ?? 'N/A' }}</td>
									<td>
										<span title="{{ $data->cl_center_address ?? 'N/A' }}">
											{{ Str::limit($data->cl_center_address ?? 'N/A', 50) }}
										</span>
									</td>
									<td>
										<a href="{{ route('admin.view_center_id_card', $data->cl_id) }}" 
										   target="_blank"
										   class="btn btn-sm action-btn-idcard">
											<i class="fas fa-id-card me-1"></i> View ID Card
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

@push('custom-script')
<script type="text/javascript">
	$(document).ready(function() {
		$('#datatable-buttons').DataTable();
	});
</script>
@endpush
