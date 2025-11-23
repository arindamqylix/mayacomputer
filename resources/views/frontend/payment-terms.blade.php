@extends('frontend.layouts.master')
@section('title','Payment Refunds')
@section('content')


<section class="payment-terms" style="font-family:Arial, sans-serif; line-height:1.6; color:#333;">
    <h2 style="color:#2a7ae2;">Payment Terms</h2>
    <ol>
        <li>
            <strong>Franchise Registration &amp; Setup Fee</strong><br>
            Each franchisee must pay the one-time <strong>Franchise Registration Fee</strong> and any applicable
            <strong>Setup Charges</strong> as specified in the Franchise Agreement before commencing operations.
            These fees are <strong>non-refundable</strong> once the registration process is completed and franchise credentials are issued.
        </li>

        <li>
            <strong>Student Enrollment Credits</strong><br>
            To enroll students, each franchisee must <strong>pre-purchase Student Enrollment Credits</strong> or
            make payments as per the plan defined by the parent organization.
            Enrollment of students will be allowed <strong>only after receipt of cleared payment</strong>
            in the parent company’s designated bank account or payment gateway.
            Unused credits, if any, will remain valid for the period specified in the franchise agreement.
        </li>

        <li>
            <strong>Mode of Payment</strong><br>
            Payments can be made via <strong>Bank Transfer (NEFT/RTGS/IMPS)</strong>, <strong>UPI</strong>,
            or <strong>approved online payment gateway</strong>.
            All payments must be made in the name of <strong>[Parent Company Name]</strong> and are subject to applicable taxes and charges.
        </li>

        <li>
            <strong>Payment Timeline</strong><br>
            All recurring fees (if any) such as <strong>monthly royalty</strong> or <strong>service fees</strong>
            must be paid on or before the <strong>due date mentioned in the invoice</strong>.
            <strong>Late payments</strong> will attract a penalty/interest as specified in the franchise agreement.
        </li>

        <li>
            <strong>Invoice &amp; Acknowledgement</strong><br>
            An electronic invoice/receipt will be issued within <strong>3 working days</strong> of receiving the payment.
            Franchisees are responsible for maintaining their payment records and ensuring timely clearance.
        </li>
    </ol>


    <h3 style="color:#2a7ae2; margin-top:30px;">Contact for Payment &amp; Refunds</h3>
    <p>
        For payment or refund-related queries, please contact:<br>
        <strong>Accounts &amp; Billing Department</strong><br>
        Email: <a href="mailto:mccsiswar@gmail.com">mccsiswar@gmail.com</a><br>
        Phone: +918825148127
    </p>
</section>


@endsection