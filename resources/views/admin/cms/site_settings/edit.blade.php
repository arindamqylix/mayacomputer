@extends('admin.layouts.base')
@section('title', 'Site Settings')
@push('custom-css')
<style type="text/css">
    .preview-img {
        max-width: 120px;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 4px;
        margin-top: 8px;
    }
</style>
@endpush
@section('content')
<div class="row mt-3">
    <div class="col-lg-8">
        <form id="update_frm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header bg-secondary text-white font-weight-bold">
                    Site Settings
                </div>
                <div class="card-body"> 
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group mb-3">
                                <label>Site Name</label>
                                <input type="text" name="name" value="{{ $setting->name ?? '' }}" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ $setting->email ?? '' }}" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" value="{{ $setting->phone ?? '' }}" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Register Address</label>
                                <textarea name="address" class="form-control" rows="2" required>{{ $setting->address ?? '' }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label>Corporate Address</label>
                                <textarea name="corporate_address" class="form-control" rows="2">{{ $setting->corporate_address ?? '' }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label>Site Logo</label>
                                <input type="file" class="form-control" name="site_logo" accept=".jpg,.jpeg,.png,.gif">
                                @if(!empty($setting->site_logo))
                                    <div class="mt-2">
                                        <label class="text-muted">Current Logo:</label><br>
                                        <img src="{{ asset($setting->site_logo) }}" alt="Site Logo" class="preview-img">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label>Admin Profile Logo</label>
                                <input type="file" class="form-control" name="admin_profile_logo" accept=".jpg,.jpeg,.png,.gif">
                                @if(!empty($setting->admin_profile_logo))
                                    <div class="mt-2">
                                        <label class="text-muted">Current Admin Logo:</label><br>
                                        <img src="{{ asset($setting->admin_profile_logo) }}" alt="Admin Profile Logo" class="preview-img" style="border-radius: 50%;">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label>Document Logo</label>
                                <input type="file" class="form-control" name="document_logo" accept=".jpg,.jpeg,.png">
                                @if(!empty($setting->document_logo))
                                    <div class="mt-2">
                                        <label class="text-muted">Current Document Logo:</label><br>
                                        <img src="{{ asset($setting->document_logo) }}" alt="Document Logo" class="preview-img">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label>Certificate Footer Logos (Multiple)</label>
                                <input type="file" class="form-control" name="certificate_footer_logos[]" multiple accept=".jpg,.jpeg,.png">
                                @if(!empty($setting->certificate_footer_logos))
                                    <div class="mt-2">
                                        <label class="text-muted">Current Footer Logos:</label><br>
                                        @php
                                            $footerLogos = json_decode($setting->certificate_footer_logos, true);
                                        @endphp
                                        @if(is_array($footerLogos))
                                            @foreach($footerLogos as $logo)
                                                 <img src="{{ asset($logo) }}" alt="Footer Logo" class="preview-img mr-2">
                                            @endforeach
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label>Site Favicon</label>
                                <input type="file" class="form-control" name="site_fav_icon" accept=".jpg,.jpeg,.png,.ico">
                                @if(!empty($setting->site_fav_icon))
                                    <div class="mt-2">
                                        <label class="text-muted">Current Favicon:</label><br>
                                        <img src="{{ asset($setting->site_fav_icon) }}" alt="Favicon" class="preview-img">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label>Breadcumb Image</label>
                                <input type="file" class="form-control" name="breadcumb_image" accept=".jpg,.jpeg,.png,.ico">
                                @if(!empty($setting->breadcumb_image))
                                    <div class="mt-2">
                                        <label class="text-muted">Current Image:</label><br>
                                        <img src="{{ asset($setting->breadcumb_image) }}" alt="Breadcumb Image" class="preview-img">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label>Authorize Stamp</label>
                                <input type="file" class="form-control" name="authorize_stamp" accept=".jpg,.jpeg,.png">
                                @if(!empty($setting->authorize_stamp))
                                    <div class="mt-2">
                                        <label class="text-muted">Current Stamp:</label><br>
                                        <img src="{{ asset($setting->authorize_stamp) }}" alt="Authorize Stamp" class="preview-img">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label>Authorize Signature</label>
                                <input type="file" class="form-control" name="authorize_signature" accept=".jpg,.jpeg,.png">
                                @if(!empty($setting->authorize_signature))
                                    <div class="mt-2">
                                        <label class="text-muted">Current Signature:</label><br>
                                        <img src="{{ asset($setting->authorize_signature) }}" alt="Authorize Signature" class="preview-img">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label>Copyright</label>
                                <input type="text" name="copyright" value="{{ $setting->copyright ?? '' }}" class="form-control">
                            </div>

                            <hr class="my-4">
                            <h5 class="mb-3">Social Media Links</h5>

                            <div class="form-group mb-3">
                                <label>Facebook</label>
                                <input type="url" name="facebook" value="{{ $setting->facebook ?? '' }}" class="form-control" placeholder="https://facebook.com/yourpage">
                            </div>

                            <div class="form-group mb-3">
                                <label>Twitter</label>
                                <input type="url" name="twitter" value="{{ $setting->twitter ?? '' }}" class="form-control" placeholder="https://twitter.com/yourhandle">
                            </div>

                            <div class="form-group mb-3">
                                <label>Instagram</label>
                                <input type="url" name="instagram" value="{{ $setting->instagram ?? '' }}" class="form-control" placeholder="https://instagram.com/yourprofile">
                            </div>

                            <div class="form-group mb-3">
                                <label>YouTube</label>
                                <input type="url" name="youtube" value="{{ $setting->youtube ?? '' }}" class="form-control" placeholder="https://youtube.com/yourchannel">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light text-right">
                    <button type="submit" class="btn btn-success btn-sm" id="update_btn" accesskey="s">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('custom-js')
@endpush
