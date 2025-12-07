@extends('admin.layouts.base')
@section('title', 'Edit Homepage Section')
@push('custom-css')
<style>
    .image-preview {
        max-width: 200px;
        height: auto;
        margin-top: 10px;
    }
    /* Icon Picker Styles */
    .icon-picker-container {
        position: relative;
    }
    .icon-picker-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
        margin-top: 5px;
    }
    .icon-picker-dropdown.show {
        display: block;
    }
    .icon-picker-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 10px;
        padding: 15px;
    }
    .icon-picker-item {
        text-align: center;
        padding: 10px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .icon-picker-item:hover {
        background: #f0f0f0;
        border-color: #007bff;
        transform: scale(1.05);
    }
    .icon-picker-item i {
        font-size: 24px;
        color: #333;
        display: block;
        margin-bottom: 5px;
    }
    .icon-picker-item span {
        font-size: 10px;
        color: #666;
        display: block;
        word-break: break-all;
    }
    .icon-preview-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        font-size: 12px;
    }
    .icon-preview-btn:hover {
        background: #0056b3;
    }
    .icon-input-wrapper {
        position: relative;
    }
    .icon-preview-display {
        position: absolute;
        right: 80px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        color: #666;
    }
</style>
@endpush
@section('content')
<div class="row mt-3">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Edit Homepage Section
                <a href="{{ route('homepage.index') }}" class="btn btn-success btn-sm float-right">Back to List</a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('homepage.update', $section->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section_type" value="{{ $section->section_type }}">

                    @if($section->section_type == 'counter_stat')
                        <div class="form-group">
                            <label>Icon Class (Font Awesome)</label>
                            <div class="icon-input-wrapper">
                                <input type="text" name="icon" class="form-control icon-input" value="{{ $section->icon }}" required>
                                <span class="icon-preview-display">@if($section->icon)<i class="{{ $section->icon }}"></i>@endif</span>
                                <button type="button" class="icon-preview-btn" onclick="toggleIconPicker(this)">Pick Icon</button>
                            </div>
                            <div class="icon-picker-container">
                                <div class="icon-picker-dropdown">
                                    <div class="icon-picker-grid" id="iconPickerGrid">
                                        <!-- Icons will be populated by JavaScript -->
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">Click "Pick Icon" to select from available icons</small>
                        </div>
                        <div class="form-group">
                            <label>Number</label>
                            <input type="text" name="number" class="form-control" value="{{ $section->number }}" required>
                        </div>
                        <div class="form-group">
                            <label>Label</label>
                            <input type="text" name="label" class="form-control" value="{{ $section->label }}" required>
                        </div>
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ $section->sort_order }}">
                        </div>
                    @elseif($section->section_type == 'about_us_header')
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $section->title }}">
                        </div>
                        <div class="form-group">
                            <label>Subtitle</label>
                            <textarea name="subtitle" class="form-control" rows="2">{{ $section->subtitle }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            @if($section->image)
                            <img src="{{ asset($section->image) }}" alt="" class="image-preview d-block mb-2">
                            @endif
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>Video URL</label>
                            <input type="url" name="video_url" class="form-control" value="{{ $section->video_url }}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $section->description }}</textarea>
                        </div>
                    @elseif($section->section_type == 'about_us_item')
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $section->title }}" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="5" required>{{ $section->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ $section->sort_order }}">
                        </div>
                    @elseif(in_array($section->section_type, ['why_choose_header', 'partner_header']))
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $section->title }}">
                        </div>
                        <div class="form-group">
                            <label>Subtitle</label>
                            <textarea name="subtitle" class="form-control" rows="2">{{ $section->subtitle }}</textarea>
                        </div>
                    @elseif($section->section_type == 'why_choose_item')
                        <div class="form-group">
                            <label>Icon Class (Font Awesome)</label>
                            <div class="icon-input-wrapper">
                                <input type="text" name="icon" class="form-control icon-input" value="{{ $section->icon }}" required>
                                <span class="icon-preview-display">@if($section->icon)<i class="{{ $section->icon }}"></i>@endif</span>
                                <button type="button" class="icon-preview-btn" onclick="toggleIconPicker(this)">Pick Icon</button>
                            </div>
                            <div class="icon-picker-container">
                                <div class="icon-picker-dropdown">
                                    <div class="icon-picker-grid" id="iconPickerGrid">
                                        <!-- Icons will be populated by JavaScript -->
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">Click "Pick Icon" to select from available icons</small>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $section->title }}" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3" required>{{ $section->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ $section->sort_order }}">
                        </div>
                    @elseif($section->section_type == 'service_item')
                        <div class="form-group">
                            <label>Icon Class (Font Awesome)</label>
                            <div class="icon-input-wrapper">
                                <input type="text" name="icon" class="form-control icon-input" value="{{ $section->icon }}" required>
                                <span class="icon-preview-display">@if($section->icon)<i class="{{ $section->icon }}"></i>@endif</span>
                                <button type="button" class="icon-preview-btn" onclick="toggleIconPicker(this)">Pick Icon</button>
                            </div>
                            <div class="icon-picker-container">
                                <div class="icon-picker-dropdown">
                                    <div class="icon-picker-grid" id="iconPickerGrid">
                                        <!-- Icons will be populated by JavaScript -->
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">Click "Pick Icon" to select from available icons</small>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $section->title }}" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3" required>{{ $section->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ $section->sort_order }}">
                        </div>
                    @elseif($section->section_type == 'achievement_header')
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $section->title }}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $section->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            @if($section->image)
                            <img src="{{ asset($section->image) }}" alt="" class="image-preview d-block mb-2">
                            @endif
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    @elseif($section->section_type == 'achievement_counter')
                        <div class="form-group">
                            <label>Number</label>
                            <input type="text" name="number" class="form-control" value="{{ $section->number }}" required>
                        </div>
                        <div class="form-group">
                            <label>Label</label>
                            <input type="text" name="label" class="form-control" value="{{ $section->label }}" required>
                        </div>
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ $section->sort_order }}">
                        </div>
                    @elseif($section->section_type == 'partner_item')
                        <div class="form-group">
                            <label>Partner Name</label>
                            <input type="text" name="title" class="form-control" value="{{ $section->title }}" required>
                        </div>
                        <div class="form-group">
                            <label>Logo Image</label>
                            @if($section->image)
                            <img src="{{ asset($section->image) }}" alt="" class="image-preview d-block mb-2">
                            @endif
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>Partner Link</label>
                            <input type="url" name="link" class="form-control" value="{{ $section->link }}">
                        </div>
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ $section->sort_order }}">
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $section->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $section->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="card-footer bg-light text-right">
                        <a href="{{ route('homepage.index') }}" class="btn btn-dark btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-success btn-sm">Update Section</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/icon-picker.js') }}"></script>
<script>
    // Tab switching - Bootstrap 5
    var triggerTabList = [].slice.call(document.querySelectorAll('#homepageTabs button'));
    triggerTabList.forEach(function (triggerEl) {
        var tabTrigger = new bootstrap.Tab(triggerEl);
        triggerEl.addEventListener('click', function (event) {
            event.preventDefault();
            tabTrigger.show();
        });
    });
</script>
@endsection
