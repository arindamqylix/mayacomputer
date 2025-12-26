<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('site_settings')) {
    function site_settings() {
        return DB::table('site_settings')->where('id', 1)->first();
    }
}

if (!function_exists('breadcrumb_image')) {
    function breadcrumb_image() {
        $data = site_settings();
        return $data ? asset($data->breadcumb_image) : '';
    }
}

if (!function_exists('getFinancialYear')) {
    /**
     * Get current financial year in format YYYY-YY
     * Financial year runs from April to March
     * Example: April 2025 to March 2026 = 2025-26
     */
    function getFinancialYear($date = null) {
        if ($date === null) {
            $date = now();
        } elseif (is_string($date)) {
            $date = \Carbon\Carbon::parse($date);
        }
        
        $year = $date->year;
        $month = $date->month;
        
        // If month is April (4) or later, financial year starts this year
        // If month is January-March (1-3), financial year started last year
        if ($month >= 4) {
            $fyStart = $year;
            $fyEnd = $year + 1;
        } else {
            $fyStart = $year - 1;
            $fyEnd = $year;
        }
        
        // Format: 2025-26
        $fyEndShort = substr($fyEnd, -2);
        return $fyStart . '-' . $fyEndShort;
    }
}

if (!function_exists('generateInvoiceNumber')) {
    /**
     * Generate invoice number in format: MCC/YYYY-YY/NN
     * Example: MCC/2025-26/01
     * 
     * @param string $table Table name to check for existing invoices
     * @param string $dateColumn Column name for date (default: 'created_at')
     * @param string $invoiceColumn Column name for invoice number (default: 'invoice_no')
     * @param \Carbon\Carbon|null $date Date to use for financial year (default: now)
     * @return string Invoice number
     */
    function generateInvoiceNumber($table = 'center_recharge', $dateColumn = 'created_at', $invoiceColumn = 'invoice_no', $date = null) {
        if ($date === null) {
            $date = now();
        } elseif (is_string($date)) {
            $date = \Carbon\Carbon::parse($date);
        }
        
        $financialYear = getFinancialYear($date);
        
        // Get the last invoice number for this financial year
        $lastInvoice = DB::table($table)
            ->where($invoiceColumn, 'like', 'MCC/' . $financialYear . '/%')
            ->orderBy($invoiceColumn, 'desc')
            ->first();
        
        if ($lastInvoice && !empty($lastInvoice->$invoiceColumn)) {
            // Extract the sequential number from last invoice
            // Format: MCC/2025-26/01
            $parts = explode('/', $lastInvoice->$invoiceColumn);
            if (count($parts) === 3) {
                $lastNumber = (int) $parts[2];
                $nextNumber = $lastNumber + 1;
            } else {
                $nextNumber = 1;
            }
        } else {
            // First invoice for this financial year
            $nextNumber = 1;
        }
        
        // Format: MCC/2025-26/01
        $invoiceNumber = 'MCC/' . $financialYear . '/' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
        
        return $invoiceNumber;
    }
}