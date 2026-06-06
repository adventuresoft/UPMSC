<?php

// Global helper function to resolve image URLs for both local and deployed sites
if (!function_exists('imageUrl')) {
    /**
     * Get the correct image URL handling both local (/public) and production setups
     * 
     * @param string|null $imagePath
     * @param string|null $fallback
     * @return string
     */
    function imageUrl($imagePath, $fallback = null)
    {
        $imagePath = trim((string) $imagePath);
        if ($imagePath === '') {
            return asset($fallback ?? 'assets/images/logo/govt-bd-logo.png');
        }

        if (preg_match('/^(https?:)?\/\//i', $imagePath)) {
            return $imagePath;
        }

        $normalizedPath = ltrim($imagePath, '/');
        if (str_starts_with($normalizedPath, 'public/')) {
            $normalizedPath = substr($normalizedPath, strlen('public/'));
        }
        // If path starts with 'uploads/', it's stored in root/uploads on production
        if (str_starts_with($normalizedPath, 'uploads/')) {
            return url('/' . $normalizedPath);
        }

        // Otherwise use asset() for regular assets
        return asset($normalizedPath);
    }
}
