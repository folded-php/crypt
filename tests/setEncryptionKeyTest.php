<?php

declare(strict_types = 1);

use Folded\Crypt;
use function Folded\getEncryptionKey;
use function Folded\setEncryptionKey;

beforeEach(function (): void {
    Crypt::clear();
});

it("should return null", function (): void {
    expect(setEncryptionKey(getEncryptionKey()))->toBeNull();
});
