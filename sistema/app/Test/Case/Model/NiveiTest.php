<?php
App::uses('Nivei', 'Model');

/**
 * Nivei Test Case
 *
 */
class NiveiTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.nivei'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Nivei = ClassRegistry::init('Nivei');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Nivei);

		parent::tearDown();
	}

}
