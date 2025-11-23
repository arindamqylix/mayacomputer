@extends('center.layouts.base')
@section('title', 'Profile')
@push('custom-css')
    <style type="text/css">
        .form-section-heading {
            background: linear-gradient(to right, #4e73df, #825ee4);
            padding: 12px;
            height: 44px;
        }
        .form-section-heading h5{
            color: #fff;
        }
        .card-body input{
            border-radius: 15px;
            padding: 8px;
        }
    </style>
@endpush
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Payment</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header form-section-heading">
                <h5>Payment Confirm</h5>
            </div>
            <div class="card-body">
                                   <form action="{{ route('payment_confirm') }}" method="POST" class="text-center mx-auto mt-5">
                                       @csrf
                                      <script
                                          src="https://checkout.razorpay.com/v1/checkout.js"
                                          data-key="rzp_test_Yyokf06rQ4WTfd"
                                    data-amount="{{Session::get('amount')}}" 
                                          data-currency="INR"
                                    data-order_id="{{Session::get('order_id')}}"
                                          data-buttontext="Payment Now"
                                          data-name="Maya Computer Center"
                                          data-description="Test transaction"
                                         
                                          data-theme.color="#c42222"
                                      ></script>
                                      <input type="hidden" custom="Hidden Element" name="hidden">
                                      </form>
                                     
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-js')
    <script type="text/javascript">
        
    </script>
@endpush