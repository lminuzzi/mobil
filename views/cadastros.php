    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="container" style="text-align:center; margin-bottom: 20px;">
                <!--
                <input type="text" placeholder="Filtrar Cadastro" id="fEq">
                <div style="float:right" style="margin: 0 10px;">
                <a href="<?php echo BASE_URL; ?>home/default" style="color:#888;"><i class="fa fa-th fa-3x"></i></a>  
                <a href="<?php echo BASE_URL; ?>home/lista" style="color:#ccc;">
                <i class="fa fa-list fa-3x"></i>
                </a>
                </div>
                -->
                <?php 
                $arrayInputs = array(
                    array(
                        'formBase'   => 'usuarios',
                        'titleBase'  => 'Usuários',
                        'iconBase'  => 'users'
                    ),
                    array(
                        'formBase'   => 'clientes',
                        'titleBase'  => 'Clientes',
                        'iconBase'  => 'building'
                    ),
                    array(
                        'formBase'   => 'sites',
                        'titleBase'  => 'Sites',
                        'iconBase'  => 'sitemap'
                    ),
                    array(
                        'formBase'   => 'reservatorios',
                        'titleBase'  => 'Equipamentos',
                        'iconBase'  => 'tags'
                    ),
                    array(
                        'formBase'   => 'areas',
                        'titleBase'  => 'Áreas',
                        'iconBase'  => 'cubes'
                    ),
                    array(
                        'formBase'   => 'tiposequipamentos',
                        'titleBase'  => 'Tipos de Equipamentos',
                        'iconBase'  => 'list-ul'
                    ),
                    array(
                        'formBase'   => 'tiposreservatorios',
                        'titleBase'  => 'Tipos de Reservatórios',
                        'iconBase'  => 'flask'
                    ),
                    array(
                        'formBase'   => 'tecnicasaplicadas',
                        'titleBase'  => 'Técnicas Aplicadas',
                        'iconBase'  => 'wrench'
                    ),
                    array(
                        'formBase'   => 'tiposdesvios',
                        'titleBase'  => 'Tipos de Desvios',
                        'iconBase'  => 'times-circle'
                    ),
                    array(
                        'formBase'   => 'fabricantes',
                        'titleBase'  => 'Fabricantes',
                        'iconBase'  => 'industry'
                    ),
                    array(
                        'formBase'   => 'modelos',
                        'titleBase'  => 'Modelos',
                        'iconBase'  => 'truck'
                    ),
                    array(
                        'formBase'   => 'farol',
                        'titleBase'  => 'Checklist',
                        'iconBase'  => 'check-circle-o'
                    )
                );
                ?>
            </div>
            </div>
            <?php 
            foreach($arrayInputs as $input) :
            ?>
                <div class="span2">
                    <!-- /widget -->
                        <div class="row">
                            <div class="span2 span-sm-3 reservatorio" data-tag="<?php echo $input['titleBase']; ?> ">
                            
                                <div class="widget widget-nopad" style="margin-bottom: 75px;">
                                    <div class="reservatorio-header widget-content" style="text-align:center; background-color:#fff; ?>; z-index:0;">
                                        <h3 class="" style="color:#000; margin-top: 4px; margin-bottom: 8px; font-family: Segoe Ui, Verdana, Sans-Serif; font-weight: bold; font-size:110%; text-align:center; cursor: pointer;">
                                            <a href="<?php echo BASE_URL.$input['formBase'] ?>" >
                                            <div style="margin-left: 25px;">
                                                <div><i class="fa fa-<?php echo $input['iconBase'] ?>" style="color:gray; postion: absolute; left: -20px; top: 5px; font-size:735%;"></i></div>
                                                <div>&nbsp;</div>
                                                <div><?php echo $input['titleBase'] ?></div>
                                            </div>
                                            </a>
                                        </h3>
                                    </div>
                                    <!-- /widget-header -->
                                    
                <!-- /widget-content -->
                            </div>
                        </div>
                    </div>
                    <!-- /widget -->
                </div>
            <?php endforeach; ?>
        <!-- /span6 -->
            <div class="clearfix"></div>
      </div>
      <!-- /row -->
<style>
.trdisable {
    background-color:#cecece;
    opacity: 0.5;
}
    .green {
        color:green;
    }
    .red {
        color:red;
    }
</style>


    </div>
    <!-- /container -->

<script>
  $("#fEq").keyup(function(){
    var val = $("#fEq").val().toUpperCase();
    if (val == '') {
      var regex = new RegExp('');
    } else {
      var regex = new RegExp(val);
    }

    console.log(regex.test('CM2330'));
    //console.log(val);

    $(".reservatorio").each(function(res){
      if (!regex.test($(this).attr('data-tag').toUpperCase())) {
          $(this).hide('fast');
      } else {
        $(this).show('fast');
      }
    })
  });
</script>