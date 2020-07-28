<?php

namespace App\Entity;

/**
 * @author Karol Gancarczyk
 */
class EntitlementUngranted extends AbstractEntitlement {	
	public function __construct() {
		$this->videoGranted = false;
	}
}