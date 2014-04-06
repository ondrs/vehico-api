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
        $response = $this->curl->post($this->url . '/private/crm/cases', $caseEntity->toArray());
        return $this->getResponseBody($response);
    }


    /**
     * @param int $caseId
     * @return \stdClass
     */
    public function getCase($caseId)
    {
        $response = $this->curl->get($this->url . '/private/crm/cases/' . $caseId);
        return $this->getResponseBody($response);
    }


    /**
     * @param int $caseId
     * @return \stdClass
     */
    public function deleteCase($caseId)
    {
        $response = $this->curl->delete($this->url . '/private/crm/cases/' . $caseId);
        return $this->getResponseBody($response);
    }


    /**
     * @param CustomerEntity $customerEntity
     * @return \stdClass
     */
    public function saveCustomer(CustomerEntity $customerEntity)
    {
        $response = $this->curl->post($this->url . '/private/crm/customers', $customerEntity->toArray());
        return $this->getResponseBody($response);
    }


    /**
     * @param int $customerId
     * @return \stdClass
     */
    public function getCustomer($customerId)
    {
        $response = $this->curl->get($this->url . '/private/crm/customers/' . $customerId);
        return $this->getResponseBody($response);
    }


    /**
     * @param int $customerId
     * @return \stdClass
     */
    public function deleteCustomer($customerId)
    {
        $response = $this->curl->delete($this->url . '/private/crm/customers/' . $customerId);
        return $this->getResponseBody($response);
    }


    /**
     * @return \stdClass
     */
    public function getTags()
    {
        $response = $this->curl->get($this->url . '/private/crm/tags');
        return $this->getResponseBody($response);
    }


    /**
     * @return \stdClass
     */
    public function getSources()
    {
        $response = $this->curl->get($this->url . '/private/crm/sources');
        return $this->getResponseBody($response);
    }


    /**
     * @return \stdClass
     */
    public function getSellers()
    {
        $response = $this->curl->get($this->url . '/private/crm/sellers');
        return $this->getResponseBody($response);
    }


    /**
     * @param int $caseId
     * @param array $tags
     * @return \stdClass
     */
    public function updateCaseTags($caseId, array $tags)
    {
        $response = $this->curl->post($this->url . '/private/crm/cases/' . $caseId . '/tags', array(
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
        $response = $this->curl->post($this->url . '/crm/cases/' . $caseId . '/followers', array(
            'followers' => $followers,
        ));
        return $this->getResponseBody($response);
    }


} 
