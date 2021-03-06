<?php

declare(strict_types = 1);

namespace Folded;

use Exception;

if (!function_exists("Folded\getEncryptedString")) {
    /**
     * Encrypts a strings.
     *
     * @param string $data The text to encrypt.
     *
     * @throws Exception If the key has not been set.
     *
     * @since 0.1.0
     *
     * @example
     * getEncryptedString("foo");
     */
    function getEncryptedString(string $data): string
    {
        return Crypt::getEncryptedString($data);
    }
}
