<?php

namespace ShoppinPal\Vend\Api\V2;

use ShoppinPal\Vend\DataObject\Entity\V2\CollectionResult;
use ShoppinPal\Vend\DataObject\Entity\V2\Customer;
use ShoppinPal\Vend\DataObject\Entity\V2\Product;
use ShoppinPal\Vend\DataObject\Entity\V2\Sale;
use YapepBase\Communication\CurlHttpRequest;

/**
 * Implements the V2 Search API
 */
class Search extends V2ApiAbstract
{
    protected function getPaginatedCollectionParams($pageSize, $offset, $orderBy, $orderDirection, $deleted)
    {
        $params = [
            'page_size' => $pageSize,
        ];

        if ($offset > 0) {
            $params['offset'] = $offset;
        }

        if (!empty($orderBy)) {
            $params['order_by'] = $orderBy;
        }

        if (!empty($orderDirection)) {
            $params['order_direction'] = $orderDirection;
        }

        if ($deleted) {
            $params['deleted'] = 1;
        }

        return $params;
    }

    private function searchProducts($params)
    {
        $params['type'] = 'products';

        $request = $this->getAuthenticatedRequestForUri('api/2.0/search', $params);
        $request->setMethod(CurlHttpRequest::METHOD_GET);

        $result = $this->sendRequest($request, 'search products collection');

        foreach ($result['data'] as $product) {
            $items[] = new Product($product, Product::UNKNOWN_PROPERTY_IGNORE, true);
        }

        return new CollectionResult(
            $result['version']['min'], $result['version']['max'], $items
        );
    }

    private function searchCustomers($params)
    {
        $params['type'] = 'customers';

        $request = $this->getAuthenticatedRequestForUri('api/2.0/search', $params);
        $request->setMethod(CurlHttpRequest::METHOD_GET);

        $result = $this->sendRequest($request, 'search customers collection');

        foreach ($result['data'] as $customer) {
            $items[] = new Customer($customer, Customer::UNKNOWN_PROPERTY_IGNORE, true);
        }

        return new CollectionResult(
            $result['version']['min'], $result['version']['max'], $items
        );
    }

    private function searchSales($params)
    {
        $params['type'] = 'sales';

        $request = $this->getAuthenticatedRequestForUri('api/2.0/search', $params);
        $request->setMethod(CurlHttpRequest::METHOD_GET);

        $result = $this->sendRequest($request, 'search sales collection');
        $items = [];

        foreach ($result['data'] as $sale) {
            $items[] = new Sale($sale, Sale::UNKNOWN_PROPERTY_IGNORE, true);
        }

        return new CollectionResult(
            $result['version']['min'], $result['version']['max'], $items
        );
    }

    /**
     * Returns a collection of search.
     *
     * @param int  $pageSize       The number of items to return per page.
     * @param null $before         The version to succeed the last returned version.
     * @param null $after          The version to precede the first returned version
     * @param bool $includeDeleted If TRUE, deleted items will be returned as well. (required to synchronise deletions)
     *
     * @return CollectionResult
     */
    public function getCollection(
        Parameters\SearchAbstract $parameters,
        $pageSize = 50,
        $offset = 0,
        $orderBy = '',
        $orderDirection = 'desc',
        $includeDeleted = false
    )
    {
        $params = $this->getPaginatedCollectionParams($pageSize, $offset, $orderBy, $orderDirection, $includeDeleted);
        $params = array_merge($params, $parameters->getParameters());

        if ($parameters instanceof Parameters\SearchProducts) {
            return $this->searchProducts($params);
        }

        if ($parameters instanceof Parameters\SearchCustomers) {
            return $this->searchCustomers($params);
        }

        if ($parameters instanceof Parameters\SearchSales) {
            return $this->searchSales($params);
        }
    }
}
