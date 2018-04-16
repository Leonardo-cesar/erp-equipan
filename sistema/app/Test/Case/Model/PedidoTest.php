<?php
App::uses('Pedido', 'Model');

/**
 * Pedido Test Case
 *
 */
class PedidoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.produto',
		'app.perda',
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
		$this->Pedido = ClassRegistry::init('Pedido');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pedido);

		parent::tearDown();
	}

}
