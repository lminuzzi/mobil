
<div class="container">
    <div class="row">
        <div class="span8 offset2">
        <div class="widget widget-nopad">
              <div class="widget-content">
                <div class="widget big-stats-container">
                  <div class="widget-content">
                    <h6 class="bigstats reservatorio" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; line-height:10px;"> <i class="fa fa-check-circle"></i> Checklist </b>
                                        </h6>
                    </div>
                    <div class="footer-reservatorio" style="text-align:center; color:#aaa">  <i class="fa fa-check-circle-o "></i> <b style="font-weight: bolder; font-size:110%;"> <?php echo count($farois); ?> Itens cadastrados</b>
                    <br>
                    </div>
                    <div style="padding: 10px;">
                            <style>
                                    table, tr, td {
                                        text-align:center;
                                        margin: 0 auto;
                                    }
                                </style>
                        <table class="table table-condensed text-center">
                            <tr>

                                <th class="span3 text-center"> Código </th>
                                <th class="span3 text-center"> Item </th>
                            </tr>

                            <?php if (count($farois > 0)) : ?>
                                <?php foreach ($farois as $farol) : ?>
                                <tr style="padding: 10px !important; text-align: center; margin: 0 auto;">
                                <td class="text-center">  <?php echo $farol['id']; ?> </td>
                                <td class="text-center"> <?php echo $farol['item']; ?></td>
                               </tr>
                                <?php
                                endforeach;
                            endif; ?>
                        </table>
                    </div>
                  </div>
                </div>
                <!-- /widget-content -->
              </div>
        </div>
    </div>
