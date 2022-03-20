<?php

declare(strict_types=1);

namespace Rixafy\Country;

use Doctrine\ORM\Mapping as ORM;
use Rixafy\DoctrineTraits\UniqueTrait;

#[ORM\Entity]
#[ORM\Table(name: 'country')]
class Country
{
	use UniqueTrait;

	#[ORM\Column(unique: true)]
	private string $name;

	#[ORM\Column(length: 3)]
	private string $codeCurrency;

	#[ORM\Column(length: 2)]
	private string $codeContinent;

	#[ORM\Column(length: 2, unique: true)]
	private string $codeAlpha2;

	#[ORM\Column(length: 2)]
	private string $codeLanguage;

	public function __construct(CountryData $data)
	{
		$this->edit($data);
	}

	public function edit(CountryData $data): void
	{
		$this->name = $data->name;
		$this->codeCurrency = $data->codeCurrency;
		$this->codeContinent = $data->codeContinent;
		$this->codeAlpha2 = $data->codeAlpha2;
		$this->codeLanguage = $data->codeLanguage;
	}

	public function getName(): string
	{
		return $this->name;
	}
	
	public function changeName(string $name): void
	{
		$this->name = $name;
	}

	public function getCodeCurrency(): string
	{
		return $this->codeCurrency;
	}

	public function changeCodeCurrency(string $currency): void
	{
		$this->codeCurrency = $currency;
	}

	public function getCodeAlpha2(): string
	{
		return $this->codeAlpha2;
	}

	public function getCodeLanguage(): string
	{
		return $this->codeLanguage;
	}

	public function changeCodeLanguage(string $codeLanguage): void
	{
		$this->codeLanguage = $codeLanguage;
	}

	public function getCodeContinent(): string
	{
		return $this->codeContinent;
	}

	public function changeCodeContinent(string $codeContinent): void
	{
		$this->codeContinent = $codeContinent;
	}
}
