<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Grease Monitor</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>/assets/css/bootstrap-responsive.min.css" rel="stylesheet">
<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">-->
<link href="<?php echo BASE_URL; ?>/assets/font/fonts-googleapis.css"
        rel="stylesheet">
<link href="<?php echo BASE_URL; ?>/assets/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>/assets/css/style.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>/assets/css/pages/dashboard.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>/assets/css/sweetAlert.css" rel="stylesheet">
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">-->
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="<?php echo BASE_URL; ?>/assets/js/jquery-1.7.2.min.js"></script>
</head>
<body>
<div class="linha"></div>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> 
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </a>
      <a class="brand" href="<?php echo BASE_URL; ?>">
        <img src="<?php echo BASE_URL; ?>assets/img/gm.png">
      </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> Minha Conta <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Alterar Senha</a></li>
              <li><a href="<?php echo BASE_URL; ?>/login/logout">Sair</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-search pull-right">
          <input id="tags" type="text" class="search-query" placeholder="O que você quer fazer?">
        </form>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!-- /container -->
  </div>
  <!-- /navbar-inner -->
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="active"><a href="<?php echo BASE_URL; ?>"><i class="icon-dashboard"></i><span>Painel de Controle</span> </a> </li>
        <li><a href="<?php echo BASE_URL; ?>home/cadastros/"><i class="fa fa-cogs"></i><span>Cadastros</span></a></li>
        <!--
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-users"></i><span>Usuários</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo BASE_URL; ?>usuarios/adicionar"><i class="fa fa-plus"></i> Adicionar</a></li>
            <li><a href="<?php echo BASE_URL; ?>usuarios/"><i class="fa fa-edit"></i> Gerenciar</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-building"></i><span>Clientes</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo BASE_URL; ?>clientes/adicionar"><i class="fa fa-plus"></i> Adicionar</a></li>
            <li><a href="<?php echo BASE_URL; ?>clientes/"><i class="fa fa-edit"></i> Gerenciar</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-sitemap"></i><span>Sites</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
          <li><a href="<?php echo BASE_URL; ?>sites/adicionar"><i class="fa fa-plus"></i> Adicionar</a></li>
            <li><a href="<?php echo BASE_URL; ?>sites/"><i class="fa fa-edit"></i> Gerenciar</a></li>
          </ul>
        </li>
         <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cogs"></i><span>Equipamentos</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo BASE_URL; ?>reservatorios/adicionar"><i class="fa fa-plus"></i> Adicionar</a></li>
            <li><a href="<?php echo BASE_URL; ?>reservatorios/"><i class="fa fa-edit"></i> Gerenciar</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cubes"></i><span>Áreas</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo BASE_URL; ?>areas/adicionar"><i class="fa fa-plus"></i> Adicionar</a></li>
            <li><a href="<?php echo BASE_URL; ?>areas/"><i class="fa fa-edit"></i> Gerenciar</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-list-ul"></i><span>Tipos de Equipamentos</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo BASE_URL; ?>tiposequipamentos/adicionar"><i class="fa fa-plus"></i> Adicionar</a></li>
            <li><a href="<?php echo BASE_URL; ?>tiposequipamentos/"><i class="fa fa-edit"></i> Gerenciar</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-industry"></i><span>Fabricantes</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo BASE_URL; ?>fabricantes/adicionar"><i class="fa fa-plus"></i> Adicionar</a></li>
            <li><a href="<?php echo BASE_URL; ?>fabricantes/"><i class="fa fa-edit"></i> Gerenciar</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-truck"></i><span>Modelos</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo BASE_URL; ?>modelos/adicionar"><i class="fa fa-plus"></i> Adicionar</a></li>
            <li><a href="<?php echo BASE_URL; ?>modelos/"><i class="fa fa-edit"></i> Gerenciar</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-tint"></i><span>Consumo</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo BASE_URL; ?>horimetros/atualizar"><i class="fa fa-tachometer"></i> Atualizar Horímetros</a></li>
            <li><a href="<?php echo BASE_URL; ?>refil/"><i class="fa fa-thermometer-full"></i> Completar Reservatórios </a></li>
          </ul>
        </li>
        -->
        <li><a href="<?php echo BASE_URL; ?>importacoes/"><i class="fa fa-file-text"></i><span>Importar Excel</span></a></li>
        <li><a href="<?php echo BASE_URL; ?>relatorios/"><i class="fa fa-bar-chart-o"></i><span>Relatórios</span></a></li>
      </li>
      <li class=""><a href="<?php echo BASE_URL; ?>farol/"><i class="fa fa-tasks"></i> <span>Responder Checklist</span> </a> </li>

      </ul>
    </div>
    <!-- /container -->
  </div>
  <!-- /subnavbar-inner -->
</div>
<!-- /subnavbar -->
<div class="main" >
<script>
$(document).ready(function(){
  var h = $(window).height();
  h = h-350;
  $("#inner").css('min-height',h+'px');
});
</script>
  <div class="main-inner" id="inner">
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>
    </div>
  <!-- /main-inner -->
</div>
<!-- /main -->

<!-- /extra -->
<div class="footer" style="margin:0 !important; margin-top: 100px !important;">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; 2018 <a href="<?php echo BASE_URL; ?>">Grease Monitor</a>. </div>
        <!-- /span12 -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /footer-inner -->
</div>
<!-- /footer -->
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!--<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/font-awesome.min.css">-->

<script src="<?php echo BASE_URL; ?>/assets/js/bootstrap.js"></script>
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<script src="<?php echo BASE_URL; ?>/assets/js/jquery-ui-1.12.1.js"></script>
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/jquery-ui.css">

<script src="<?php echo BASE_URL; ?>/assets/js/base.js"></script>
<script>
  $( function() {
    var availableTags = [
    // Usuários
    {value: 'usuarios/adicionar', label: 'Adicionar Usuários'},
    {value: 'usuarios/adicionar', label: 'Cadastrar Usuários'},
    {value: 'usuarios/adicionar', label: 'Incluir Usuários'},
    {value: 'usuarios/adicionar', label: 'Criar Usuários'},
    {value: 'usuarios/adicionar', label: 'Editar Usuários'},
    {value: 'usuarios/adicionar', label: 'Alterar Usuários'},
    {value: 'usuarios/adicionar', label: 'Excluir Usuários'},
    {value: 'usuarios/adicionar', label: 'Deletar Usuários'},

    //Veículos
    {value: 'veiculos/adicionar', label: 'Adicionar Veículos'},
    {value: 'veiculos/adicionar', label: 'Cadastrar Veículos'},
    {value: 'veiculos/adicionar', label: 'Incluir Veículos'},
    {value: 'veiculos/adicionar', label: 'Criar Veículos'},
    {value: 'veiculos/adicionar', label: 'Editar Veículos'},
    {value: 'veiculos/adicionar', label: 'Alterar Veículos'},
    {value: 'veiculos/adicionar', label: 'Excluir Veículos'},
    {value: 'veiculos/adicionar', label: 'Deletar Veículos'},



    ];
    $( "#tags" ).autocomplete({
      source: availableTags,
      select: function( event, ui ) {
            window.location.href = '<?php echo BASE_URL; ?>/'+ui.item.value;
        }
    });
  } );
  </script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>-->
  <script src="<?php echo BASE_URL; ?>/assets/js/sweetalert.min.js"></script>
  <script>
$(document).ready(function(){
    <?php if (isset($_SESSION['error'])) : ?>
 sweetAlert("Oops...", "<?php echo $_SESSION['error']; ?>", "error");
    <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])) : ?>
 sweetAlert("Sucesso!", "<?php echo $_SESSION['success']; ?>", "success");
    <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
});
  </script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>
</html>
