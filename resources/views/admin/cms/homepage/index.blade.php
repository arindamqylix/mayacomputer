@extends('admin.layouts.base')
@section('title', 'Homepage Sections Management')
@push('custom-css')
<style>
    .nav-tabs .nav-link.active {
        background-color: #007bff;
        color: white;
    }
    .section-item {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 5px;
        background: #f9f9f9;
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Homepage Sections Management
            </div>
            <div class="card-body">
                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="homepageTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="counter-tab" data-bs-toggle="tab" data-bs-target="#counter" type="button" role="tab" aria-controls="counter" aria-selected="true">Counter Stats</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false">About Us</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="why-choose-tab" data-bs-toggle="tab" data-bs-target="#why-choose" type="button" role="tab" aria-controls="why-choose" aria-selected="false">Why Choose Us</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="services-tab" data-bs-toggle="tab" data-bs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="false">Services</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="achievements-tab" data-bs-toggle="tab" data-bs-target="#achievements" type="button" role="tab" aria-controls="achievements" aria-selected="false">Achievements</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="partners-tab" data-bs-toggle="tab" data-bs-target="#partners" type="button" role="tab" aria-controls="partners" aria-selected="false">Partners</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-4" id="homepageTabsContent">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- Counter Stats Tab -->
                    <div class="tab-pane fade show active" id="counter" role="tabpanel">
                        <h5>Counter Statistics</h5>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addCounterModal">Add Counter</button>
                        <div class="row">
                            @forelse($counterStats as $counter)
                            <div class="col-md-6">
                                <div class="section-item">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <strong><i class="{{ $counter->icon }}"></i> {{ $counter->number }}</strong>
                                            <p class="mb-0">{{ $counter->label }}</p>
                                        </div>
                                        <div>
                                            <a href="{{ route('homepage.edit', $counter->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('homepage.destroy', $counter->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <p class="text-muted">No counter stats found. Add your first counter.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- About Us Tab -->
                    <div class="tab-pane fade" id="about" role="tabpanel">
                        <h5>About Us Section</h5>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addAboutHeaderModal">Update Header</button>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addAboutItemModal">Add Accordion Item</button>
                        
                        @if($aboutUsHeader)
                        <div class="section-item mb-3">
                            <h6>Header</h6>
                            <p><strong>Title:</strong> {{ $aboutUsHeader->title }}</p>
                            <p><strong>Subtitle:</strong> {{ $aboutUsHeader->subtitle }}</p>
                            <a href="{{ route('homepage.edit', $aboutUsHeader->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </div>
                        @endif

                        <h6 class="mt-4">Accordion Items</h6>
                        @forelse($aboutUsItems as $item)
                        <div class="section-item">
                            <strong>{{ $item->title }}</strong>
                                    <p class="mb-0">{{ \Illuminate\Support\Str::limit($item->description, 100) }}</p>
                            <div class="mt-2">
                                <a href="{{ route('homepage.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('homepage.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted">No accordion items found.</p>
                        @endforelse
                    </div>

                    <!-- Why Choose Us Tab -->
                    <div class="tab-pane fade" id="why-choose" role="tabpanel">
                        <h5>Why Choose Us Section</h5>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addWhyChooseHeaderModal">Update Header</button>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addWhyChooseItemModal">Add Feature</button>
                        
                        @if($whyChooseHeader)
                        <div class="section-item mb-3">
                            <h6>Header</h6>
                            <p><strong>Title:</strong> {{ $whyChooseHeader->title }}</p>
                            <p><strong>Subtitle:</strong> {{ $whyChooseHeader->subtitle }}</p>
                            <a href="{{ route('homepage.edit', $whyChooseHeader->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </div>
                        @endif

                        <div class="row">
                            @forelse($whyChooseItems as $item)
                            <div class="col-md-6">
                                <div class="section-item">
                                    <strong><i class="{{ $item->icon }}"></i> {{ $item->title }}</strong>
                                    <p class="mb-0">{{ \Illuminate\Support\Str::limit($item->description, 80) }}</p>
                                    <div class="mt-2">
                                        <a href="{{ route('homepage.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('homepage.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <p class="text-muted">No features found.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Services Tab -->
                    <div class="tab-pane fade" id="services" role="tabpanel">
                        <h5>Services Section</h5>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addServiceItemModal">Add Service</button>
                        <div class="row">
                            @forelse($serviceItems as $item)
                            <div class="col-md-6">
                                <div class="section-item">
                                    <strong><i class="{{ $item->icon }}"></i> {{ $item->title }}</strong>
                                    <p class="mb-0">{{ \Illuminate\Support\Str::limit($item->description, 80) }}</p>
                                    <div class="mt-2">
                                        <a href="{{ route('homepage.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('homepage.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <p class="text-muted">No services found.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Achievements Tab -->
                    <div class="tab-pane fade" id="achievements" role="tabpanel">
                        <h5>Achievements Section</h5>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addAchievementHeaderModal">Update Header</button>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addAchievementCounterModal">Add Counter</button>
                        
                        @if($achievementHeader)
                        <div class="section-item mb-3">
                            <h6>Header</h6>
                            <p><strong>Title:</strong> {{ $achievementHeader->title }}</p>
                            <p><strong>Description:</strong> {{ \Illuminate\Support\Str::limit($achievementHeader->description, 100) }}</p>
                            @if($achievementHeader->image)
                            <img src="{{ asset($achievementHeader->image) }}" alt="" style="max-width: 200px; height: auto;">
                            @endif
                            <div class="mt-2">
                                <a href="{{ route('homepage.edit', $achievementHeader->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            @forelse($achievementCounters as $counter)
                            <div class="col-md-6">
                                <div class="section-item">
                                    <strong>{{ $counter->number }}</strong>
                                    <p class="mb-0">{{ $counter->label }}</p>
                                    <div class="mt-2">
                                        <a href="{{ route('homepage.edit', $counter->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('homepage.destroy', $counter->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <p class="text-muted">No achievement counters found.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Partners Tab -->
                    <div class="tab-pane fade" id="partners" role="tabpanel">
                        <h5>Partners Section</h5>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addPartnerHeaderModal">Update Header</button>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addPartnerItemModal">Add Partner</button>
                        
                        @if($partnerHeader)
                        <div class="section-item mb-3">
                            <h6>Header</h6>
                            <p><strong>Title:</strong> {{ $partnerHeader->title }}</p>
                            <p><strong>Subtitle:</strong> {{ $partnerHeader->subtitle }}</p>
                            <a href="{{ route('homepage.edit', $partnerHeader->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </div>
                        @endif

                        <div class="row">
                            @forelse($partnerItems as $item)
                            <div class="col-md-3">
                                <div class="section-item">
                                    @if($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" style="max-width: 100%; height: auto;">
                                    @endif
                                    <p class="mb-0 mt-2"><strong>{{ $item->title }}</strong></p>
                                    <div class="mt-2">
                                        <a href="{{ route('homepage.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('homepage.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <p class="text-muted">No partners found.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals will be included in a separate file for cleaner code -->
@include('admin.cms.homepage.modals')
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


