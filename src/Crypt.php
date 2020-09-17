<?php

declare(strict_types = 1);

namespace Folded;

use Exception;
use Illuminate\Encryption\Encrypter;
use InvalidArgumentException;

/**
 * Encrypts and decrypts strings.
 *
 * @since 0.1.0
 */
class Crypt
{
    /**
     * @since 0.1.0
     */
    const ALLOWED_CIPHERS = [
        "AES-128-CBC",
        "AES-256-CBC",
    ];

    /**
     * @since 0.1.0
     */
    const DEFAULT_CIPHER = "AES-256-CBC";

    /**
     * The cipher to use for the key.
     *
     * @since 0.1.0
     */
    private static string $cipher = self::DEFAULT_CIPHER;

    /**
     * The engine that will encrypt and decrypt strings.
     *
     * @since 0.1.0
     */
    private static ?Encrypter $engine = null;

    /**
     * The encryption key used as a salt to improve the security of encrypted strings.
     *
     * @since 0.1.0
     */
    private static string $key = "";

    /**
     * Clear the state.
     * Useful for unit testing.
     *
     * @since 0.1.0
     *
     * @example
     * Crypt::clear();
     */
    public static function clear(): void
    {
        self::$key = "";
        self::$cipher = "";
        self::$engine = null;
    }

    /**
     * Get the decrypted string from an encrypted string.
     *
     * @param string $cryptedString The encrypted string.
     *
     * @throws Exception If the key has not been set.
     *
     * @since 0.1.0
     *
     * @example
     * Crypt::getDecryptedString("...");
     */
    public static function getDecryptedString(string $cryptedString): string
    {
        self::checkKeySet();

        return self::engine()->decryptString($cryptedString);
    }

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
     * Crypt::getEncryptedString("foo");
     */
    public static function getEncryptedString(string $data): string
    {
        self::checkKeySet();

        return self::engine()->encryptString($data);
    }

    /**
     * Get a random secure key to be used to encrypt strings with this library.
     *
     * @param string $cipher The cipher to use (default: AES-256-CBC).
     *
     * @since 0.1.0
     *
     * @example
     * Crypt::getKey();
     */
    public static function getKey(string $cipher = self::DEFAULT_CIPHER): string
    {
        self::checkCipher($cipher);

        return base64_encode(Encrypter::generateKey($cipher));
    }

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
     * Crypt::setKey("...");
     */
    public static function setKey(string $key, string $cipher = self::DEFAULT_CIPHER): void
    {
        if (empty(trim($key))) {
            throw new InvalidArgumentException("key is empty");
        }

        if (empty(trim($cipher))) {
            throw new InvalidArgumentException("cipher is empty");
        }

        self::checkCipher($cipher);

        self::$key = base64_decode($key, true);
        self::$cipher = $cipher;
    }

    /**
     * Throws an exception if the cipher is incorrect.
     *
     * @throws InvalidArgumentException If the cipher is not correct.
     *
     * @since 0.1.0
     *
     * @example
     * Crypt::checkCipher();
     */
    private static function checkCipher(string $cipher): void
    {
        if (!in_array($cipher, self::ALLOWED_CIPHERS, true)) {
            throw new InvalidArgumentException("cipher $cipher not allowed (allowed: " . implode(", ", self::ALLOWED_CIPHERS) . ")");
        }
    }

    /**
     * Throws an exception if the key is not correct.
     *
     * @throws Exception If the key is not set.
     *
     * @since 0.1.0
     *
     * @example
     * Crypt::checkKeySet();
     */
    private static function checkKeySet(): void
    {
        if (empty(trim(self::$key))) {
            throw new Exception("key has not been set");
        }
    }

    /**
     * Returns an engine that encrypts and decrypts strings (acting as a singleton).
     *
     * @since 0.1.0
     *
     * @example
     * $engine = Crypt::engine();
     */
    private static function engine(): Encrypter
    {
        if (!(self::$engine instanceof Encrypter)) {
            self::$engine = new Encrypter(self::$key, self::$cipher);
        }

        return self::$engine;
    }
}
