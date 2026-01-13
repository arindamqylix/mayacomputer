@extends('center.layouts.base')
@section('title', 'Courier Details')

@push('custom-css')
<style>
    .courier-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    
    .courier-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }
    
    .courier-header {
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .courier-header.received {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
    
    .courier-info {
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }
    
    .courier-icon {
        font-size: 1.5rem;
        opacity: 0.9;
    }
    
    .tracking-no {
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }
    
    .dispatch-date {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    
    .courier-body {
        padding: 1.5rem;
        background: white;
    }
    
    .student-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .student-item {
        padding: 0.75rem;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .student-item:last-child {
        border-bottom: none;
    }
    
    .student-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        background: #f3f4f6;
    }
    
    .student-details h6 {
        margin: 0;
        font-weight: 600;
        color: #1f2937;
    }
    
    .student-details p {
        margin: 0;
        font-size: 0.85rem;
        color: #6b7280;
    }
    
    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-badge.pending {
        background-color: #fef3c7;
        color: #d97706;
    }
    
    .status-badge.received {
        background-color: #d1fae5;
        color: #059669;
    }
    
    .btn-mark-received {
        background: white;
        color: #d97706;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .btn-mark-received:hover {
        background: #fef3c7;
        transform: scale(1.05);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #6b7280;
    }
    
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 text-gray-800">
            <i class="fas fa-truck me-2 text-primary"></i> Courier Details
        </h4>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            @php
                // Group by Tracking Number + Date to handle multiple students in one package
                $groupedCouriers = $couriers->groupBy(function($item) {
                    return $item->sc_tracking_number . '|' . $item->sc_dispatch_date . '|' . $item->sc_dispatch_thru;
                });
            @endphp
            
            @if($groupedCouriers->count() > 0)
                @foreach($groupedCouriers as $groupKey => $items)
                    @php
                        $firstItem = $items->first();
                        list($tracking, $date, $provider) = explode('|', $groupKey);
                        // Check if ALL items in this group are received
                        $allReceived = $items->every(function($item) {
                            return $item->sc_status === 'RECEIVED';
                        });
                        
                        // Check if ANY item is not received (to show the button)
                        // Actually, if partial, we should probably allow receiving individually or bulk.
                        // For simplicity, let's treat the group as the unit if possible, 
                        // but the controller expects single ID update. 
                        // I'll show the button per group if not all are received, 
                        // and when clicked, it initiates a loop or allows individual receive?
                        // User requirement: "Received ka option ko OK karega" (Will OK the Received option).
                        // Let's assume one click per package.
                    @endphp
                    
                    <div class="courier-card">
                        <div class="courier-header {{ $allReceived ? 'received' : '' }}">
                            <div class="courier-info">
                                <i class="fas fa-box courier-icon"></i>
                                <div>
                                    <div class="tracking-no">{{ $tracking }}</div>
                                    <div class="dispatch-date">
                                        <i class="fas fa-calendar-alt me-1"></i> Dispatched: {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}
                                        <span class="mx-2">|</span>
                                        <i class="fas fa-shipping-fast me-1"></i> {{ $provider }}
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                @if($allReceived)
                                    <span class="badge bg-white text-success px-3 py-2">
                                        <i class="fas fa-check-double me-1"></i> Received
                                    </span>
                                @else
                                    <!-- Use a modal or a form to submit all IDs? 
                                         Controller 'update_received' takes 'certificate_id' (single).
                                         Let's assume the user wants to mark the whole package.
                                         I will create a form that submits the FIRST certificate ID 
                                         and I might need to update the controller to handle multiple 
                                         OR just list buttons for each student if they are separate?
                                         
                                         Usually a tracking number is one package. 
                                         Let's change Controller to update ALL certificates with this tracking number and center ID.
                                    -->
                                    <button class="btn-mark-received" onclick="markAsReceived('{{ $tracking }}')">
                                        <i class="fas fa-check me-1"></i> Mark Received
                                    </button>
                                @endif
                            </div>
                        </div>
                        
                        <div class="courier-body">
                            <h6 class="text-muted mb-3 text-uppercase font-weight-bold" style="font-size: 0.8rem; letter-spacing: 1px;">Contents (Students)</h6>
                            <ul class="student-list">
                                @foreach($items as $student)
                                    <li class="student-item">
                                        @if($student->sl_photo)
                                            <img src="{{ asset($student->sl_photo) }}" alt="" class="student-avatar">
                                        @else
                                            <div class="student-avatar d-flex align-items-center justify-content-center text-muted">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                        
                                        <div class="student-details flex-grow-1">
                                            <h6>{{ $student->sl_name }}</h6>
                                            <p>{{ $student->c_short_name }} • Reg: {{ $student->sl_reg_no }}</p>
                                        </div>
                                        
                                        <div>
                                            @if($student->sc_status === 'RECEIVED')
                                                <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                            @else
                                                <span class="text-warning"><i class="fas fa-clock"></i></span>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
                
                <!-- Hidden Form for Mark Received -->
                <form id="receiveForm" action="{{ route('center.courier.received') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="tracking_number" id="tracking_input">
                </form>
                
            @else
                <div class="card p-5">
                    <div class="empty-state">
                        <i class="fas fa-truck-loading"></i>
                        <h5>No courier details found</h5>
                        <p>You haven't received any dispatched documents yet.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script>
    function markAsReceived(trackingNumber) {
        if(confirm('Are you sure you want to mark this courier as RECEIVED? This will update the status for all documents in this package.')) {
            document.getElementById('tracking_input').value = trackingNumber;
            document.getElementById('receiveForm').submit();
        }
    }
</script>
@endpush
