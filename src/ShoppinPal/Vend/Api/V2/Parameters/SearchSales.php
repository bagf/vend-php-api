<?php

namespace ShoppinPal\Vend\Api\V2\Parameters;

use DateTime;
use DateTimeZone;

class SearchSales extends SearchAbstract
{
    public static function get()
    {
        return new SearchSales();
    }

    public function withStatus($status)
    {
        return $this->include('status', $status);
    }

    public function withInvoiceNumber($invoiceNumber)
    {
        return $this->include('invoice_number', $invoiceNumber);
    }

    public function withCustomerId($customerId)
    {
        return $this->include('customer_id', $customerId);
    }

    public function withUserId($userId)
    {
        return $this->include('user_id', $userId);
    }

    public function withOutletId($outletId)
    {
        return $this->include('outlet_id', $outletId);
    }

    public function withDateFrom($date)
    {
        return $this->include('date_from', $this->formatDate($date));
    }

    public function withDateTo($date)
    {
        return $this->include('date_to', $this->formatDate($date));
    }

    public function withoutStatus($status)
    {
        return $this->exclude('status', $status);
    }

    public function withoutInvoiceNumber($invoiceNumber)
    {
        return $this->exclude('invoice_number', $invoiceNumber);
    }

    public function withoutCustomerId($customerId)
    {
        return $this->exclude('customer_id', $customerId);
    }

    public function withoutUserId($userId)
    {
        return $this->exclude('user_id', $userId);
    }

    public function withoutOutletId($outletId)
    {
        return $this->exclude('outlet_id', $outletId);
    }

    public function withoutDateFrom($date)
    {
        return $this->exclude('date_from', $this->formatDate($date));
    }

    public function withoutDateTo($date)
    {
        return $this->exclude('date_to', $this->formatDate($date));
    }

    protected function formatDate($date)
    {
        if ($date instanceof DateTime) {
            $dateTime = $date;
            $timezone = new DateTimeZone('UTC');
            $dateTime->setTimezone($timezone);
            $formatted = $dateTime->format('c');
            return str_replace('+00:00', 'Z', $formatted);
        }

        if (is_numeric($date)) {
            $dateTime = new DateTime();
            $timezone = new DateTimeZone('UTC');
            $dateTime->setTimezone($timezone);
            $dateTime->setTimestamp($date);
            $formatted = $dateTime->format('c');
            return str_replace('+00:00', 'Z', $formatted);
        }

        return $date;
    }
}
