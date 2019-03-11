<?php

namespace ShoppinPal\Vend\Api\V2\Parameters;


class SearchCustomers extends SearchAbstract
{
    public static function get()
    {
        return new SearchCustomers();
    }

    public function withCustomerCode($customerCode)
    {
        return $this->include('customer_code', strtolower($customerCode));
    }

    public function withFirstName($firstName)
    {
        return $this->include('first_name', $firstName);
    }

    public function withLastName($lastName)
    {
        return $this->include('last_name', $lastName);
    }

    public function withCompanyName($companyName)
    {
        return $this->include('company_name', $companyName);
    }
}
