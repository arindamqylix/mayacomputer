@extends('center.layouts.base')
@section('title', 'Dashboard')
@section('content')
<div class="contai px-4">
    {{-- Welcome Message --}}
    
    </div> 
</div>
<div class="row mt-4 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm p-4 bg-primary text-white rounded-3">
            <h2 class="fw-bold mb-1">👋 Welcome back, {{ Auth::user()->name ?? 'Admin' }}!</h2>
            <p class="mb-0">Here’s a quick overview of your platform today.</p>
        </div>
    </div>
</div>
<div class="row mt-3">
    
    <div class="col-12 col-sm-6 col-xl-3 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div
                        class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                </path>
                            </svg>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="h5">Student</h2>
                            <h3 class="fw-extrabold mb-1"></h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">Student</h2>
                            <h3 class="fw-extrabold mb-2">{{$all_student}}</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Student -->
    <div class="col-12 col-sm-6 col-xl-3 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div
                        class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                            <!-- Clock Icon for Pending -->
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 2.25a9.75 9.75 0 1 0 0 19.5 9.75 9.75 0 0 0 0-19.5zM12.75 7.5a.75.75 0 0 0-1.5 0v5.25c0 .2.08.39.22.53l3 3a.75.75 0 0 0 1.06-1.06l-2.78-2.78V7.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="fw-extrabold h5">Pending Student</h2>
                            <h3 class="mb-1">120</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">Pending Student</h2>
                            <h3 class="fw-extrabold mb-2">{{$pending_student}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Verified Student -->
    <div class="col-12 col-sm-6 col-xl-3 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div
                        class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                            <!-- Check Badge Icon for Verified -->
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 2.25a9.75 9.75 0 1 0 9.75 9.75A9.76 9.76 0 0 0 12 2.25zm4.28 8.03a.75.75 0 0 0-1.06-1.06l-3.47 3.47-1.47-1.47a.75.75 0 0 0-1.06 1.06l2 2a.75.75 0 0 0 1.06 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="fw-extrabold h5">Verified Student</h2>
                            <h3 class="mb-1">350</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">Verified Student</h2>
                            <h3 class="fw-extrabold mb-2">{{$verify_student}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dispatched Student -->
    <div class="col-12 col-sm-6 col-xl-3 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div
                        class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                            <!-- Truck Icon for Dispatched -->
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M3 4.5A1.5 1.5 0 0 1 4.5 3h11.25a1.5 1.5 0 0 1 1.5 1.5V9h2.25a1.5 1.5 0 0 1 1.5 1.5v5.25a3.75 3.75 0 1 1-7.5 0H9.75a3.75 3.75 0 1 1-7.5 0V4.5zM6.75 18a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5zm10.5 0a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5z" />
                            </svg>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="fw-extrabold h5">Dispatched Student</h2>
                            <h3 class="mb-1">85</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">Dispatched Student</h2>
                            <h3 class="fw-extrabold mb-2">{{$dispatched_student}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-12 col-xl-8">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="fs-5 fw-bold mb-0">Institution Profile</h2>
                            </div>
                            <div class="col text-end">
                                <a href="#" class="btn btn-sm btn-primary">Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <tbody>
                                <tr>
                                    <th class="text-gray-900" width="200">Center Code</th>
                                    <td class="fw-bolder text-gray-500">{{ $data->cl_code }}</td>
                                    <td rowspan="5" width="180" class="text-center">
                                        <img src="{{ asset('storage/center_profile/'.$data->cl_photo) }}"
                                            alt="Image Not Available" class="img-fluid rounded shadow-sm" width="120"
                                            height="140">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-gray-900">Center Name</th>
                                    <td class="fw-bolder text-gray-500">{{ $data->cl_center_name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-gray-900">Director's Name</th>
                                    <td class="fw-bolder text-gray-500">{{ $data->cl_director_name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-gray-900">Address</th>
                                    <td class="fw-bolder text-gray-500">{{ $data->cl_center_address }}</td>
                                </tr>
                                <tr>
                                    <th class="text-gray-900">Email ID</th>
                                    <td class="fw-bolder text-gray-500">{{ $data->cl_email }}</td>
                                </tr>
                                <tr>
                                    <th class="text-gray-900">Mobile</th>
                                    <td class="fw-bolder text-gray-500">{{ $data->cl_mobile }}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="col-12 px-0 mb-4">
            <div class="card border-0 shadow">
                <div class="card-header d-flex flex-row align-items-center flex-0 border-bottom">
                    <div class="d-block">
                        <div class="h6 fw-normal text-gray mb-2">Student Report</div>
                        <h2 class="h3 fw-extrabold">452</h2>
                        <div class="small mt-2">
                            <span class="fas fa-angle-up text-success"></span>
                            <span class="text-success fw-bold">18.2%</span>
                        </div>
                    </div>
                    <div class="d-block ms-auto">
                        <div class="d-flex align-items-center text-end mb-2">
                            <span class="dot rounded-circle bg-gray-800 me-2"></span>
                            <span class="fw-normal small">July</span>
                        </div>
                        <div class="d-flex align-items-center text-end">
                            <span class="dot rounded-circle bg-secondary me-2"></span>
                            <span class="fw-normal small">August</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-2">
                    <div class="ct-chart-ranking ct-golden-section ct-series-a"></div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection