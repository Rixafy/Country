<?php

declare(strict_types=1);

namespace Rixafy\Country\Exception;

use Exception;
use Ramsey\Uuid\UuidInterface;

class CountryNotFoundException extends Exception
{
	public static function byId(UuidInterface $id): self
	{
		return new self('Country with id "' . $id . '" not found.');
	}

	public static function byCodeAlpha2(string $codeAlpha2): self
	{
		return new self('Country with code_alpha2 "' . $codeAlpha2 . '" not found.');
	}

	public static function byName(string $name)
	{
		return new self('Country with name "' . $name . '" not found.');
	}
}
