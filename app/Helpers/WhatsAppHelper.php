<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

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

            // Replace variables in the message
            foreach ($variables as $key => $value) {
                $message = str_replace('{' . $key . '}', $value, $message);
            }

            // Check if there are any unreplaced variables
            if (preg_match('/\{([^}]+)\}/', $message, $matches)) {
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
     * Send WhatsApp message via API
     * 
     * @param string $phoneNumber Phone number with country code
     * @param string $message Message content
     * @return array Returns ['success' => bool, 'message' => string, 'data' => mixed]
     */
    function sendWhatsAppViaAPI($phoneNumber, $message)
    {
        // Get WhatsApp API configuration from site settings or .env
        $apiUrl = env('WHATSAPP_API_URL', '');
        $apiKey = env('WHATSAPP_API_KEY', '');
        $instanceId = env('WHATSAPP_INSTANCE_ID', '');

        // If no API configuration, return error
        if (empty($apiUrl) || empty($apiKey)) {
            return [
                'success' => false,
                'message' => 'WhatsApp API not configured. Please set WHATSAPP_API_URL and WHATSAPP_API_KEY in .env file.',
                'data' => null
            ];
        }

        try {
            // Example API call structure (adjust based on your WhatsApp API provider)
            // This is a generic structure - you'll need to adapt it to your specific API
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post($apiUrl, [
                'instance_id' => $instanceId,
                'to' => $phoneNumber,
                'message' => $message,
                'type' => 'text'
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'WhatsApp message sent successfully',
                    'data' => $response->json()
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'WhatsApp API returned an error: ' . $response->body(),
                    'data' => $response->json()
                ];
            }

        } catch (\Exception $e) {
            Log::error('WhatsApp API call failed', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage()
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

