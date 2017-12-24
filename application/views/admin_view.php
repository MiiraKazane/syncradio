<!DOCTYPE html>
<head>
    <title><?= $titulo ?></title>
    
    <?php $ci =& get_instance();
    $ci->load->view("navbar_view"); ?>
</head>
    <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Inicio
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
      </ol>
    </section>
<br>
<?php if($this->session->userdata('tipo') == '1') { ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src="<?= (IMG . 'bestia.png'); ?>" width="80" height="80">
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" data-toggle="tooltip" title="resueltos/total"><?= $num_bestia_unresolved ?>/<?= $num_bestia ?></div>
                        </div>
                    </div>
                </div>
                <a href="<?= (URL . 'index.php/report_bestia'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver reportes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src="<?= (IMG . 'love.png'); ?>" width="100" height="80">
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $num_love_unresolved ?>/<?= $num_love ?></div>
                        </div>
                    </div>
                </div>
                <a href="<?= (URL . 'index.php/report_love'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver reportes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="hidden-xs col-sm-4 col-md-3 col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src="<?= (IMG . 'super.png'); ?>" width="100" height="80">
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $num_super_unresolved ?>/<?= $num_super ?></div>
                        </div>
                    </div>
                </div>
                <a href="<?= (URL . 'index.php/report_super'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver reportes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
         <div class="hidden-xs hidden-sm col-md-3 col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                           <i class="fa fa-list-ol fa-5x" aria-hidden="true"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $num_normal_unresolved ?>/<?= $num_normal ?></div>
                            <div> </div>
                        </div>
                    </div>
                </div>
                <a href="<?= (URL . 'index.php/nreport'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver reportes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div></div>
<?php } ?>
</div>
<script type="application/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>
</html>
