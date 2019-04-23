<?php

declare(strict_types=1);

namespace Rixafy\Country;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Ramsey\Uuid\UuidInterface;
use Rixafy\Country\Exception\CountryNotFoundException;

class CountryRepository
{
	/** @var EntityManagerInterface */
	private $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * @return EntityRepository|ObjectRepository
	 */
	protected function getRepository()
	{
		return $this->entityManager->getRepository(Country::class);
	}

	/**
	 * @throws CountryNotFoundException
	 */
	public function get(UuidInterface $id): Country
	{
		/** @var Country $country */
		$country = $this->getRepository()->findOneBy([
			'id' => $id
		]);

		if ($country === null) {
			throw CountryNotFoundException::byId($id);
		}

		return $country;
	}

	/**
	 * @throws CountryNotFoundException
	 */
	public function getByCodeAlpha2(string $codeAlpha2): Country
	{
		/** @var Country $country */
		$country = $this->getRepository()->findOneBy([
			'code_alpha2' => $codeAlpha2
		]);

		if ($country === null) {
			throw CountryNotFoundException::byCodeAlpha2($codeAlpha2);
		}

		return $country;
	}

	/**
	 * @throws CountryNotFoundException
	 */
	public function getByName(string $name): Country
	{
		/** @var Country $country */
		$country = $this->getRepository()->findOneBy([
			'name' => $name
		]);

		if ($country === null) {
			throw CountryNotFoundException::byName($name);
		}

		return $country;
	}

	public function getQueryBuilderForAll(): QueryBuilder
	{
		return $this->getRepository()->createQueryBuilder('e');
	}
}
