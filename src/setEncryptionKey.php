<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("Folded\setEncryptionKey")) {
    /**
     * Set the key that is used as a salt to improve the security of the encrypted strings.
     *
     * @param string $key    The key to be used as a salt.
     * @param string $cipher The cipher algorithm to use (default: AES-256-CBC).
     *
     * @throws InvalidArgumentException If the cipher is incorrect.
     * @throws InvalidArgumentException If the cipher is empty.
     * @throws InvalidArgumentException If the key is empty.
     *
     * @since 0.1.0
     *
     * @example
     * setEncryptionKey("...");
     */
    function setEncryptionKey(string $key, string $cipher = Crypt::DEFAULT_CIPHER): void
    {
        Crypt::setKey($key, $cipher);
    }
}
