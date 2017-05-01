<?php

namespace Drupal\rs\Controller;

use Drupal\Core\Controller\ControllerBase;

class RSController extends ControllerBase {

public function content(){
	return array(
		'#type' => 'markup',
		'#markup' => $this->t('Rising Tigers Welcome'),
    '#theme' => 'rs_twig',
    '#test_var' => $this->t('Test Value'),
	);



	}
}
