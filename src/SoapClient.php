<?php
namespace itsoneiota\shield;
/**
 * A thin wrapper for SoapClient.
 */
class SoapClient extends \SoapClient {

    public function __doRequestAndThrowExceptions($request, $location, $action, $version, $one_way = 0){
        $returnValue = parent::__doRequest($request, $location, $action, $version, $one_way = 0);

        if((isset($this->__soap_fault)) && ($this->__soap_fault !== NULL)) {
            // This is where the exception from __doRequest is stored.
            throw $this->__soap_fault;
        }

        return $returnValue;
    }

}
