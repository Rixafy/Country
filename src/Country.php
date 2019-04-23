<?php

declare(strict_types=1);

namespace Rixafy\Country;

use Doctrine\ORM\Mapping as ORM;
use Rixafy\DoctrineTraits\UniqueTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="country")
 */
class Country
{
	use UniqueTrait;

	/**
	 * @ORM\Column(type="string", unique=true)
	 * @var string
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", length=3)
	 * @var string
	 */
	private $code_currency;

	/**
	 * @ORM\Column(type="string", length=2)
	 * @var string
	 */
	private $code_continent;

	/**
	 * @ORM\Column(type="string", length=2, unique=true)
	 * @var string
	 */
	private $code_alpha2;

	/**
	 * @ORM\Column(type="string", length=2)
	 * @var string
	 */
	private $code_language;

	public function __construct(CountryData $data)
	{
		$this->edit($data);
	}

	public function edit(CountryData $data): void
	{
		$this->name = $data->name;
		$this->code_currency = $data->codeCurrency;
		$this->code_continent = $data->codeContinent;
		$this->code_alpha2 = $data->codeAlpha2;
		$this->code_language = $data->codeLanguage;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getCodeCurrency(): string
	{
		return $this->code_currency;
	}

	public function getCodeAlpha2(): string
	{
		return $this->code_alpha2;
	}

	public function getCodeLanguage(): string
	{
		return $this->code_language;
	}

	public function getCodeContinent(): string
	{
		return $this->code_continent;
	}
}
