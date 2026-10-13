<?php

namespace App\Services;

use App\Models\CompanyProfile;
use App\Models\GalleryImage;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Storage;

class ManagedUploadService
{
    /**
     * Whitelist of directories on the 'public' disk containing managed user uploads.
     */
    protected const ALLOWED_PREFIXES = [
        'uploads/gallery/',
        'uploads/projects/',
        'uploads/services/',
        'uploads/company/',
    ];

    /**
     * Determine whether a given path is demonstrably a managed upload eligible for deletion.
     */
    public static function isManagedUpload(?string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        // Static seeded and application assets must NEVER be treated as managed uploads
        $trimmed = ltrim($path, '/');
        if (str_starts_with($trimmed, 'images/') || str_starts_with($trimmed, 'public/images/')) {
            return false;
        }

        $relative = self::normalizePath($path);
        if ($relative === null) {
            return false;
        }

        foreach (self::ALLOWED_PREFIXES as $prefix) {
            if (str_starts_with($relative, $prefix)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Normalize a stored path into a relative disk path for the 'public' storage disk.
     * Prevents path traversal and rejects unsafe characters.
     */
    public static function normalizePath(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        // Reject directory traversal attempts or null byte injections
        if (str_contains($path, '..') || str_contains($path, '\\') || str_contains($path, "\0")) {
            return null;
        }

        $trimmed = ltrim($path, '/');
        if (str_starts_with($trimmed, 'storage/')) {
            $trimmed = substr($trimmed, strlen('storage/'));
        }

        return $trimmed;
    }

    /**
     * Check if a file path is referenced by any database record across the application.
     */
    public static function isReferenced(?string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        $relative = self::normalizePath($path);
        if ($relative === null) {
            return true; // Defensive: If path cannot be safely normalized, do not consider it unreferenced
        }

        $variants = array_values(array_unique([
            $path,
            $relative,
            'storage/' . $relative,
            '/' . $relative,
            '/storage/' . $relative,
        ]));

        if (GalleryImage::whereIn('image_path', $variants)->exists()) {
            return true;
        }

        if (Project::whereIn('main_image', $variants)->exists()) {
            return true;
        }

        if (ProjectImage::whereIn('image_path', $variants)->exists()) {
            return true;
        }

        if (Service::whereIn('image', $variants)->exists()) {
            return true;
        }

        if (CompanyProfile::whereIn('about_image', $variants)->orWhereIn('hero_image', $variants)->exists()) {
            return true;
        }

        if (ServiceCategory::whereIn('image', $variants)->exists()) {
            return true;
        }

        return false;
    }

    /**
     * Safely delete an uploaded file from disk if it is a managed upload and has no active DB references.
     */
    public static function deleteIfUnreferenced(?string $path): bool
    {
        if (! self::isManagedUpload($path)) {
            return false;
        }

        $relative = self::normalizePath($path);
        if ($relative === null) {
            return false;
        }

        // Must not be referenced by any existing record
        if (self::isReferenced($path)) {
            return false;
        }

        $disk = Storage::disk('public');
        if (! $disk->exists($relative)) {
            return false;
        }

        return $disk->delete($relative);
    }
}
