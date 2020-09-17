<?php

declare(strict_types = 1);

use Folded\Crypt;
use function Folded\getEncryptionKey;
use function Folded\setEncryptionKey;
use function Folded\getEncryptedString;

beforeEach(function (): void {
    Crypt::clear();
});

it("should return a string", function (): void {
    $data = "hello world";

    setEncryptionKey(getEncryptionKey());

    expect(getEncryptedString($data))->not()->toBe($data);
});
