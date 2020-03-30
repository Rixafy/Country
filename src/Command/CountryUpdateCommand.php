<?php

declare(strict_types=1);

namespace Rixafy\Country\Command;

use Doctrine\ORM\EntityManagerInterface;
use Rixafy\Country\CountryData;
use Rixafy\Country\CountryFacade;
use Rixafy\Country\CountryFactory;
use Rixafy\Country\Exception\CountryNotFoundException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CountryUpdateCommand extends Command
{
	/** @var CountryFacade */
	public $countryFacade;

	/** @var CountryFactory */
	public $countryFactory;

	/** @var EntityManagerInterface */
	private $entityManager;

	public function __construct(
		CountryFacade $countryFacade, 
		CountryFactory $countryFactory, 
		EntityManagerInterface $entityManager
	) {
		$this->countryFacade = $countryFacade;
		$this->countryFactory = $countryFactory;
		$this->entityManager = $entityManager;

		parent::__construct();
	}

	public function configure()
	{
		$this->setName('rixafy:country:update');
		$this->setDescription('Updates countries rates from third-party service.');
	}

	public function execute(InputInterface $input, OutputInterface $output): int
	{
		$content = @file_get_contents('http://country.io/names.json');
		if ($content !== false) {
			$json = json_decode($content);
			foreach ($json as $code => $codeCurrency) {
				$data = new CountryData();
				$data->name = (string)$codeCurrency;
				$data->codeAlpha2 = (string)$code;

				try {
					$country = $this->countryFacade->getByCodeAlpha2($code);

				} catch (CountryNotFoundException $e) {
					$country = $this->countryFactory->create($data);
					$this->entityManager->persist($country);
				}

				if ($code === 'CZ') {
					$country->changeCodeLanguage('cs');
				} elseif ($code === 'SK') {
					$country->changeCodeLanguage('sk');
				} elseif ($code === 'DE') {
					$country->changeCodeLanguage('de');
				} elseif ($code === 'HU') {
					$country->changeCodeLanguage('hu');
				} elseif ($code === 'PL') {
					$country->changeCodeLanguage('pl');
				} else {
					$country->changeCodeLanguage('en');
				}

				$country->changeName($codeCurrency);
			}
			$this->entityManager->flush();
		}

		$content = @file_get_contents('http://country.io/continent.json');
		if ($content !== false) {
			$json = json_decode($content);
			foreach ($json as $code => $codeCurrency) {
				try {
					$country = $this->countryFacade->getByCodeAlpha2($code);
					$country->changeCodeContinent($codeCurrency);

				} catch (CountryNotFoundException $e) {
				}
			}
			$this->entityManager->flush();
		}

		$content = @file_get_contents('http://country.io/currency.json');
		if ($content !== false) {
			$json = json_decode($content);
			foreach ($json as $code => $codeCurrency) {
				try {
					$country = $this->countryFacade->getByCodeAlpha2($code);
					$country->changeCodeCurrency($codeCurrency);

				} catch (CountryNotFoundException $e) {
				}
			}
			$this->entityManager->flush();
		}

		$content = @file_get_contents('http://country.io/continent.json');
		if ($content !== false) {
			$json = json_decode($content);
			foreach ($json as $code => $codeCurrency) {
				try {
					$country = $this->countryFacade->getByCodeAlpha2($code);
					$country->changeCodeContinent($codeCurrency);

				} catch (CountryNotFoundException $e) {
				}
			}
			$this->entityManager->flush();
		}
		
		return 0;
	}
}
