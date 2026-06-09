<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AdaReachSmsService
{
    protected string $username;
    protected string $password;
    protected string $sender;
    protected string $baseUrl;

    // Cache keys
    protected const TOKEN_CACHE_KEY         = 'adarreach_token';
    protected const REFRESH_TOKEN_CACHE_KEY = 'adarreach_refresh_token';
    // Token validity is 1 hour; cache for 55 min to be safe
    protected const TOKEN_TTL_MINUTES = 55;

    public function __construct()
    {
        $this->username = config('sms.adarreach_username', '');
        $this->password = config('sms.adarreach_password', '');
        $this->sender   = config('sms.adarreach_sender_id', '');
        $this->baseUrl  = rtrim(config('sms.adarreach_base_url', 'https://api.mobireach.com.bd'), '/');
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Public: Send SMS
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Send a transactional SMS to one phone number.
     *
     * @param  string  $phone   Recipient (01XXXXXXXXX or 8801XXXXXXXXX)
     * @param  string  $message Message body (Unicode/Bengali = contentType 2)
     * @return array   ['success' => bool, 'response' => mixed]
     */
    public function send(string $phone, string $message): array
    {
        $phone = $this->normalizePhone($phone);
        $sender = $this->sender; // Use raw config sender (worked for ID 116)

        // Detect if message contains Bengali / non-ASCII → use contentType 2 (Unicode)
        $contentType = $this->isUnicode($message) ? 2 : 1;

        try {
            $token = $this->getToken();

            if (!$token) {
                Log::error('[AdaReachSMS] Could not obtain auth token.');
                return ['success' => false, 'response' => 'Auth token failed'];
            }

            // Ensure phone number is in correct format (MSISDN: 8801xxxxxxxxx)
            $phone = preg_replace('/[^0-9]/', '', $phone);
            if (strlen($phone) === 11 && strpos($phone, '01') === 0) {
                $phone = '88' . $phone;
            }

            $payload = [
                'sender'      => $sender,
                'receiver'    => [$phone],          // Array of MSISDNs (worked for ID 116)
                'content'     => $message,
                'msgType'     => 'T',               // T = Transactional
                'requestType' => 'S',               // S = Single
                'contentType' => $contentType,      // 1 = Regular, 2 = Unicode
            ];

            Log::info('[AdaReachSMS] Sending request', ['payload' => $payload]);

            $response = Http::withoutVerifying()
                ->timeout(60)  // Increased from 20 → 60 seconds
                ->connectTimeout(30)
                ->withHeaders([
                    'Authorization' => "Bearer {$token}",
                    'Content-Type'  => 'application/json',
                ])
                ->post("{$this->baseUrl}/sms/send", $payload);

            $body = $response->json();

            // Broad success check: handle both status=SUCCESS and responseCode=200
            $success = $response->successful()
                && (
                    (isset($body['status']) && strtoupper($body['status']) === 'SUCCESS') ||
                    (isset($body['responseCode']) && $body['responseCode'] == 200) ||
                    (isset($body['responseCode']) && $body['responseCode'] == "0")
                );

            Log::info('[AdaReachSMS] Send result', [
                'phone'    => $phone,
                'status'   => $response->status(),
                'body'     => $body,
                'success'  => $success
            ]);

            return ['success' => $success, 'response' => $body];

        } catch (\Throwable $e) {
            Log::error('[AdaReachSMS] Exception while sending SMS', [
                'phone' => $phone,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'response' => $e->getMessage()];
        }
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Public: Build Approval SMS Text
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Build the welcome/approval SMS message in Bangla.
     */
    public static function buildApprovalMessage(
        string $name,
        string $loginId,
        string $password,
        string $approvedId
    ): string {
        return "Mr. {$name} Your application approved\n"
            . "Reg ID: {$approvedId}\n"
            . "Password: {$password}\n"
            . "ধন্যবাদ।";
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Token Management
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Get a valid access token — from cache, refresh, or fresh login.
     */
    protected function getToken(): ?string
    {
        // 1. Return cached token if available
        if (Cache::has(self::TOKEN_CACHE_KEY)) {
            return Cache::get(self::TOKEN_CACHE_KEY);
        }

        // 2. Try refreshing using the cached refresh_token
        $refreshToken = Cache::get(self::REFRESH_TOKEN_CACHE_KEY);
        if ($refreshToken) {
            $tokens = $this->refreshToken($refreshToken);
            if ($tokens) {
                $this->cacheTokens($tokens);
                return $tokens['token'];
            }
        }

        // 3. Fall back to full login
        $tokens = $this->login();
        if ($tokens) {
            $this->cacheTokens($tokens);
            return $tokens['token'];
        }

        return null;
    }

    /**
     * Authenticate and get a new token pair.
     */
    protected function login(): ?array
    {
        try {
            $response = Http::withoutVerifying()
                ->timeout(60)  // Increased from 15 → 60 seconds
                ->connectTimeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post("{$this->baseUrl}/auth/tokens", [
                    'username' => $this->username,
                    'password' => $this->password,
                ]);

            $body = $response->json();

            if ($response->successful() && !empty($body['token'])) {
                Log::info('[AdaReachSMS] Login successful');
                return $body;
            }

            Log::warning('[AdaReachSMS] Login failed', ['body' => $body]);
            return null;

        } catch (\Throwable $e) {
            Log::error('[AdaReachSMS] Login exception', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Use refresh_token to get a new access token.
     */
    protected function refreshToken(string $refreshToken): ?array
    {
        try {
            $response = Http::withoutVerifying()
                ->timeout(60)  // Increased from 15 → 60 seconds
                ->connectTimeout(30)
                ->withHeaders([
                    'Content-Type'  => 'application/json',
                    'Authorization' => "Bearer {$refreshToken}",
                ])
                ->post("{$this->baseUrl}/auth/token/refresh");

            $body = $response->json();

            if ($response->successful() && !empty($body['token'])) {
                Log::info('[AdaReachSMS] Token refreshed successfully');
                return $body;
            }

            // Refresh failed — clear cached refresh token so we do a fresh login next time
            Cache::forget(self::REFRESH_TOKEN_CACHE_KEY);
            Log::warning('[AdaReachSMS] Token refresh failed', ['body' => $body]);
            return null;

        } catch (\Throwable $e) {
            Log::error('[AdaReachSMS] Refresh exception', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Store both tokens in cache for 55 minutes.
     */
    protected function cacheTokens(array $tokens): void
    {
        $ttl = now()->addMinutes(self::TOKEN_TTL_MINUTES);

        Cache::put(self::TOKEN_CACHE_KEY,         $tokens['token'],         $ttl);
        Cache::put(self::REFRESH_TOKEN_CACHE_KEY, $tokens['refresh_token'], $ttl);
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Helpers
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Normalize BD phone to 13-digit MSISDN: 8801XXXXXXXXX
     */
    protected function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (str_starts_with($phone, '880')) {
            return $phone;                   // already 8801XXXXXXXXX
        }
        if (str_starts_with($phone, '01')) {
            return '880' . substr($phone, 1); // 01XXXXXXXXX → 8801XXXXXXXXX (13 digits)
        }
        if (str_starts_with($phone, '1') && strlen($phone) === 10) {
            return '88001' . substr($phone, 1); // 1XXXXXXXXX → 8801XXXXXXXXX
        }

        return $phone;
    }

    /**
     * Detect if the message contains non-ASCII (Bengali) characters.
     * If so, use Unicode contentType = 2.
     */
    protected function isUnicode(string $text): bool
    {
        return strlen($text) !== mb_strlen($text, 'UTF-8')
            || preg_match('/[^\x00-\x7F]/', $text);
    }
}
