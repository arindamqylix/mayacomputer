@extends('frontend.layouts.master')
@section('title','Terms & Conditions')
@section('content')
@php
	$data = DB::table('site_settings')->where('id','1')->first();
@endphp
<!-- Breadcrumbs Start -->
		<div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
		    <div class="breadcrumbs-inner">
		        <div class="container">
		            <div class="row">
		                <div class="col-md-12 text-center">
		                    <h1 class="page-title">Terms & Conditions</h1>
		                    <ul>
		                        <li>
		                            <a class="active" href="{{url('/')}}">Home</a>
		                        </li>
		                        <li>Terms & Conditions</li>
		                    </ul>
		                </div>
		            </div>
		        </div>
		    </div><!-- .breadcrumbs-inner end -->
		</div>
		<!-- Breadcrumbs End -->
		
		<!-- Contact Section Start -->
		<div class="contact-page-section sec-spacer">
        	<div class="container">
        		<section class="payment-terms" style="font-family:Arial, sans-serif; line-height:1.6; color:#333;">
    
    <h2 style="color:#2a7ae2;">Introduction</h2>
    <p>
        Welcome to <strong>Maya Computer</strong>. These Terms and Conditions govern your use of our website, 
        services, courses, and franchise operations. By accessing our website or enrolling in our courses, 
        you agree to be bound by these terms. Please read them carefully before using our services.
    </p>
    <p>
        These terms apply to all visitors, students, franchisees, and any other users who access or use our services.
    </p>

    <h2 style="color:#2a7ae2; margin-top:30px;">1. Definitions</h2>
    <ul>
        <li><strong>"Maya Computer"</strong> refers to the parent organization and its authorized franchise network.</li>
        <li><strong>"Student"</strong> refers to any individual enrolled in our courses.</li>
        <li><strong>"Franchisee"</strong> refers to authorized center operators under Maya Computer brand.</li>
        <li><strong>"Services"</strong> includes courses, certifications, verification services, and all educational offerings.</li>
        <li><strong>"Website"</strong> refers to the official Maya Computer website and all its pages.</li>
    </ul>

    <h2 style="color:#2a7ae2; margin-top:30px;">2. Eligibility</h2>
    <ol>
        <li>Students must meet the minimum age and educational qualifications specified for each course.</li>
        <li>Franchisees must meet the eligibility criteria outlined in the Franchise Agreement.</li>
        <li>Users must provide accurate and complete information during registration.</li>
        <li>Maya Computer reserves the right to refuse service to anyone for any lawful reason.</li>
    </ol>

    <h2 style="color:#2a7ae2; margin-top:30px;">3. Course Enrollment &amp; Student Terms</h2>
    <ol>
        <li>
            <strong>Enrollment Process</strong><br>
            Students must complete the admission form and submit required documents along with applicable fees 
            to enroll in any course. Enrollment is confirmed only after verification of documents and receipt of fees.
        </li>
        <li>
            <strong>Course Duration &amp; Attendance</strong><br>
            Students must complete the course within the specified duration. Regular attendance is mandatory. 
            Students with less than <strong>75% attendance</strong> may not be eligible for certification.
        </li>
        <li>
            <strong>Examination &amp; Certification</strong><br>
            Students must pass the required examinations to receive certificates. Examination schedules are 
            determined by Maya Computer and cannot be changed on individual request.
        </li>
        <li>
            <strong>Code of Conduct</strong><br>
            Students must maintain discipline and decorum at the center. Any misconduct, cheating, or violation 
            of center rules may result in immediate termination without refund.
        </li>
        <li>
            <strong>Course Materials</strong><br>
            Course materials provided are for personal use only and cannot be copied, distributed, or shared 
            without written permission from Maya Computer.
        </li>
    </ol>

    <h2 style="color:#2a7ae2; margin-top:30px;">4. Franchise Terms &amp; Conditions</h2>
    <ol>
        <li>
            <strong>Authorization</strong><br>
            Franchisees are authorized to operate under the Maya Computer brand only after signing the 
            official Franchise Agreement and completing all registration formalities.
        </li>
        <li>
            <strong>Territory &amp; Operations</strong><br>
            Each franchise is granted a specific territory. Franchisees must operate within their designated 
            area and follow all operational guidelines provided by Maya Computer.
        </li>
        <li>
            <strong>Quality Standards</strong><br>
            Franchisees must maintain the quality standards set by Maya Computer in terms of infrastructure, 
            teaching quality, and student services. Periodic audits may be conducted.
        </li>
        <li>
            <strong>Branding &amp; Marketing</strong><br>
            Franchisees must use only approved branding materials and follow marketing guidelines. 
            Any unauthorized use of the Maya Computer brand or logo is strictly prohibited.
        </li>
        <li>
            <strong>Termination</strong><br>
            Maya Computer reserves the right to terminate the franchise agreement in case of violation of 
            terms, quality standards, or non-payment of dues after due notice.
        </li>
    </ol>

    <h2 style="color:#2a7ae2; margin-top:30px;">5. Payment Terms</h2>
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
            in the parent company's designated bank account or payment gateway.
            Unused credits, if any, will remain valid for the period specified in the franchise agreement.
        </li>
        <li>
            <strong>Mode of Payment</strong><br>
            Payments can be made via <strong>Bank Transfer (NEFT/RTGS/IMPS)</strong>, <strong>UPI</strong>,
            or <strong>approved online payment gateway</strong>.
            All payments must be made in the name of <strong>Maya Computer</strong> and are subject to applicable taxes and charges.
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
        <li>
            <strong>Student Course Fees</strong><br>
            Course fees must be paid as per the fee structure displayed at the center. 
            Fee payment modes and installment options (if available) will be communicated at the time of enrollment.
        </li>
    </ol>

    <h2 style="color:#2a7ae2; margin-top:30px;">6. Intellectual Property Rights</h2>
    <ol>
        <li>
            All content on this website including text, graphics, logos, images, course materials, and software 
            is the property of Maya Computer and is protected by intellectual property laws.
        </li>
        <li>
            The Maya Computer name, logo, and all related names, logos, product and service names, designs, 
            and slogans are trademarks of Maya Computer. You must not use such marks without prior written permission.
        </li>
        <li>
            Unauthorized reproduction, distribution, or modification of any content is strictly prohibited 
            and may result in legal action.
        </li>
    </ol>

    <h2 style="color:#2a7ae2; margin-top:30px;">7. Website Usage Terms</h2>
    <ol>
        <li>
            <strong>Acceptable Use</strong><br>
            You agree to use this website only for lawful purposes and in a way that does not infringe 
            the rights of others or restrict their use of the website.
        </li>
        <li>
            <strong>Account Security</strong><br>
            If you create an account on our website, you are responsible for maintaining the confidentiality 
            of your login credentials and for all activities under your account.
        </li>
        <li>
            <strong>Prohibited Activities</strong><br>
            You must not attempt to gain unauthorized access to any part of the website, introduce viruses 
            or malicious code, or engage in any activity that could damage or impair the website.
        </li>
    </ol>

    <h2 style="color:#2a7ae2; margin-top:30px;">8. Verification Services</h2>
    <p>
        Maya Computer provides online verification services for student registration, I-Cards, results, 
        and certificates. These services are provided for convenience and informational purposes. 
        For official verification required by employers or institutions, please contact our head office 
        for authenticated verification letters.
    </p>

    <h2 style="color:#2a7ae2; margin-top:30px;">9. Limitation of Liability</h2>
    <ol>
        <li>
            Maya Computer shall not be liable for any indirect, incidental, special, or consequential damages 
            arising from your use of our services or website.
        </li>
        <li>
            We do not guarantee employment or specific outcomes from completing our courses. 
            Career success depends on individual effort and market conditions.
        </li>
        <li>
            Maya Computer is not responsible for actions or services provided by individual franchise centers 
            beyond the scope of our oversight.
        </li>
    </ol>

    <h2 style="color:#2a7ae2; margin-top:30px;">10. Dispute Resolution</h2>
    <ol>
        <li>
            Any disputes arising from these terms shall first be attempted to be resolved through mutual 
            discussion and negotiation.
        </li>
        <li>
            If disputes cannot be resolved amicably, they shall be subject to arbitration in accordance 
            with the Arbitration and Conciliation Act, 1996.
        </li>
        <li>
            All disputes shall be subject to the exclusive jurisdiction of courts in <strong>Siwan, Bihar, India</strong>.
        </li>
    </ol>

    <h2 style="color:#2a7ae2; margin-top:30px;">11. Governing Law</h2>
    <p>
        These Terms and Conditions shall be governed by and construed in accordance with the laws of India. 
        Any legal proceedings arising out of or relating to these terms shall be brought exclusively in 
        the courts of competent jurisdiction in India.
    </p>

    <h2 style="color:#2a7ae2; margin-top:30px;">12. Modifications to Terms</h2>
    <p>
        Maya Computer reserves the right to modify these Terms and Conditions at any time without prior notice. 
        Changes will be effective immediately upon posting on this website. Your continued use of our services 
        after any changes indicates your acceptance of the modified terms.
    </p>

    <h2 style="color:#2a7ae2; margin-top:30px;">13. Severability</h2>
    <p>
        If any provision of these Terms and Conditions is found to be invalid or unenforceable, 
        the remaining provisions shall continue in full force and effect.
    </p>

    <h2 style="color:#2a7ae2; margin-top:30px;">14. Contact Information</h2>
    <p>
        For any questions regarding these Terms and Conditions, please contact:<br>
        <strong>Maya Computer</strong><br>
        Email: <a href="mailto:mccsiswar@gmail.com">mccsiswar@gmail.com</a><br>
        Phone: +91 8825148127
    </p>

    <p style="margin-top:30px; font-style:italic; color:#666;">
        <strong>Last Updated:</strong> {{ date('F Y') }}
    </p>

</section>
        	</div>
        </div>
        <!-- Contact Section End -->  
@endsection