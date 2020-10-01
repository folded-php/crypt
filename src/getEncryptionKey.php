<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("Folded\getEncryptionKey")) {
    /**
     * Get a random secure key to be used to encrypt strings with this library.
     *
     * @param string $cipher The cipher to use (default: AES-256-CBC).
     *
     * @since 0.1.0
     *
     * @example
     * getEncryptionKey();
     */
    function getEncryptionKey(string $cipher = Crypt::DEFAULT_CIPHER): string
    {
        return Crypt::getKey($cipher);
    }
}
