<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("getDecryptedString")) {
    /**
     * Get the decrypted string from an encrypted string.
     *
     * @throws Exception If the key has not been set.
     *
     * @since 0.1.0
     *
     * @example
     * getDecryptedString("...");
     */
    function getDecryptedString(string $encryptedString): string
    {
        return Crypt::getDecryptedString($encryptedString);
    }
}
