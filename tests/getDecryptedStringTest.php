<?php

declare(strict_types = 1);

use Folded\Crypt;
use function Folded\getEncryptedString;
use function Folded\getEncryptionKey;
use function Folded\setEncryptionKey;
use function Folded\getDecryptedString;

beforeEach(function (): void {
    Crypt::clear();
});

it("should get the decrypted string", function (): void {
    $data = "Hello world";

    setEncryptionKey(getEncryptionKey());

    $encryptedString = getEncryptedString($data);

    expect(getDecryptedString($encryptedString))->toBe($data);
});
