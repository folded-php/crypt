<?php

declare(strict_types = 1);

use Folded\Crypt;
use function Folded\getEncryptionKey;

beforeEach(function (): void {
    Crypt::clear();
});

it("should return a random string", function (): void {
    expect(getEncryptionKey())->toBeString();
});
