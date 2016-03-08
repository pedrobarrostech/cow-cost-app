<?php

// src/AppBundle/Services/CalculateCowCostService.php
namespace AppBundle\Services;

class CalculateCowCostService
{

	public function calculate($weight, $age){
		return ($age * 365 * 3) * $weight;
	}


}

