<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Check Server</title>

		<!-- Styles -->
		<?php echo $this->Html->css('https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css'); ?>
		<?php echo $this->Html->css('bootstrap/css/bootstrap.min.css') ?>
		<?php echo $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css') ?>
		<?php echo $this->Html->css('animate.min.css') ?>
		<?php echo $this->Html->css('inspinia.css') ?>
		<?php echo $this->Html->css('cake.css') ?>
		<?php echo $this->Html->css('styles.css') ?>

		<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

		<!-- Scripts -->
		<?php echo $this->Html->script('jquery-2.2.3.min.js') ?>
		<?php echo $this->Html->script('jquery.mask.min.js'); ?>
		<?php echo $this->Html->script('funcoes.js') ?>
		<?php echo $this->Html->script('highcharts.js') ?>
		<?php echo $this->Html->script('highcharts-3d.js') ?>
		<?php echo $this->Html->script('exporting.js') ?>
		
		<?php
			echo $this->Html->meta ( 'favicon.ico', 'img/favicon.ico', array (
			    'type' => 'icon' 
			) );
		?>
		<script>
			var cakebase = "<?php echo Router::url('/', true); ?>";
		</script>
	</head>

	<body>
		<div id="wrapper" class="background-image">

			<!-- Manu lateral -->
			<nav class="navbar-default navbar-static-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu" style="display: block;">
						<li class="nav-header">
							<div class="text-center profile-element" style="padding: 15px;"> 
								<?= $this->Html->image('logo-cksrv.png', array('style' => 'width:150px;')) ?>
							</div>
							<div class="logo-element shojumaru logo-navbar background-image">
									<?= $this->Html->image('logo-cksrv.png', array('style' => 'width:70px;')) ?>
							</div>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-television"></i> <span class="nav-label">Monitorar</span>', array('admin' => false, 'controller' => 'monitoramento', 'action' => 'index'), array('escape' => false)) ?> 
						</li>
						<?php echo AuthComponent::user('perfil_id') == 1 ? '<li>'.$this->Html->link('<i class="fa fa-server"></i> <span class="nav-label">Gerenciar Servidores</span>', array('admin' => true, 'controller' => 'servidores', 'action' => 'index'), array('escape' => false)).'</li>' : ''; ?> 
						
						<?php echo AuthComponent::user('perfil_id') == 1 ? '<li>'.$this->Html->link('<i class="fa fa-user"></i> <span class="nav-label">Gerenciar Usuários</span>', array('admin' => true, 'controller' => 'usuarios', 'action' => 'index'), array('escape' => false)).'</li>' : '';?>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-dashboard"></i> <span class="nav-label">Gerenciar Dashboards</span>', array('admin' => true, 'controller' => 'dashboards', 'action' => 'index'), array('escape' => false)) ?> 
						</li>
					</ul>
				</div>
			</nav>

			<!-- Cabeçalho -->
			<div id="page-wrapper" class="white-bg" style="min-height: 521px;">
				<div class="row header-border-bottom">
					<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
						<div class="navbar-header col-md-1">
							<a class="navbar-minimalize btn btn-default" href="#"><i class="fa fa-bars"></i> </a>	
						</div>
						<div class="col-md-9">
							<h3 class="page-heading pull-right">Seja bem vindo <?php echo AuthComponent::user('nome') ?></h3>
						</div>
						<ul class="pull-right navbar-top-links col-md-2">
							
							<?php 
							if(AuthComponent::user('id')): ?>
								<li class="pull-right"><?php echo $this->Html->link('<i class="fa fa-sign-out"></i> Logout', array('admin' => false, 'controller' => 'usuarios', 'action' => 'logout'), array('escape' => false)) ?></li>
							<?php endif; ?>
						</ul>
					</nav>
				</div>

				<!-- Centro da página, onde as outras serão carregadas -->
				<div class="row wrapper page-heading no-padding min-height white-bg">
					<div class="col-sm-12 no-padding">
						<?php echo $this->fetch('content') ?>
						<?php #echo $this->element('sql_dump') ?>
					</div>
				</div>

				<!-- Rodapé - Footer -->
				<footer class="footer text-center" style="margin-top:50px">
					<div>
						<strong><?= $this->Html->image('favicon.ico') ?> Check-Server</strong> 2016 - <?php echo date('Y')?></div>
					</div>
				</footer>
			</div>
		</div>
		<!-- Mainly scripts -->
		<?php echo $this->Html->script('bootstrap/js/bootstrap.min.js') ?>
		<?php echo $this->Html->script('metisMenu.min.js') ?>
		<?php echo $this->Html->script('jquery.slimscroll.min.js') ?>
		<?php echo $this->Html->script('inspinia.js') ?>
		<?php echo $this->Html->script('jquery-ui.min.js') ?>		
	</body>
</html>