@php
    $actor = \App\Helpers\ChatActor::current();
    $layout = $layout ?? 'admin.layouts.base';
    if ($actor && $actor['type'] == 'center_login') {
        $layout = 'center.layouts.base';
    } elseif ($actor && $actor['type'] == 'student_login') {
        $layout = 'student.layouts.base';
    }
@endphp
@extends($layout)
@section('title', 'Chat')
@push('custom-css')
<style>
    .message-bubble {
        word-wrap: break-word;
    }
</style>
@endpush
@section('content')
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Chat
                <span class='float-right' style='float:right'>
                    @php
                        $dashboardRoute = $actor && $actor['type'] == 'admin_login' ? route('admin_dashboard') : 
                                         ($actor && $actor['type'] == 'center_login' ? route('center_dashboard') : 
                                         ($actor && $actor['type'] == 'student_login' ? route('student_dashboard') : '#'));
                    @endphp
                    <a href="{{ $dashboardRoute }}">  
                        <button type="button" class="btn btn-dark btn-sm"> Back </button>
                    </a>
                </span>
            </div>
            <div class="card-body">
                @livewire('chat', ['recipientType' => $recipientType ?? null, 'recipientId' => $recipientId ?? null])
            </div>
        </div>
    </div>
</div>
@endsection

