<link href="<?php echo BASE_URL; ?>/assets/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!--<script src="<?php echo BASE_URL; ?>/assets/js/jquery-1.7.2.min.js"></script>-->


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/switch.css">
<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"> </script>
<style>
.camera {
    width: 340px !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    padding: 0.5em !important;
}
.foto {
    width: 320px !important;
    height: 240px !important;
    border: 1px solid black !important;
    margin: 1em !important;
}

</style>
                    <table id="show" class="table table-stripped">
                        <tr>
                            <th style="width: 50%;">Ítem</th>
                            <th style="width: 30%;"> Situação </th>
                            <th style="width: 20%;"> Ações </th>
                        </tr>

                            <?php foreach ($items as $i) : ?>
                                <div class="item" data-item="<?php echo $i['id']; ?>">
                        <tr>
                            <td style="width: 50%;"><?php echo $i['item']; ?></td>
                            <td style="width: 30%;">
                            <!--
                                <select id="situacao<?php echo $i['id']; ?>" class="form-control" data-item="<?php echo $i['id']; ?>" name="situacao" onchange="changeSelect(this)">
                                    <option disabled selected> Selecione </option>
                                    <option value="C"> Conforme </option>
                                    <option value="NC"> Não Conforme </option>
                                </select>
                            -->
                            <label class="switch">
                                <input type="checkbox" onchange="changeSelect(this)" 
                                    name="situacao<?php echo $i['id']; ?>" data-item="<?php echo $i['id']; ?>"
                                    id="situacao<?php echo $i['id']; ?>" checked>
                                <span class="slider round"></span>
                            </label>
                            </td>
                            <td style="width: 20%;">
                                <i id="observacao_<?php echo $i['id']; ?>" 
                                    class="fa fa-commenting" onclick="clickObservacao(this)" 
                                    style="cursor: pointer;" title="Adicionar Observação"></i>&nbsp;&nbsp;
                                <i id="foto_<?php echo $i['id']; ?>" 
                                    class="fa fa-camera-retro" onclick="clickFoto(this)" data-item="<?php echo $i['id']; ?>"
                                    style="cursor: pointer;" title="Adicionar Foto"></i>&nbsp;
                            </td>
                            <tr id="motivo<?php echo $i['id']; ?>" style="display:none; background-color:#eee">
                                <td colspan="3"> Observações: <textarea id="motivoInpt<?php echo $i['id']; ?>" class="form-control" style="width: 100%; padding: 5px;"type="text" name="motivo" placeholder="Informe o motivo"></textarea></td>
                            </tr>
                            <tr id="foto<?php echo $i['id']; ?>" style="display:none; background-color:#eee">
                                <td colspan="3"> 
                                    Foto:
                                    <div class="camera<?php echo $i['id']; ?>">
                                        <video id="video<?php echo $i['id']; ?>" class="foto" autoplay>Vídeo não disponível.</video>
                                        <canvas id="canvas<?php echo $i['id']; ?>" class="foto" style="display: none;"></canvas>
                                        <button id="tira-foto<?php echo $i['id']; ?>">Tirar foto</button>
                                    </div>
                                </td>
                            </tr>
                        </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3">
                                    <button id="salvar" class="btn btn-success btn-lg btn-block" style="font-weight: bold;"> SALVAR CHECKLIST </button>
                                </td>
                            </tr>
                    </table>

                    <table id="ok" style="display:none;" class="table table-stripped">
                        <tr>
                            <td class="text-center" style="font-size: 120%;"> Dados enviados com sucesso! </td>
                        </tr>
                    </table>
<script>
    function changeSelect(e) {
        if($(e).attr('checked') === 'checked') {
            $(e).attr('checked', false);
            var item = $(e).attr('data-item');
            $('#motivo'+item).show();
        } else {
            $(e).attr('checked', true);
            var item = $(e).attr('data-item');
            if($('#motivoInpt'+item).val() === '') {
                $('#motivo'+item).hide();
            }
        }
    }

    function clickObservacao(e) {
        var id = $(e).attr('id');
        if(id !== '') {
            var split = id.split('_');
            $('#motivo'+split[1]).toggle();
        }
    }

    function clickFoto(e) {
        var item = $(e).attr('data-item');
        if(item !== '') {
            $('#foto'+item).toggle();
            cameraActivate(item);
        }
    }

    $("#salvar").click(function(){
        var json = [];
        $('.item').each(function() {
            item = $(this).attr('data-item');
            situacao = $('#situacao'+item).attr('checked') ? 'C' : 'NC' ;
            motivo = $("#motivoInpt"+item).val();
            add = {'item':item, 'situacao':situacao, 'motivo':motivo};
            json.push(add);
        });
        $.ajax({
          method: "POST",
          url: "<?php echo BASE_URL; ?>farol/post/<?php echo $farolid.'/'.$reservatorio; ?>",
          data: {data : json}
        })
        .done(function( msg ) {
            $("#show").hide('fast');
            $("#ok").show('fast');
        });
    });

    function cameraActivate(idCamera) {
        var video = document.querySelector('#video'+idCamera);

        var getUserMedia = (navigator.webkitGetUserMedia ||
                            navigator.mozGetUserMedia ||
                                navigator.msGetUserMedia).bind(navigator);

        var mediaStream;
        function iniciaVideo (stream) {
            video.srcObject = stream;
            mediaStream = stream;
        }

        function trataErroMedia (erro) {
            console.error('Erro: ' + erro);
        }

        var configuracaoMedia = {
            video: {
                optional: [{maxWidth: 320},{maxHeight: 240}]
            }, 
            audio: 		false
        };

        getUserMedia(configuracaoMedia, iniciaVideo, trataErroMedia);

        var canvas = document.querySelector('#canvas'+idCamera);
        canvas.width = 320;
        canvas.height = 240;

        var botaoTiraFoto = document.querySelector('#tira-foto'+idCamera);
        botaoTiraFoto.addEventListener('click', function (e) {
            if (mediaStream) {
                canvas.getContext('2d').drawImage(video, 0, 0, 320, 240);
                var dados = canvas.toDataURL('image/png');
                //fazer algo com os dados...
                mediaStream.getVideoTracks().forEach(function (media) {
                media.stop();
                });
                video.style.display = 'none';
                canvas.style.display = '';
                mediaStream = null;
            } else {
                getUserMedia(configuracaoMedia, iniciaVideo, trataErroMedia);
                video.style.display = '';
                canvas.style.display = 'none';
            }
        });
    }
</script>