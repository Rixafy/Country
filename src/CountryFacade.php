<?php

declare(strict_types=1);

namespace Rixafy\Country;

use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class CountryFacade
{
	/** @var EntityManagerInterface */
	private $entityManager;

	/** @var CountryRepository */
	private $countryRepository;

	/** @var CountryFactory */
	private $countryFactory;

	public function __construct(
		EntityManagerInterface $entityManager,
		CountryRepository $countryRepository,
		CountryFactory $countryFactory
	) {
		$this->entityManager = $entityManager;
		$this->countryRepository = $countryRepository;
		$this->countryFactory = $countryFactory;
	}

	public function create(CountryData $countryData): Country
	{
		$country = $this->countryFactory->create($countryData);

		$this->entityManager->persist($country);
		$this->entityManager->flush();

		return $country;
	}

	/**
	 * @throws Exception\CountryNotFoundException
	 */
	public function edit(UuidInterface $id, CountryData $countryData): Country
	{
		$country = $this->countryRepository->get($id);
		$country->edit($countryData);

		$this->entityManager->flush();

		return $country;
	}

	/**
	 * @throws Exception\CountryNotFoundException
	 */
	public function get(UuidInterface $id): Country
	{
		return $this->countryRepository->get($id);
	}

	/**
	 * @throws Exception\CountryNotFoundException
	 */
	public function getByCodeAlpha2(string $codeAlpha2): Country
	{
		return $this->countryRepository->getByCodeAlpha2($codeAlpha2);
	}

	/**
	 * @throws Exception\CountryNotFoundException
	 */
	public function getByName(string $name): Country
	{
		return $this->countryRepository->getByName($name);
	}
}
