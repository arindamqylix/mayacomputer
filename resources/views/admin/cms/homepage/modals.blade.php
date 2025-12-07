<!-- Add Counter Modal -->
<div class="modal fade" id="addCounterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('homepage.store') }}">
                @csrf
                <input type="hidden" name="section_type" value="counter_stat">
                <div class="modal-header">
                    <h5 class="modal-title">Add Counter Stat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Icon Class (Font Awesome)</label>
                        <div class="icon-input-wrapper">
                            <input type="text" name="icon" class="form-control icon-input" placeholder="fa fa-users" required>
                            <span class="icon-preview-display"></span>
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
                        <input type="text" name="number" class="form-control" placeholder="50707+" required>
                    </div>
                    <div class="form-group">
                        <label>Label</label>
                        <input type="text" name="label" class="form-control" placeholder="Students Enrolled" required>
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Counter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add About Header Modal -->
<div class="modal fade" id="addAboutHeaderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('homepage.store') }}">
                @csrf
                <input type="hidden" name="section_type" value="about_us_header">
                <div class="modal-header">
                    <h5 class="modal-title">Update About Us Header</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="ABOUT US">
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <textarea name="subtitle" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>Video URL</label>
                        <input type="url" name="video_url" class="form-control" placeholder="https://www.youtube.com/watch?v=...">
                    </div>
                    <div class="form-group">
                        <label>Description (Welcome Text)</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add About Item Modal -->
<div class="modal fade" id="addAboutItemModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('homepage.store') }}">
                @csrf
                <input type="hidden" name="section_type" value="about_us_item">
                <div class="modal-header">
                    <h5 class="modal-title">Add Accordion Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title (e.g., Our History, Our Mission, Our Vision)</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Why Choose Header Modal -->
<div class="modal fade" id="addWhyChooseHeaderModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('homepage.store') }}">
                @csrf
                <input type="hidden" name="section_type" value="why_choose_header">
                <div class="modal-header">
                    <h5 class="modal-title">Update Why Choose Us Header</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Why Choose Us">
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <textarea name="subtitle" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Why Choose Item Modal -->
<div class="modal fade" id="addWhyChooseItemModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('homepage.store') }}">
                @csrf
                <input type="hidden" name="section_type" value="why_choose_item">
                <div class="modal-header">
                    <h5 class="modal-title">Add Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Icon Class</label>
                        <input type="text" name="icon" class="form-control" placeholder="fa fa-certificate" required>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Feature</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Service Item Modal -->
<div class="modal fade" id="addServiceItemModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('homepage.store') }}">
                @csrf
                <input type="hidden" name="section_type" value="service_item">
                <div class="modal-header">
                    <h5 class="modal-title">Add Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Icon Class</label>
                        <input type="text" name="icon" class="form-control" placeholder="fa fa-desktop" required>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Achievement Header Modal -->
<div class="modal fade" id="addAchievementHeaderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('homepage.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="section_type" value="achievement_header">
                <div class="modal-header">
                    <h5 class="modal-title">Update Achievement Header</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="ACHIEVEMENTS">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Achievement Counter Modal -->
<div class="modal fade" id="addAchievementCounterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('homepage.store') }}">
                @csrf
                <input type="hidden" name="section_type" value="achievement_counter">
                <div class="modal-header">
                    <h5 class="modal-title">Add Achievement Counter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Number</label>
                        <input type="text" name="number" class="form-control" placeholder="60" required>
                    </div>
                    <div class="form-group">
                        <label>Label</label>
                        <input type="text" name="label" class="form-control" placeholder="TEACHERS" required>
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Counter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Partner Header Modal -->
<div class="modal fade" id="addPartnerHeaderModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('homepage.store') }}">
                @csrf
                <input type="hidden" name="section_type" value="partner_header">
                <div class="modal-header">
                    <h5 class="modal-title">Update Partners Header</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Our Partners">
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <textarea name="subtitle" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Partner Item Modal -->
<div class="modal fade" id="addPartnerItemModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('homepage.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="section_type" value="partner_item">
                <div class="modal-header">
                    <h5 class="modal-title">Add Partner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Partner Name</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Logo Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label>Partner Link (Optional)</label>
                        <input type="url" name="link" class="form-control" placeholder="https://...">
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Partner</button>
                </div>
            </form>
        </div>
    </div>
</div>

