<?php

declare(strict_types = 1);

use Folded\Crypt;

beforeEach(function (): void {
    Crypt::clear();
});

it("should decrypt the encrypted string", function (): void {
    $data = "Hello world";

    Crypt::setKey(Crypt::getKey());

    $encryptedString = Crypt::getEncryptedString($data);

    expect(Crypt::getDecryptedString($encryptedString))->toBe($data);
});

it("should throw an exception if the key has not been set", function (): void {
    $this->expectException(Exception::class);

    Crypt::getEncryptedString("foo");
});

it("should throw an exception message if the key has not been set", function (): void {
    $this->expectExceptionMessage("key has not been set");

    Crypt::getEncryptedString("foo");
});

it("should throw an exception if the cipher is empty", function (): void {
    $this->expectException(InvalidArgumentException::class);

    Crypt::setKey("foo", "");
});

it("should throw an exception message if the cipher is empty", function (): void {
    $this->expectExceptionMessage("cipher is empty");

    Crypt::setKey("foo", "");
});

it("should throw an exception if the key is empty", function (): void {
    $this->expectException(InvalidArgumentException::class);

    Crypt::setKey("");
});

it("should throw an exception message if the key is empty", function (): void {
    $this->expectExceptionMessage("key is empty");

    Crypt::setKey("");
});

it("should throw an exception if the cipher is not correct", function (): void {
    $this->expectException(InvalidArgumentException::class);

    Crypt::setKey("foo", "bar");
});

it("should throw an exception message if the cipher is not correct", function (): void {
    $this->expectExceptionMessage("cipher bar not allowed (allowed: AES-128-CBC, AES-256-CBC)");

    Crypt::setKey("foo", "bar");
});
