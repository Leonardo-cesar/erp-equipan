<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $uses = array('Unidade', 'Usuario');
    public $components = array(
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'usuarios',
                'action' => 'login'
            ),
            'loginRedirect' => array(
                'controller' => 'home',
                'action' => 'index'
            ),
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Usuario',
                    'fields' => array('username' => 'usuario', 'password' => 'senha')
                )
            ),
            'authError' => 'Acesso restrito',
        ),
        'Paginator',
        'Session'
    );

    public function beforeFilter() {
        if ($this->params['action'] == 'login') {
            //$this->Auth->allow('Auth');
        } else {
            if ($this->Session->read('Auth.User.nome') != '') {
                $setor = $this->Usuario->SetoresUsuario->find('list', array('conditions' => array('SetoresUsuario.usuario_id' => $this->Session->read('Auth.User.id')), 'fields' => 'setor_id'));
                $this->Session->write('Auth.User.Setor', $setor);
                $UnidadesLogadas = $this->validaAdm();
                $this->set('UnidadesLogadas', $UnidadesLogadas);
            }
        }
    }

    public function validaAdm() {
        if ($this->Session->read('Auth.User.nivel_id') == 1) {
            $unidades = $this->Unidade->find('list');
        } else {
            $uniUser = $this->Usuario->find('first', array(
                'conditions' => array('Usuario.id' => $this->Session->read('Auth.User.id')),
                'contain' => array(
                    'Unidade' => array('fields' => array('id', 'nome')),
                ),
                'fields' => array('id')
            ));
            foreach ($uniUser['Unidade'] as $uni) {
                $unidades[$uni['id']] = $uni['nome'];
            }
        }
        return $unidades;
    }

    public function permissao($permissao = null) {
        if ($permissao != null AND $this->Session->read('Auth.User.nivel_id') == 3) {
            $verifica = in_array($permissao['permissao']['setor'], $this->Session->read('Auth.User.Setor'));
            if ($verifica == false) {
                $this->Session->setFlash(__('<i class="glyphicon glyphicon-exclamation-sign"></i> Desculpe! Você não tem permissão para acessar essa página.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'permissao');
                return $this->redirect(array('controller' => 'home', 'action' => 'index'));
            }
        } else {
            if ($this->Session->read('Auth.User.nivel_id') == 3) {
                $this->Session->setFlash(__('<i class="glyphicon glyphicon-exclamation-sign"></i> Desculpe! Você não tem permissão para acessar essa página.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'permissao');
                return $this->redirect(array('controller' => 'home', 'action' => 'index'));
            }
        }
    }

    public function gabaritoCodigo($codigo = NULL, $retorno = NULL) {

        $cr = substr($codigo, 0, 2);
        $mo = $codigo[3];
        $ti = $codigo[4];
        $ma = $codigo[5];
        $mar = $codigo[6];
        $co = $codigo[7];
        $ta = $codigo[8];
        $an = substr($codigo, 9, 12);
        $me = substr($codigo, 13, 14);
        $se = substr($codigo, 15, 18);

        $credencial = array(
            032 => 'Gameleira',
            002 => 'Matriz'
        );

        $modelo = array(
            1 => 'Carro',
            2 => 'Moto'
        );

        $tipo = array(
            1 => 'Dianteira',
            2 => 'Traseira'
        );

        $material = array(
            1 => 'Aluminio',
            2 => 'Aço Inox'
        );

        $marca = array(
            1 => 'Avery',
            2 => '3M',
            3 => '3D'
        );

        $cor = array(
            1 => 'Cinza',
            2 => 'Vermelha',
            3 => 'Branca',
            4 => 'Azul',
            5 => 'Verde',
            6 => 'Preta'
        );

        $tamanho = array(
            1 => '40x13',
            2 => '20x17',
            3 => '34x13',
            4 => '36x13'
        );

        // Retorno
        // 1 - Loja
        // 2 - Produtos
        // 3 - Sequencial


        if ($retorno = 2) {
            if ($tamanho[$codigo[8]] != '20x17') {
                $Tcodigo = 'Placa ' . $tipo[$codigo[4]] . ' ' . $tamanho[$codigo[8]] . ' ' . $cor[$codigo[7]] . ' ' . $marca[$codigo[6]];
            } else {
                $Tcodigo = 'Placa de ' . $modelo[$codigo[3]] . ' ' . $tamanho[$codigo[8]] . ' ' . $cor[$codigo[7]] . ' ' . $marca[$codigo[6]];
            }
        }

        return $Tcodigo;
    }

}
