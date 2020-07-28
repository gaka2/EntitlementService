<?php

namespace App\Entity;

/**
 * @author Karol Gancarczyk
 */
class EntitlementGranted extends AbstractEntitlement {	
	public function __construct() {
		$this->videoGranted = true;
	}
}