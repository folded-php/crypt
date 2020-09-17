# folded/crypt

Easily encrypt and decrypt strings for your web app.

[![Build Status](https://travis-ci.com/folded-php/crypt.svg?branch=master)](https://travis-ci.com/folded-php/crypt) [![Maintainability](https://api.codeclimate.com/v1/badges/8e59f7e6108adc65ca6b/maintainability)](https://codeclimate.com/github/folded-php/crypt/maintainability) [![TODOs](https://img.shields.io/endpoint?url=https://api.tickgit.com/badge?repo=github.com/folded-php/crypt)](https://www.tickgit.com/browse?repo=github.com/folded-php/crypt)

## Summary

- [About](#about)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Examples](#examples)
- [Version support](#version-support)

## About

I created this library to be able to encrypt my data in a standalone way.

Folded is a constellation of packages to help you setting up a web app easily, using ready to plug in packages.

- [folded/action](https://github.com/folded-php/action): A way to organize your controllers for your web app.
- [folded/config](https://github.com/folded-php/config): Configuration utilities for your PHP web app.
- [folded/exception](https://github.com/folded-php/exception): Various kind of exception to throw for your web app.
- [folded/history](https://github.com/folded-php/history): Manipulate the browser history for your web app.
- [folded/http](https://github.com/folded-php/http): HTTP utilities for your web app.
- [folded/orm](https://github.com/folded-php/orm): An ORM for you web app.
- [folded/request](https://github.com/folded-php/request): Request utilities, including a request validator, for your PHP web app.
- [folded/routing](https://github.com/folded-php/routing): Routing functions for your PHP web app.
- [folded/session](https://github.com/folded-php/session): Session functions for your web app.
- [folded/view](https://github.com/folded-php/view): View utilities for your PHP web app.

## Features

- Can encrypt and decrypt strings
- Can generate a key (necessary to setup the library) from the command line

## Requirements

- PHP >= 7.4.0
- Composer installed

## Installation

- [1. Install the package](#1-install-the-package)
- [2. Generate a key](#2-generate-a-key)
- [3. Add the setup code](#3-add-the-setup-code)

### 1. Install the package

In your root folder, run this command:

```bash
composer require folded/crypt
```

### 2. Generate a key

One way to generate the key easily is through the command line. Run this command to get a new key:

```bash
vendor/bin/crypt generate key
```

You can get more information on the available option by running `vendor/bin/crypt generate --help`.

Another way is to call the function `Folded\getEncryptionKey()` from a script:

```php
use function Folded\getEncryptionKey;

require __DIR__ . "/vendor/autoload.php";

echo getEncryptionKey();
```

You can add a parameter to control the type of cipher you want (currently supported: AES-128-CBC and AES-256-CBC).

### 3. Add the setup code

Before calling the library, add this setup code as early as possible:

```php
use Folded\setEncryptionKey;

setEncryptionKey("xIYrZSsCV6hx9x/Q4bka1PejU+aSaMerJQFSYr3QnTE=");
```

## Examples

- [1. Encrypt a string](#1-encrypt-a-string)
- [2. Decrypt a string](#2-decrypt-a-string)

### 1. Encrypt a string

In this example, we will get the encrypted version of a string.

```php
use function Folded\getEncryptedString;

$encryptedText = getEncryptedString("hello world");
```

### 2. Decrypt a string

In this example, we will decrypt a previously encrypted text.

```php
use function Folded\getDecryptedString;

$encryptedString = "...";
$decryptedString = getDecryptedString($encryptedString);
```

Note it will only decrypt encrypted string from the `getEncryptedString()` function.

Also note that if you encrypt a string with a key A, and you change the key A for a new key, the `getDecryptedString` will not be able to successfuly decrypt the text and get the original text so be careful to save your key in somewhere safe (generally in a .env file).

## Version support

|        | 7.3 | 7.4 | 8.0 |
| ------ | --- | --- | --- |
| v0.1.0 | ❌  | ✔️  | ❓  |
