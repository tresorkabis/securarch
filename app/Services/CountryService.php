<?php

namespace App\Services;

use Symfony\Component\Intl\Countries;

class CountryService
{
    /**
     * Get the list of countries.
     *
     * @return array
     */
    public function getCountries(): array
    {
        // Get the list of country codes and names
        $countries = Countries::getNames('fr');

        // Sort the countries by name
        asort($countries);

        return $countries;
    }

    /**
     * Get the name of a country by its code.
     *
     * @param string $code
     * @return string|null
     */
    public function getCountryName(string $code): ?string
    {
        return Countries::getName($code, 'fr');
    }

    /**
     * Get the code of a country by its name.
     *
     * @param string $name
     * @return string|null
     */
    public function getCountryCode(string $name): ?string
    {
        $countries = Countries::getNames('fr');
        $countryCode = array_search($name, $countries);

        return $countryCode ?: null;
    }
}
