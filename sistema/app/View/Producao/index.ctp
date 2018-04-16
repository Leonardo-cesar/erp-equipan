<div class="col-sm-12">
    <table class="table table-bordered table-striped">
        <tbody id="tbody" style="background: #cac4c4;">

        </tbody>
    </table>
</div>
<audio id="beep-three" controls preload="auto" style="display: none">
    <source src="audio/beep.mp3" controls></source>
    <source src="audio/beep.ogg" controls></source>
</audio>
<br clear="all" />
<script>
    var beepThree = $("#beep-three")[0];

    function atualizar() {
        $("#tbody").load(www_root + 'producao/table', function () {
            options();
        });
    }


    function options() {
        $('.concluir').click(function () {
            $.ajax({
                url: www_root + 'producao/concluir?id=' + $(this).attr('id'),
                success: function (data) {
                    atualizar();
                }
            });
        });

        $('.cancelar').click(function () {
            $.ajax({
                url: www_root + 'producao/cancelar?id=' + $(this).attr('id'),
                success: function (data) {
                    atualizar();
                }
            });
        });
    }

    setInterval("atualizar()", 1000);

    $(document).ready(function () {
        atualizar();
    });


</script>