<?php

App::uses('AppController', 'Controller');

/**
 * Part Comunicação Online
 * Home Controller 
 * 
 */
class HomeController extends AppController {

    public $uses = array('KitsPedidos');

    public function index() {
        
    }

    public function ler() {
        /* Ler um e-mail */
        //Conecta-se ao MailServer 
        $host = "mail.equipan.com.br";
        $usuario = "cadastro@equipan.com.br";
        $senha = "cadastro";
        //recebe a conexao 
        $mbox = imap_open("{" . $host . ":143/novalidate-cert}INBOX", $usuario, $senha)or die("can't connect: " . imap_last_error());


        for ($m = 1; $m <= imap_num_msg($mbox); $m++) { 
            //ele vai repetir esse laço enquanto houver mensagens }
            for ($m = 1; $m <= imap_num_msg($mbox); $m++) {
                //ele vai repetir esse laço enquanto houver mensagens 
                $header = imap_headerinfo($mbox, $m);
                $body = imap_fetchbody($mbox, $m, 2);
                $body = str_replace("<o:p></o:p></span></p=
></td></tr><tr><td style=3D'border:inset black 1.0pt;padding:.75pt .75pt =
.75pt .75pt'><p class=3DMsoNormal><span =
style=3D'font-size:9.0pt;font-family:\"Courier =
New\";color:black;mso-fareast-language:EN-US'>", ',', $body);
                $body = strip_tags(str_replace("&nbsp;", '', $body));
                debug($body);
                $uid = imap_uid($mbox,$m);
                echo '<li>';
                echo '<h2>';
                echo $header->subject . ', ' . date('d-m-Y H:i:s', strtotime($header->date));
                echo '</h2>';
                echo '<hr>';
                echo '<p>' . $body . '</p>';
                echo '</li>';
                imap_setflag_full($mbox, $uid, "\\Seen", ST_UID);
                imap_close($mbox);
            }
        }
    }

//    public function query() {
//        $var_pedidos = "4099,3934,3933";
//        $placas = $this->KitsPedidos->find('all', array('conditions' => array('pedido_id IN (' . $var_pedidos . ')'), 'fields' => array('id', 'pedido_id', 'placa', 'valor')));
//        foreach ($placas as $placa) {
//            if ($placa['KitsPedidos']['valor'] == '23.18') {
//                echo $placa['KitsPedidos']['pedido_id'] . ' / ' . $placa['KitsPedidos']['placa'] . ' => ' . $placa['KitsPedidos']['valor'] . '<br />';
//                echo $placa['KitsPedidos']['pedido_id'] . ' / ' . $placa['KitsPedidos']['placa'] . ' => 24.57' . '<br /><hr />';
//                $this->KitsPedidos->id = $placa['KitsPedidos']['id'];
//                $this->KitsPedidos->saveField('valor', '24.57');
//            } elseif ($placa['KitsPedidos']['valor'] == '46.37') {
//                echo $placa['KitsPedidos']['pedido_id'] . ' / ' . $placa['KitsPedidos']['placa'] . ' => ' . $placa['KitsPedidos']['valor'] . '<br />';
//                echo $placa['KitsPedidos']['pedido_id'] . ' / ' . $placa['KitsPedidos']['placa'] . ' => 49.14' . '<br /><hr />';
//                $this->KitsPedidos->id = $placa['KitsPedidos']['id'];
//                $this->KitsPedidos->saveField('valor', '49.14');
//            } else {
//                echo '<span style="color:RED;font-size:16px">' . 'ERRO ---- /' . $placa['KitsPedidos']['pedido_id'] . ' / ' . $placa['KitsPedidos']['placa'] . ' => ' . $placa['KitsPedidos']['valor'] . '<br />' . '</span>';
//            }
//        }
//        exit;
//    }
}

?>