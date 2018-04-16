<?php
/**
 * LancamentoFixture
 *
 */
class LancamentoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'operacao' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'data' => array('type' => 'date', 'null' => true, 'default' => null),
		'historico' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'valor' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'valor_p' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'situacao' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'observacao' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ativo' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'tipo_pagamento_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'plano_conta_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'unidade_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'usuario_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'unidades_geradora' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'unidades_pagadora' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'unidades_recebedora' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_lancamentos_tipo_pagamentos1_idx' => array('column' => 'tipo_pagamento_id', 'unique' => 0),
			'fk_lancamentos_plano_contas1_idx' => array('column' => 'plano_conta_id', 'unique' => 0),
			'fk_lancamentos_unidades1_idx' => array('column' => 'unidade_id', 'unique' => 0),
			'fk_lancamentos_usuarios1_idx' => array('column' => 'usuario_id', 'unique' => 0),
			'fk_lancamentos_unidades_lancamentos1_idx' => array('column' => 'unidades_geradora', 'unique' => 0),
			'fk_lancamentos_unidades_lancamentos2_idx' => array('column' => 'unidades_pagadora', 'unique' => 0),
			'fk_lancamentos_unidades_lancamentos3_idx' => array('column' => 'unidades_recebedora', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'operacao' => 1,
			'data' => '2015-12-03',
			'historico' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'valor' => 'Lorem ipsum dolor sit amet',
			'valor_p' => 'Lorem ipsum dolor sit amet',
			'situacao' => 1,
			'observacao' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'ativo' => 1,
			'tipo_pagamento_id' => 1,
			'plano_conta_id' => 1,
			'unidade_id' => 1,
			'usuario_id' => 1,
			'unidades_geradora' => 1,
			'unidades_pagadora' => 1,
			'unidades_recebedora' => 1
		),
	);

}
