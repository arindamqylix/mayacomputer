@extends('admin.layouts.base')
@section('title', 'Edit Center')
@push('custom-css')
<style type="text/css">
	img.preview-img { max-width: 120px; max-height: 120px; display:block; margin-top:8px; }
</style>
@endpush
@section('content')
<!-- end page title -->
<div class="row mt-3">
    <div class="col-lg-12">
        <form id="update_frm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header bg-secondary text-white font-weight-bold">
                    Edit Center
                    <span class="float-right" style="float:right">
                        <a href="{{ route('center_list') }}">
                            <button type="button" class="btn btn-dark btn-sm"> View All </button>
                        </a>
                        <button class="btn btn-success btn-sm" id="update_btn" accesskey="s"> UPDATE </button>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Center Name --}}
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <label>Center Name</label>
                                <input required class="form-control" placeholder="Center Name"
                                    type="text" name="center_name"
                                    value="{{ old('center_name', $data->cl_center_name ?? '') }}">
                            </div>
                        </div>
                        {{-- Director Name --}}
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <label>Center Director Name</label>
                                <input required class="form-control" placeholder="Director Name"
                                    type="text" name="director_name"
                                    value="{{ old('director_name', $data->cl_director_name ?? '') }}">
                            </div>
                        </div>
                        {{-- Address --}}
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <label>Center Address</label>
                                <input required class="form-control" placeholder="Address"
                                    type="text" name="center_address"
                                    value="{{ old('center_address', $data->cl_center_address ?? '') }}">
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <label>Center Email</label>
                                <input required class="form-control" placeholder="Email"
                                    type="email" name="center_email"
                                    value="{{ old('center_email', $data->cl_email ?? '') }}">
                            </div>
                        </div>
                        {{-- Mobile --}}
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <label>Center Mobile</label>
                                <input required class="form-control" placeholder="Mobile"
                                    type="number" name="center_mobile"
                                    value="{{ old('center_mobile', $data->cl_mobile ?? '') }}">
                            </div>
                        </div>
                        {{-- Photo --}}
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <label>Photo</label>
                                <input class="form-control" type="file" name="photo" accept="image/*">
                                @if(!empty($data->cl_photo))
                                    <div class="mt-2">
                                        <a href="{{ asset($data->cl_photo) }}" target="_blank" class="btn btn-sm btn-info mb-2">View current photo</a>
                                        <img src="{{ asset($data->cl_photo) }}" alt="Photo" class="preview-img" style="max-width: 120px; max-height: 120px; display:block; margin-top:8px;" onerror="this.style.display='none';">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 style="background: #74788d;padding: 9px;color: #fff;font-size: 14px;">Center Document</h5>
                        </div>
                    </div>
                    <div class="row">
                        {{-- Center Stamp --}}
                        <div class="col-lg-4 mb-3">
                            <div class="form-group mb-3">
                                <label>Center Stamp</label>
                                <input class="form-control" type="file" name="center_stamp" accept="image/*">
                                @if(!empty($data->cl_center_stamp))
                                    <div class="mt-2">
                                        <a href="{{ asset($data->cl_center_stamp) }}" target="_blank" class="btn btn-sm btn-info mb-2">View current stamp</a>
                                        <img src="{{ asset($data->cl_center_stamp) }}" alt="Stamp" class="preview-img" style="max-width: 120px; max-height: 120px; display:block; margin-top:8px;" onerror="this.style.display='none';">
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- Center Signature --}}
                        <div class="col-lg-4 mb-3">
                            <div class="form-group mb-3">
                                <label>Center Signature</label>
                                <input class="form-control" type="file" name="center_signature" accept="image/*">
                                @if(!empty($data->cl_center_signature))
                                    <div class="mt-2">
                                        <a href="{{ asset($data->cl_center_signature) }}" target="_blank" class="btn btn-sm btn-info mb-2">View current signature</a>
                                        <img src="{{ asset($data->cl_center_signature) }}" alt="Signature" class="preview-img" style="max-width: 120px; max-height: 120px; display:block; margin-top:8px;" onerror="this.style.display='none';">
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- Director Aadhaar --}}
                        <div class="col-lg-4 mb-3">
                            <div class="form-group mb-3">
                                <label>Director Aadhaar</label>
                                <input class="form-control" type="file" name="director_adhar" accept="image/*,application/pdf">
                                @if(!empty($data->cl_director_adhar))
                                    <div class="mt-2">
                                        <a href="{{ asset($data->cl_director_adhar) }}" target="_blank" class="btn btn-sm btn-info mb-2">View current Aadhaar</a>
                                        @php
                                            $aadharExtension = strtolower(pathinfo($data->cl_director_adhar, PATHINFO_EXTENSION));
                                            $isAadharImage = in_array($aadharExtension, ['jpg', 'jpeg', 'png', 'gif']);
                                        @endphp
                                        @if($isAadharImage)
                                            <img src="{{ asset($data->cl_director_adhar) }}" alt="Aadhaar" class="preview-img" style="max-width: 120px; max-height: 120px; display:block; margin-top:8px;" onerror="this.style.display='none';">
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- Director PAN --}}
                        <div class="col-lg-4 mb-3">
                            <div class="form-group mb-3">
                                <label>Director PAN</label>
                                <input class="form-control" type="file" name="director_pan" accept="image/*,application/pdf">
                                @if(!empty($data->cl_director_pan))
                                    <div class="mt-2">
                                        <a href="{{ asset($data->cl_director_pan) }}" target="_blank" class="btn btn-sm btn-info mb-2">View current PAN</a>
                                        @php
                                            $panExtension = strtolower(pathinfo($data->cl_director_pan, PATHINFO_EXTENSION));
                                            $isPanImage = in_array($panExtension, ['jpg', 'jpeg', 'png', 'gif']);
                                        @endphp
                                        @if($isPanImage)
                                            <img src="{{ asset($data->cl_director_pan) }}" alt="PAN" class="preview-img" style="max-width: 120px; max-height: 120px; display:block; margin-top:8px;" onerror="this.style.display='none';">
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- Director Education --}}
                        <div class="col-lg-4 mb-3">
                            <div class="form-group mb-3">
                                <label>Director Education</label>
                                <input required class="form-control" placeholder="Director Education"
                                    type="text" name="director_education"
                                    value="{{ old('director_education', $data->cl_director_education ?? '') }}">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
					        <div class="form-group mb-3">
    							<label>Center Payment Amount</label>
    							<input required class="form-control" placeholder="Center Payment Amount"  type='text' name="cl_wallet_balance"  value="{{ old('cl_wallet_balance', $data->cl_wallet_balance ?? '') }}">
						    </div>
					    </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
        </form>
    </div>
</div>
@endsection
@push('custom-js')
@endpush
