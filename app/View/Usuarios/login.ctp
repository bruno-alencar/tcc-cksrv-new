<div class="row">
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
							<?php echo $this->Form->end(array('label' => 'OK', 'div' => false, 'class' => 'btn btn-default')); ?>
						</div><!-- /.widget-main -->
					</div><!-- /.widget-body -->
				</div><!-- /.login-box -->
			</div><!-- /.position-relative -->
		</div>
	</div><!-- /.col -->
</div>

