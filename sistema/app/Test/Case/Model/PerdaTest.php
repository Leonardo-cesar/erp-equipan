<?php
App::uses('Perda', 'Model');

/**
 * Perda Test Case
 *
 */
class PerdaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.perda',
		'app.produto',
		'app.pedido',
		'app.usuario_desconto',
		'app.usuario',
		'app.cliente',
		'app.categoria',
		'app.preco',
		'app.unidade',
		'app.caixa',
		'app.formas_pagamento',
		'app.estoque',
		'app.kit',
		'app.kits_pedido',
		'app.kits_produto',
		'app.kits_unidade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Perda = ClassRegistry::init('Perda');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Perda);

		parent::tearDown();
	}

}
