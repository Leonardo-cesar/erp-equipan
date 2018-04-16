<script>
$('#dvLoading').fadeIn('fast');
</script>
<div class="pedidos form">
    <fieldset>
        <legend>Retirando Autorizações</legend>
        <p class="text"></p>
    </fieldset>
</div>
<?php $plac = explode('-', end($this->request->data['Produto']['placa'])); ?>
<?php foreach ($this->request->data['Produto']['placa'] as $key => $placa) { ?>
<form id='au<?php echo $key ?>' method=post name=pesquisa style="display:none">
        <?php $p = explode('-', $placa); ?>
        <input maxLength=7 size=30 name=placa value="<?php echo $p[0] . $p[1] ?>">
        <input maxLength=11 size=30 name=renavam value="<?php echo $this->request->data['Produto']['renavam'][$key] ?>">
        <input type='text' value='Pesquisar' name='pesquisar'>
        <input type='submit' value='Pesquisar' class='enviar' name='pesqui'>
    </form>
    <form target="entrada_frame<?php echo $key ?>" style="display:none" name="entrada" id='Formentrada<?php echo $key ?>' action="https://www.detrannet.empresas.mg.gov.br/a1pl/fabrica_placas/empresa/auto_exibir.asp" method="POST">
        <input name="renavam" class="readonly" id="Ren<?php echo $key ?>" type="text" size="30" maxlength="11" readonly="" value="">
        <input name="placa" class="readonly" id="Pla<?php echo $key ?>" type="text" size="30" maxlength="7" readonly="" value="">
        <input name="dtEmissao" class="readonly" id='dtEmissao<?php echo $key ?>' type="text" size="20" readonly="" value="">
        <input name="autorizacao" class="readonly" id="Aut<?php echo $key ?>" type="text" size="30" readonly="" value="">
        <input name="proprietario" class="readonly" id="Pr<?php echo $key ?>" type="text" size="50" readonly="" value="">
        <input name="categoria" class="readonly" id="Ca<?php echo $key ?>" type="text" size="50" readonly="" value="">
        <input name="municipioDesc" class="readonly" id="Mu<?php echo $key ?>" type="text" size="50" readonly="" value="">
        <input name="municipio" type="hidden" value="4123">
        <select name="tipo" id="TP<?php echo $key ?>" ><option value="1">PLACA - REFLETIVA</option></select>
        <input name="preco" id="Pr<?php echo $key ?>"  type="text" maxlength="10" value="50,00">
        <input name="cupom" id="CF<?php echo $key ?>" type="text" size="30" value='' maxlength="20" value="">
        <input name="dtFabricacao" id="DF<?php echo $key ?>" type="text" size="20" value='' maxlength="10">
        <textarea name="observacao" maxlength="80" rows="3" cols="60"></textarea>	
        <input name="sa" type="submit" value="Salvar">	
        <input name="salvar" type="text" value="Salvar">	
    </form>
    <iframe name="entrada_frame<?php echo $key ?>" src="" id="output_frame" width="800" height="500"  style="display:none"></iframe>
    <script type="text/javascript">
        function enviar<?php echo $key ?>() {
            $.ajax({
                "type": "POST",
                "url": "https://www.detrannet.empresas.mg.gov.br/a1pl/fabrica_placas/empresa/auto_exibir.asp",
                "data": $('#au<?php echo $key ?>').serialize(),
                "success": function (data) {
                    var d = data.replace(/&nbsp;/g, '');
                    var a = d.replace(/^[ \t]+/gm, '');
                    var c = a.substring(5837, 6000);
                    var e = a.substring(8837, 10400);
                    $(".text").html(e);
                    $("#Ren<?php echo $key ?>").val($("input[name=renavam]").val());
                    $("#Pla<?php echo $key ?>").val($("input[name=placa]").val());
                    $("#dtEmissao<?php echo $key ?>").val($("input[name=dtEmissao]").val());
                    $("#DF<?php echo $key ?>").val($("input[name=dtEmissao]").val());
                    var resu = $("input[name=dtEmissao]").val().split('/');
                    $("#CF<?php echo $key ?>").val(resu[0] + resu[1]);
                    $("#Aut<?php echo $key ?>").val($("input[name=autorizacao]").val());
                    $("#Mu<?php echo $key ?>").val($("input[name=municipio]").val());
                    $("#Pr<?php echo $key ?>").val($("input[name=proprietario]").val());
                    $("#Ca<?php echo $key ?>").val($("input[name=categoria]").val());
                    $("#Formentrada<?php echo $key ?>").submit();
                    <?php if ($plac[0] . $plac[1] == $p[0] . $p[1]) { ?>
                        var result = confirm("AUTORIZAÇÕES RETIRADAS COM SUCESSO!");
                        if (result) {
                            abrirPopup("http://localhost/erp/sistema/pedidos/imprimir/<?php echo $id ?>", 500, 400);
                            location.href = '<?php echo $this->Html->url('/') ?>' + "pedidos/localiza";
                        } else {
                            
                        }
                    <?php } ?>
                }
            });
        }
        $(document).ready(function () {
            enviar<?php echo $key ?>();
        });

    </script>
<?php } ?>