@extends('frontend.layouts.master')
@section('title','Startup India Certificate')
@push('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Times New Roman', serif;
        background: #f5f5f5;
        padding: 20px;
    }

    .certificate-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        background: #fff;
        padding: 40px;
    }

    .certificate-container {
        position: relative;
        background: #f8f6f0;
        background-image: 
            radial-gradient(circle at 2px 2px, rgba(200, 180, 160, 0.15) 1px, transparent 0);
        background-size: 40px 40px;
        border: 12px solid #1a3a8f;
        padding: 60px 50px;
        min-height: 850px;
        position: relative;
        overflow: hidden;
    }


    .certificate-content {
        position: relative;
        z-index: 1;
    }

    /* Top Section */
    .certificate-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 40px;
        position: relative;
    }

    .certificate-number {
        font-size: 14px;
        font-weight: bold;
        color: #000;
        position: absolute;
        top: 0;
        left: 0;
    }

    .certificate-number span {
        font-weight: normal;
        margin-left: 5px;
    }

    .emblem-section {
        flex: 1;
        text-align: center;
        margin: 0 30px;
    }

    .emblem-container {
        width: 120px;
        height: 120px;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #1a3a8f;
        border-radius: 50%;
        background: #fff;
        padding: 10px;
    }

    .emblem-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #1a3a8f 0%, #2d5aa0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 10px;
        text-align: center;
        line-height: 1.2;
    }

    .emblem-motto {
        font-size: 12px;
        font-weight: bold;
        color: #000;
        margin-top: 5px;
        font-family: 'Times New Roman', serif;
    }

    .govt-text {
        text-align: center;
        margin-top: 15px;
    }

    .govt-text h2 {
        font-size: 22px;
        font-weight: bold;
        color: #000;
        margin-bottom: 8px;
        letter-spacing: 1px;
    }

    .govt-text h3 {
        font-size: 18px;
        font-weight: bold;
        color: #000;
        margin-bottom: 5px;
        letter-spacing: 0.5px;
    }

    .govt-text p {
        font-size: 16px;
        color: #000;
        margin-bottom: 3px;
        line-height: 1.4;
    }

    .startup-india-logo {
        position: absolute;
        top: 0;
        right: 0;
        text-align: right;
    }

    .startup-logo-text {
        font-size: 28px;
        font-weight: bold;
        letter-spacing: 1px;
        position: relative;
        display: inline-block;
        line-height: 1.2;
    }

    .startup-logo-text .hash {
        color: #00a651;
    }

    .startup-logo-text .text {
        color: #ff6600;
    }

    .startup-arrow {
        display: inline-block;
        width: 20px;
        height: 20px;
        background: linear-gradient(135deg, #ff6600 0%, #ff8533 100%);
        clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        margin-left: 5px;
        vertical-align: middle;
        margin-bottom: 3px;
    }

    /* Main Title */
    .certificate-title {
        text-align: center;
        margin: 50px 0 40px;
        position: relative;
    }

    .title-decorative-left,
    .title-decorative-right {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 48px;
        color: #1a3a8f;
        opacity: 0.5;
        font-family: serif;
    }

    .title-decorative-left {
        left: 80px;
    }

    .title-decorative-right {
        right: 80px;
    }

    .title-decorative-left::before {
        content: '❋';
    }

    .title-decorative-right::before {
        content: '❋';
    }

    .certificate-title h1 {
        font-size: 42px;
        font-weight: bold;
        color: #1a3a8f;
        letter-spacing: 8px;
        text-transform: uppercase;
        margin: 0;
        font-family: 'Times New Roman', serif;
    }

    /* Certificate Body */
    .certificate-body {
        margin: 40px 0;
        line-height: 1.8;
        font-size: 17px;
        color: #000;
        text-align: justify;
    }

    .certificate-body p {
        margin-bottom: 20px;
        text-indent: 40px;
    }

    .certificate-body strong {
        font-weight: bold;
        color: #000;
    }

    .company-name {
        font-size: 20px;
        font-weight: bold;
        color: #000;
    }

    .company-type {
        font-weight: bold;
        color: #000;
    }

    .incorporation-date {
        font-weight: bold;
        color: #000;
    }

    .industry-sector {
        font-weight: bold;
        color: #000;
    }

    .validity-conditions {
        margin-top: 30px;
        font-size: 16px;
        line-height: 1.8;
    }

    .validity-conditions strong {
        font-weight: bold;
        color: #000;
    }

    /* Bottom Section */
    .certificate-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 60px;
        position: relative;
    }

    .issue-date-section,
    .valid-until-section {
        flex: 1;
        text-align: center;
    }

    .date-label {
        font-size: 14px;
        font-weight: bold;
        color: #000;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .date-value {
        font-size: 16px;
        font-weight: bold;
        color: #000;
        border-top: 2px solid #000;
        padding-top: 5px;
        display: inline-block;
        min-width: 120px;
    }

    .qr-section {
        flex: 1;
        text-align: center;
        position: relative;
        padding: 0 20px;
    }

    .qr-wreath {
        position: relative;
        display: inline-block;
        width: 200px;
        height: 200px;
        margin-bottom: 10px;
    }

    /* Laurel wreath decorative elements */
    .qr-wreath::before {
        content: '';
        position: absolute;
        top: -15px;
        left: -15px;
        width: 230px;
        height: 230px;
        border: 4px solid #d4af37;
        border-radius: 50%;
        border-top-color: transparent;
        border-right-color: transparent;
        border-bottom-width: 2px;
        transform: rotate(-45deg);
    }

    .qr-wreath::after {
        content: '';
        position: absolute;
        bottom: -15px;
        right: -15px;
        width: 230px;
        height: 230px;
        border: 4px solid #d4af37;
        border-radius: 50%;
        border-bottom-color: transparent;
        border-left-color: transparent;
        border-top-width: 2px;
        transform: rotate(135deg);
    }

    .qr-code-container {
        width: 140px;
        height: 140px;
        background: #fff;
        border: 2px solid #000;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 20px auto;
        position: relative;
        z-index: 1;
    }

    .qr-placeholder {
        font-size: 12px;
        color: #666;
        text-align: center;
    }

    .scan-verify {
        font-size: 14px;
        font-weight: bold;
        color: #000;
        margin-top: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Print Styles */
    @media print {
        body {
            background: #fff;
            padding: 0;
        }

        .certificate-wrapper {
            max-width: 100%;
            padding: 0;
        }

        .certificate-container {
            border: 8px solid #1a3a8f;
            page-break-after: avoid;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .certificate-container {
            padding: 30px 20px;
        }

        .certificate-header {
            flex-direction: column;
            align-items: center;
        }

        .certificate-number {
            position: relative;
            margin-bottom: 20px;
        }

        .startup-india-logo {
            position: relative;
            margin-top: 20px;
        }

        .certificate-title h1 {
            font-size: 28px;
            letter-spacing: 4px;
        }

        .title-decorative-left,
        .title-decorative-right {
            display: none;
        }

        .certificate-footer {
            flex-direction: column;
            gap: 30px;
        }
    }
</style>
@endpush
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
                    <h1 class="page-title">Startup India Certificate</h1>
                    <ul>
                        <li>
                            <a class="active" href="{{url('/')}}">Home</a>
                        </li>
                        <li>Startup India Certificate</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->

<div class="certificate-wrapper mt-5 mb-5">
    <div class="certificate-container">
        <div class="certificate-content">
            <!-- Top Section -->
            <div class="certificate-header">
                <div class="certificate-number">
                    CERTIFICATE NO: <span>DIPP164986</span>
                </div>

                <div class="emblem-section">
                    <div class="emblem-container">
                        <div class="emblem-placeholder">
                            <div>
                                LION<br>
                                CAPITAL<br>
                                ASHOKA
                            </div>
                        </div>
                    </div>
                    <div class="emblem-motto">सत्यमेव जयते</div>
                    
                    <div class="govt-text">
                        <h2>Government of India</h2>
                        <h3>Ministry of Commerce & Industry</h3>
                        <p>Department for Promotion of Industry and Internal Trade</p>
                    </div>
                </div>

                <div class="startup-india-logo">
                    <div class="startup-logo-text">
                        <span class="hash">#</span><span class="text">startupindia</span><span class="startup-arrow"></span>
                    </div>
                </div>
            </div>

            <!-- Certificate Title -->
            <div class="certificate-title">
                <div class="title-decorative-left"></div>
                <h1>CERTIFICATE OF RECOGNITION</h1>
                <div class="title-decorative-right"></div>
            </div>

            <!-- Certificate Body -->
            <div class="certificate-body">
                <p>
                    This is to certify that <strong class="company-name">MAYA COMPUTER CENTER PRIVATE LIMITED</strong> incorporated as a <strong class="company-type">Private Limited Company</strong> on <strong class="incorporation-date">06-11-2023</strong>, is recognized as a startup by the Department for Promotion of Industry and Internal Trade. The startup is working in <strong class="industry-sector">'Education'</strong> Industry and <strong class="industry-sector">'Skill Development'</strong> sector as self-certified by them.
                </p>

                <div class="validity-conditions">
                    <p>
                        This certificate shall only be valid for the Entity up to <strong>Ten years</strong> from the date of its incorporation only if its turnover for any of the financial years has not extended <strong>₹ 100 Cr.</strong>
                    </p>
                </div>
            </div>

            <!-- Footer Section -->
            <div class="certificate-footer">
                <div class="issue-date-section">
                    <div class="date-label">Date of Issue</div>
                    <div class="date-value">08-05-2024</div>
                </div>

                <div class="qr-section">
                    <div class="qr-wreath">
                        <div class="qr-code-container">
                            <div class="qr-placeholder">
                                QR<br>CODE
                            </div>
                        </div>
                    </div>
                    <div class="scan-verify">Scan to Verify</div>
                </div>

                <div class="valid-until-section">
                    <div class="date-label">Valid Upto</div>
                    <div class="date-value">05-11-2033</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
