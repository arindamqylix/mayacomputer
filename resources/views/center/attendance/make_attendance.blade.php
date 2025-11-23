@extends('center.layouts.base')
@section('title', 'Mark Attendance')

@push('custom-css')
<style>
</style>
@endpush

@section('content')

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">

            {{-- Card Header --}}
            <div class="card-header bg-secondary text-white font-weight-bold">
                Mark Attendance
            </div>

            {{-- Card Body --}}
            <div class="card-body">

                {{-- Filter Form --}}
                <form action="" method="GET" class="row mb-3">

					<div class="col-lg-4">
						<label><b>Select Batch</b></label>
						<select name="batch_id" class="form-control">
							<option value="">-- Select Batch --</option>
							@foreach($batch as $b)
								<option value="{{ $b->ab_id }}" {{ request('batch_id') == $b->ab_id ? 'selected' : '' }}>
									{{ $b->ab_name }}
								</option>
							@endforeach
						</select>
					</div>

					<div class="col-lg-4">
						<label><b>Select Date</b></label>
						<input type="date" name="att_date" class="form-control"
							value="{{ request('att_date') }}">
					</div>

					<div class="col-lg-4">
						<label>&nbsp;</label><br>
						<button class="btn btn-primary btn-sm">Filter</button>
						<a href="{{ route('make_attendance') }}" class="btn btn-danger btn-sm">Reset</a>
					</div>

				</form>


                {{-- Show Attendance Table --}}
                @if(request('batch_id') && request('att_date'))

                @php
                    $date = \Carbon\Carbon::parse(request('att_date'));
                @endphp

                <h5 class="mb-3">
                    Attendance for <b>{{ $date->format('d-M-Y (l)') }}</b>
                </h5>

                @if($students->count() > 0)

                <form action="{{ route('save_attendance') }}" method="POST">
                    @csrf

                    <input type="hidden" name="batch_id" value="{{ request('batch_id') }}">
                    <input type="hidden" name="att_date" value="{{ request('att_date') }}">

                    <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
                        <thead>
                            <tr class="table_main_row">
                                <th>Roll</th>
                                <th>Name</th>
                                <th>Present</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($students as $stu)
                                <tr>
                                    <td>{{ $stu->sl_reg_no }}</td>
                                    <td>{{ $stu->sl_name }}</td>

                                    <td>
                                        <input type="hidden" name="student_id[]" value="{{ $stu->sl_id }}">

                                        <input 
                                            type="checkbox"
                                            name="attd[{{ $stu->sl_id }}]"
                                            value="PRESENT"
                                            {{ isset($marked[$stu->sl_id]) && $marked[$stu->sl_id] === 'PRESENT' ? 'checked' : '' }}
                                        >
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button class="btn btn-success mt-2">Save Attendance</button>

                </form>

                @else
                    <p class="text-danger">No students found in this batch.</p>
                @endif

                @endif

            </div>
        </div>
    </div>
</div>

@endsection

@push('custom-js')
@endpush
