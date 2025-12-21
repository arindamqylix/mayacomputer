<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

if (!function_exists('send_whatsapp_message')) {
    /**
     * Send WhatsApp message using a template
     * 
     * @param string|int $templateIdentifier Template ID or Template Name
     * @param string $phoneNumber Phone number with country code (e.g., 919876543210)
     * @param array $variables Array of variables to replace in template (e.g., ['name' => 'John', 'course' => 'DCA'])
     * @return array Returns ['success' => bool, 'message' => string, 'data' => mixed]
     */
    function send_whatsapp_message($templateIdentifier, $phoneNumber, $variables = [])
    {
        try {
            // Fetch template by ID or name
            $template = null;
            if (is_numeric($templateIdentifier)) {
                $template = DB::table('whatsapp_templates')
                    ->where('id', $templateIdentifier)
                    ->where('status', 'active')
                    ->first();
            } else {
                $template = DB::table('whatsapp_templates')
                    ->where('template_name', $templateIdentifier)
                    ->where('status', 'active')
                    ->first();
            }

            if (!$template) {
                return [
                    'success' => false,
                    'message' => 'WhatsApp template not found or inactive',
                    'data' => null
                ];
            }

            // Get the message content
            $message = $template->message;

            // Replace variables in the message (supporting {{variable}} format)
            foreach ($variables as $key => $value) {
                // Replace both {{key}} and {key} formats for backward compatibility
                $message = str_replace('{{' . $key . '}}', $value, $message);
                $message = str_replace('{' . $key . '}', $value, $message);
            }

            // Check if there are any unreplaced variables
            if (preg_match('/\{\{([^}]+)\}\}/', $message, $matches) || preg_match('/\{([^}]+)\}/', $message, $matches)) {
                Log::warning('WhatsApp message has unreplaced variables', [
                    'template_id' => $template->id,
                    'unreplaced_vars' => $matches[1]
                ]);
            }

            // Send WhatsApp message using API
            $result = sendWhatsAppViaAPI($phoneNumber, $message);

            // Log the WhatsApp message sending
            DB::table('whatsapp_message_logs')->insert([
                'template_id' => $template->id,
                'template_name' => $template->template_name,
                'phone_number' => $phoneNumber,
                'message' => $message,
                'variables' => json_encode($variables),
                'status' => $result['success'] ? 'sent' : 'failed',
                'response' => json_encode($result),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return $result;

        } catch (\Exception $e) {
            Log::error('WhatsApp message sending failed', [
                'template' => $templateIdentifier,
                'phone' => $phoneNumber,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to send WhatsApp message: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }
}

if (!function_exists('sendWhatsAppViaAPI')) {
    /**
     * Send WhatsApp message via API using cURL
     * 
     * @param string $phoneNumber Phone number with country code (e.g., +919876543210)
     * @param string $message Message content
     * @return array Returns ['success' => bool, 'message' => string, 'data' => mixed]
     */
    function sendWhatsAppViaAPI($phoneNumber, $message)
    {
        // Get WhatsApp API configuration from .env
        $apiUrl = env('WHATSAPP_API_URL', 'http://localhost/arindam/whatsapp_sms_api/project/public/api/v1/messages/send');
        $apiKey = env('WHATSAPP_API_KEY', '');

        // If no API key, return error
        if (empty($apiKey)) {
            return [
                'success' => false,
                'message' => 'WhatsApp API not configured. Please set WHATSAPP_API_KEY in .env file.',
                'data' => null
            ];
        }

        // Ensure phone number has + prefix
        if (!str_starts_with($phoneNumber, '+')) {
            $phoneNumber = '+' . ltrim($phoneNumber, '0');
        }

        try {
            // Initialize cURL
            $ch = curl_init($apiUrl);

            // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'X-API-Key: ' . $apiKey
            ]);

            // Prepare POST data
            $postData = [
                'to' => $phoneNumber,
                'message' => $message
            ];

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

            // Execute cURL request
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);

            curl_close($ch);

            // Check for cURL errors
            if ($curlError) {
                Log::error('WhatsApp API cURL error', [
                    'phone' => $phoneNumber,
                    'error' => $curlError
                ]);

                return [
                    'success' => false,
                    'message' => 'cURL error: ' . $curlError,
                    'data' => null
                ];
            }

            // Decode response
            $responseData = json_decode($response, true);

            // Check HTTP status code
            if ($httpCode >= 200 && $httpCode < 300) {
                return [
                    'success' => true,
                    'message' => 'WhatsApp message sent successfully',
                    'data' => $responseData
                ];
            } else {
                Log::error('WhatsApp API returned error', [
                    'phone' => $phoneNumber,
                    'http_code' => $httpCode,
                    'response' => $response
                ]);

                return [
                    'success' => false,
                    'message' => 'WhatsApp API returned an error (HTTP ' . $httpCode . '): ' . ($responseData['message'] ?? $response),
                    'data' => $responseData
                ];
            }

        } catch (\Exception $e) {
            Log::error('WhatsApp API call failed', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to call WhatsApp API: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }
}

if (!function_exists('get_whatsapp_template')) {
    /**
     * Get WhatsApp template by ID or name
     * 
     * @param string|int $templateIdentifier Template ID or Template Name
     * @return object|null Template object or null if not found
     */
    function get_whatsapp_template($templateIdentifier)
    {
        if (is_numeric($templateIdentifier)) {
            return DB::table('whatsapp_templates')
                ->where('id', $templateIdentifier)
                ->where('status', 'active')
                ->first();
        } else {
            return DB::table('whatsapp_templates')
                ->where('template_name', $templateIdentifier)
                ->where('status', 'active')
                ->first();
        }
    }
}

