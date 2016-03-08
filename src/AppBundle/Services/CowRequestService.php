<?php
// src/AppBundle/Services/CowRequestService.php
namespace AppBundle\Services;

class CowRequestService
{
	const API_URL_COW = 'http://api.com.br/api/v1/cows';
	const CONTENT_TYPE = 'Content-Type: application/json';
	const ACCESS_TOKEN = 'access-token: 2b438d2145';

    public function getList()
    {
		$ch = curl_init(self::API_URL_COW);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(self::CONTENT_TYPE, self::ACCESS_TOKEN));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
        return json_decode($result);
    }


    public function insert($request)
    {
    	$requestJson = $this->createCowJsonRequest($request);
		$ch = curl_init(self::API_URL_COW);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $requestJson); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(self::CONTENT_TYPE, self::ACCESS_TOKEN));
		$result = curl_exec($ch);
		curl_close($ch);
        return json_decode($result);
    }


    private function createCowJsonRequest($request){
    	$requestJson = array();
    	$requestJson['weight'] = $request->getWeight();
		$requestJson['age'] = $request->getAge();
		$requestJson['price'] = $request->getPrice();
		return json_encode($requestJson);
    }
}
