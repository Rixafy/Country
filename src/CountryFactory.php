<?php

declare(strict_types=1);

namespace Rixafy\Country;

class CountryFactory
{
	public function create(CountryData $data): Country
	{
		return new Country($data);
	}
}
