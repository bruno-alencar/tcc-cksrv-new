<!-- Styles -->
		<?php echo $this->Html->css('https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css'); ?>
		<?php echo $this->Html->css('bootstrap/css/bootstrap.min.css') ?>
		<?php echo $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css') ?>
		<?php echo $this->Html->css('animate.min.css') ?>
		<?php echo $this->Html->css('inspinia.css') ?>
		<?php echo $this->Html->css('cake.css') ?>
		<?php echo $this->Html->css('styles.css') ?>

<style type="text/css">
	.shadow{text-shadow: 1px 2px #000;}
	.shadow-box{-webkit-box-shadow: 1px 4px 10px 0px rgba(0,0,0,0.75); -moz-box-shadow: 1px 4px 10px 0px rgba(0,0,0,0.75); box-shadow: 1px 4px 10px 0px rgba(0,0,0,0.75); height: 540px; width: 840px; margin: 0 auto; border-radius: 15px; background: #fff; margin-top: 100px; padding-top: 30px;}
	.login-left, .login-right{width: 400px; height: 433px}
	.main-container:before, .page-content{background-color: transparent;}
	*{font-family: Arial}
	.login-left{border-right: solid 1px #CCC;}
</style>
<div class="row shadow-box">
<?= $this->Html->image('logo-cksrv.png', array('style' => 'width:180px; margin-right:90px;', 'class' => 'pull-right')) ?>
	<div class="col-sm-12">
		<div class="login-container">
			<div class="position-relative">
				<div id="login-box" class="login-box visible widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">

							<h4 class="header blue lighter bigger">
								<i class="ace-icon fa fa-coffee green"></i>
								Login
							</h4>
							<br>
							 <?php echo $this->Form->create('Usuario', array('url' => array('controller' => 'usuarios', 'action' => 'login'))); ?>
							  <div class="form-group">
							    <label>Login</label>
							    <input name="data[Usuario][login]" type="login" class="form-control" placeholder="Login">
							  </div>
							  <div class="form-group">
							    <label>Senha</label>
							    <input name="data[Usuario][senha]" type="password" class="form-control" placeholder="Senha">
							  </div>
							  <?php echo $this->Session->flash(); ?>
							  <br>
							<?php echo $this->Form->end(array('label' => 'OK', 'div' => false, 'class' => 'btn btn-default')); ?>
						</div><!-- /.widget-main -->
					</div><!-- /.widget-body -->
				</div><!-- /.login-box -->
			</div><!-- /.position-relative -->
		</div>
	</div><!-- /.col -->
</div>

