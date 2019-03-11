<?php

namespace ShoppinPal\Vend\Api\V2;

use ShoppinPal\Vend\DataObject\Entity\V2\User;
use YapepBase\Communication\CurlHttpRequest;

class Users extends V2ApiAbstract
{
    public function get($userId)
    {
        $request = $this->getAuthenticatedRequestForUri('api/2.0/users/' . $userId);
        $request->setMethod(CurlHttpRequest::METHOD_GET);

        $result = $this->sendRequest($request, 'user get single');

        return new User($result['data'], User::UNKNOWN_PROPERTY_IGNORE, true);
    }
}
