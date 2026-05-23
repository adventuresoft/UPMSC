<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Get the correct image URL for deployed sites where public folder is in root
     * Handles both local (with /public) and production (without /public) setups
     */
    public static function getImageUrl($imagePath, $fallback = null)
    {
        $imagePath = trim((string) $imagePath);
        if ($imagePath === '') {
            return $fallback ? asset($fallback) : asset('assets/images/logo/govt-bd-logo.png');
        }

            if (preg_match('/^(https?:)?\/\//i', $imagePath)) {
                return $imagePath;
            }

            $normalizedPath = ltrim($imagePath, '/');
            if (str_starts_with($normalizedPath, 'public/')) {
                $normalizedPath = substr($normalizedPath, strlen('public/'));
            }
            if (str_starts_with($normalizedPath, 'uploads/')) {
                return url('/' . $normalizedPath);
        }

        // Otherwise use asset() for regular assets
            return asset($normalizedPath);
    }

    /**
     * Get institute image URL
     */
    public static function getInstituteImageUrl($institute, $imageType = 'left', $fallback = null)
    {
        if (!$institute) {
            return $fallback ? asset($fallback) : asset('assets/images/logo/govt-bd-logo.png');
        }

        $imageAttr = $imageType . '_image';
        $imagePath = $institute->{$imageAttr} ?? null;

        return self::getImageUrl($imagePath, $fallback);
    }
}
