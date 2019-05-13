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
	private $codeCurrency;

	/**
	 * @ORM\Column(type="string", length=2)
	 * @var string
	 */
	private $codeContinent;

	/**
	 * @ORM\Column(type="string", length=2, unique=true)
	 * @var string
	 */
	private $codeAlpha2;

	/**
	 * @ORM\Column(type="string", length=2)
	 * @var string
	 */
	private $codeLanguage;

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

	public function getCodeCurrency(): string
	{
		return $this->codeCurrency;
	}

	public function getCodeAlpha2(): string
	{
		return $this->codeAlpha2;
	}

	public function getCodeLanguage(): string
	{
		return $this->codeLanguage;
	}

	public function getCodeContinent(): string
	{
		return $this->codeContinent;
	}
}
