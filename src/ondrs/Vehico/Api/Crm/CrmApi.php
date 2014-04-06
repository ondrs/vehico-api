<?php
/**
 * Created by PhpStorm.
 * User: Ondra
 * Date: 22.2.14
 * Time: 11:11
 */

namespace ondrs\Vehico\Api\Crm;



use ondrs\Vehico\Api\BaseApi;
use ondrs\Vehico\Api\Crm\Entity\CaseEntity;
use ondrs\Vehico\Api\Crm\Entity\CustomerEntity;

class CrmApi extends BaseApi
{

    /**
     * @param CaseEntity $caseEntity
     * @return \stdClass
     */
    public function saveCase(CaseEntity $caseEntity)
    {
        $mapper = function($item) {
            return [
                'text' => $item,
            ];
        };

        $caseEntity->brands = array_map($mapper, $caseEntity->brands);
        $caseEntity->models = array_map($mapper, $caseEntity->models);
        $caseEntity->keywords = array_map($mapper, $caseEntity->keywords);

        $response = $this->request('POST', $this->url . '/private/crm/cases', $caseEntity->toArray());
        return $this->getResponseBody($response);
    }


    /**
     * @param int $caseId
     * @return \stdClass
     */
    public function getCase($caseId)
    {
        $response = $this->request('GET', $this->url . '/private/crm/cases/' . $caseId);
        return $this->getResponseBody($response);
    }


    /**
     * @param int $caseId
     * @return \stdClass
     */
    public function deleteCase($caseId)
    {
        $response = $this->request('DELETE', $this->url . '/private/crm/cases/' . $caseId);
        return $this->getResponseBody($response);
    }


    /**
     * @param CustomerEntity $customerEntity
     * @return \stdClass
     */
    public function saveCustomer(CustomerEntity $customerEntity)
    {
        $response = $this->request('POST', $this->url . '/private/crm/customers', $customerEntity->toArray());
        return $this->getResponseBody($response);
    }


    /**
     * @param int $customerId
     * @return \stdClass
     */
    public function getCustomer($customerId)
    {
        $response = $this->request('GET', $this->url . '/private/crm/customers/' . $customerId);
        return $this->getResponseBody($response);
    }


    /**
     * @param int $customerId
     * @return \stdClass
     */
    public function deleteCustomer($customerId)
    {
        $response = $this->request('DELETE', $this->url . '/private/crm/customers/' . $customerId);
        return $this->getResponseBody($response);
    }


    /**
     * @return \stdClass
     */
    public function getTags()
    {
        $response = $this->request('GET', $this->url . '/private/crm/tags');
        return $this->getResponseBody($response);
    }


    /**
     * @return \stdClass
     */
    public function getSources()
    {
        $response = $this->request('GET', $this->url . '/private/crm/sources');
        return $this->getResponseBody($response);
    }


    /**
     * @return \stdClass
     */
    public function getSellers()
    {
        $response = $this->request('GET', $this->url . '/private/crm/sellers');
        return $this->getResponseBody($response);
    }


    /**
     * @param int $caseId
     * @param array $tags
     * @return \stdClass
     */
    public function updateCaseTags($caseId, array $tags)
    {
        $response = $this->request('POST', $this->url . '/private/crm/cases/' . $caseId . '/tags', array(
            'tags' => $tags,
        ));
        return $this->getResponseBody($response);
    }


    /**
     * @param int $caseId
     * @param array $followers
     * @return \stdClass
     */
    public function updateCaseFollowers($caseId, array $followers)
    {
        $response = $this->request('POST', $this->url . '/crm/cases/' . $caseId . '/followers', array(
            'followers' => $followers,
        ));
        return $this->getResponseBody($response);
    }


} 
