<div class="col-md-12 page-heading bg-color-title-pagina">
    <div class="row">
        <h3>Gerenciar DashBoards</h3>
    </div>
</div>

<?php echo $this->Session->flash(); ?>
<?php echo $this->Html->css('usuarios/highlight.css') ?>
<?php echo $this->Html->css('usuarios/bootstrap-switch.min.css') ?>
<link href="http://getbootstrap.com/assets/css/docs.min.css" rel="stylesheet">
<?php echo $this->Html->script('funcoes.js') ?>



<div class="col-md-12 page-heading">
    <div class="row">
        <h3 class="dash-theme-style text-center title-dash">Escolha os Filtros para os dados dos Servidores</h3>
    </div>
</div>
    
            
<?php echo $this->Form->create('Dashboards', array('novalidate','controller' => 'dashboards', 'url' => 'visualizar', 'inputDefaults' => array('div' => array('class' => 'col-sm-12 form-group'))));?>

<div class="col-sm-3">

</div>

<div class="col-sm-3">
    <?php echo $this->Form->input('tipo_servico_id', array('empty' => 'Selecione o tipo de serviço', 'onchange' => "javascript:void(mostra_texto_servico_dash(this.value))", 'label' => array('text' => false), 'id' => 'tipo_servico_id' ,'class' => 'form-control')); ?>
</div>


<div class="col-sm-3">
        <?php echo $this->Form->input('periodo_dash_id', array('options' => array(
                 '1' => 'Hoje',
                 '2' => 'Ultimo Mes',
                 '3' => '3 Meses'
     ),'label' => array('text' => false), 'id' => 'periodo_dash_id', 'empty' => 'Selecione o Periodo'));?>

</div>

<div class="col-sm-3">

</div>


<div class="col-sm-12">
    <div class="text-center">
        <?php echo $this->Form->end(array('label' => 'Gerar Graficos >>', 'class' => 'btn btn-green-default btn-lg', 'id' => 'enviar', 'style'=>"margin-top:30px;", 'div' => false, 'onclick' => ''));?>
    </div>
</div>


