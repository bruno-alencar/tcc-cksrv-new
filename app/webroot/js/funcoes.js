$(function(){

	$( "a.showmodal, .disabledefaultfunction" ).click(function(event){
		event.preventDefault();
	});

	$('.status-atendimento').change(function(){
		var atendimento = $(this).data('atendimento');
		var novo_status_id = $(this).val();
		$.post(cakebase+'atendimentos/altera_status_atendimento/'+atendimento+'/'+novo_status_id);
	});

	$('.status-servico').change(function(){
		var atendimento = $(this).data('servico');
		var novo_status_id = $(this).val();
		$.post(cakebase+'atendimento_servicos/altera_status_servico/'+atendimento+'/'+novo_status_id);
	});

	$('tr[data-href]').click(function(){
		document.location = $(this).data('href');
	});

	$( ".autocomplete" ).autocomplete({
		source: cakebase+'/clientes/autocomplete_empresas',
		minLength: 3,
		select: function(event, ui) {
			var cliente_id = ui.item.label.split("-")[0];
			$('input[name="data[Atendimento][cliente_id]"]').val(ui.item.label.split("-")[0]);
			carrega_contatos(ui.item.label.split("-")[0]);
		}
	});

	jQuery(function($){
	  $(".telefone").mask("(99) 9999-9999");
	});

	jQuery(function($){
	  $(".cnpj").mask("99.999.999/9999-99");
	});

	jQuery(function($){
	  $(".cpf").mask("999.999.999-99");
	});

	jQuery(function($){
	  $(".cep").mask("99.999-999");
	});

});

function sleep(milliseconds) {
	var start = new Date().getTime();
	for (var i = 0; i < 1e7; i++) {
		if ((new Date().getTime() - start) > milliseconds){
			break;
		}
	}
}

function carrega_contatos(cliente_id){
	$.post(
		cakebase+'/clientes/carrega_contatos/'+cliente_id,
			function(data){
				$(".contatos option").remove();
				$('.contatos').append('<option value="">Selecione um contato</option>');
				$.each(data, function(key, val){
					$('.contatos').append('<option value="'+ key +'">'+ val +'</option>');
				});
			}, 'json'
	);
}

function toUpper(value){

	var texto = $('#'+value+'').val();

	$('#'+value+'').val(texto.toUpperCase());
}

function exibeModal(element){

	$("#myModal").remove();

		// Para que os efeitos abaixo funcionem o arquivo animate.css deve estar carregado
		var effects = ["bounce","pulse","rubberBand","shake","swing","tada","wobble","bounceIn","bounceInDown","bounceInLeft","bounceInRight","bounceInUp","fadeIn","fadeInDown","fadeInDownBig","fadeInLeft","fadeInLeftBig","fadeInRight","fadeInRightBig","fadeInUp","fadeInUpBig","flip","flipInX","flipInY","lightSpeedIn","rotateIn","rotateInDownLeft","rotateInDownRight","rotateInUpLeft","rotateInUpRight","slideInDown","slideInLeft","slideInRight","rollIn"];

		var modalWrapper = $('<div/>').attr('id', 'myModal').attr('tabindex', '-1').attr('role', 'dialog').attr('aria-hidden', 'true').addClass('modal inmodal');
		var modalDialog = $('<div/>').addClass('modal-dialog modal-lg');
		// var modalContent = $('<div/>').addClass('modal-content animated').addClass(effects[Math.floor((Math.random() * 50) + 1)]);
		var modalContent = $('<div/>').addClass('modal-content animated').addClass('');
		var modalHeader = $('<div/>').addClass('modal-header');
		var modalTitle = $('<h6/>').addClass('modal-title');
		var modalBody = $('<div/>').addClass('modal-body');
		var modalFooter = $('<div/>').addClass('modal-footer');
		var closeModal = $('<button/>').attr('data-dismiss', 'modal').addClass('close').text('x');

		modalHeader.append(closeModal);
		modalHeader.append(modalTitle);
		modalContent.append(modalHeader);
		modalContent.append(modalBody);
		// modalContent.append(modalFooter);

		modalDialog.append(modalContent);
		modalWrapper.append(modalDialog);

		$('body').append(modalWrapper);

		$('.modal-title').text(element.title);
		$('.modal-body').load(element.href);
		$("#myModal").modal('show');
	}

	function showToastrNotification(toastType, message, title){


		// Para exibir as Toastr Notifications é necessário carregar seus respectivos css e js
		// Types: warning, error, info, success

		var nEasing = Math.floor(Math.random() * (2 - 0)) + 0;
		var nMethod = Math.floor(Math.random() * (3 - 0)) + 0;

		var easing = ['swing', 'linear'];
		var showMethod = ['show', 'fadeIn', 'slideDown'];
		var hideMethod = ['hide', 'fadeOut', 'slideUp'];

		toastr.options = {
			"closeButton": true,
			"debug": false,
			"progressBar": true,
			"preventDuplicates": false,
			"positionClass": "toast-top-right",
			"onclick": true,
			"showDuration": "5000",
			"hideDuration": "5000",
			"timeOut": "5000",
			"extendedTimeOut": "5000",
			"showEasing": easing[nEasing],
			"hideEasing": easing[nEasing],
			"showMethod": showMethod[nMethod],
			"hideMethod": hideMethod[nMethod]
		}

		if(title)
			toastr[toastType](message, title);
		else
			toastr[toastType](message);

	}

// Funções para frases prontas
var AtalhoFrases = {

	obter_frase: function(id, sigla){
		$.post(
			baseUrl()+'/pregoes/obter_frase/'+sigla,
			function(data) {
				if(data)
					$('#'+id).val($('#'+id).val().replace(sigla, data+' '));
			}
			);
	},
	retornaPalavra: function(texto, caretPos) {
		var index = texto.indexOf(caretPos);
		var preTexto = texto.substring(0, caretPos);
		if (preTexto.indexOf(" ") > 0) {
			var words = preTexto.split(" ");
					return words[words.length - 1]; //return last word
				}
				else {
					return preTexto;
				}
			},
			obter_sigla: function(id){
				var texto = document.getElementById(id);
				var caretPos = AtalhoFrases.obterPosicaoCursor(texto)
				var word = AtalhoFrases.retornaPalavra(texto.value, caretPos);

				return word;
			},
			obterPosicaoCursor: function(ctrl){
			var CaretPos = 0;   // IE Support
			if (document.selection) {
				ctrl.focus();
				var Sel = document.selection.createRange();
				Sel.moveStart('character', -ctrl.value.length);
				CaretPos = Sel.texto.length;
			}
			// Firefox support
			else if (ctrl.selectionStart || ctrl.selectionStart == '0')
				CaretPos = ctrl.selectionStart;
			return (CaretPos);
		}
	}

	function busca_info_cep(cep){

		cep = cep.replace('.', '').replace('-', '');

		jQuery.get(
			'http://api.postmon.com.br/v1/cep/'+cep,
			function(resposta){

				var estado = resposta.estado_info.nome ? resposta.estado_info.nome : resposta.estado;
				var logradouro = resposta.logradouro ? resposta.logradouro : resposta.endereço;

				$("input[name*='logradouro']").val(logradouro);
				$("input[name*='bairro']").val(resposta.bairro);
				var estado_id = $(".estado option:contains("+estado+")").attr('selected','selected');

				buscaCidades(estado_id.val());

				setTimeout(function(){jQuery(".cidade option:contains("+resposta.cidade+")").attr('selected','selected');}, 1000);
			}
			).fail(function(){
				showToastrNotification('error', 'CEP não encontrado.', 'Atenção!');
			});
		}

		function buscaCidades(estado){
			$.post(
				'/projeto-concorrentes/cidades/busca/'+estado,
				function (resposta){
					$(".cidade option").remove();
					$.each(resposta, function(key,val){
						$('.cidade').append('<option value="'+ key +'">'+ val +'</option>')
					});
				}, 'json'
			);
		}

		function buscaEmpresas(){
			$('.cnl_controle').blur(function(){
				$.post(
					cakebase+'/clientes/busca_cliente_controle/'+$(this).val(),
					function (data){
						if(data.Cliente != undefined){
							$('.cnpj').val(data.Cliente.cnpj);
							$('.razao_social').val(data.Cliente.razao_social);
							$('.nome_fantasia').val(data.Cliente.nome_fantasia);
						}else{
							$('.cnpj, .razao_social, .nome_fantasia').val('');
							showToastrNotification('error', 'Empresa não encontrada.', 'Atenção!');
						}
					}, 'json'
					);
			});
		}

		function ajax_validation(model, controller){

			$('form').submit(function(){

				var fid=$(this).attr('id');
				var formData = $('#'+fid).serialize();

				$.ajax({
					type : 'POST',
					url : '/projeto-concorrentes/validation_forms/ajax_validation/'+model,
					data: formData,
					beforeSend: function(){
						$('input[type=\'submit\']').val('Verificando...');
						$('input[type=\'submit\']').attr('disabled', true);
						$(".error-message").remove();
					},
					success: function(response){

						var response=jQuery.parseJSON(response);

						if(response.status=='error'){

							$('input[type=\'submit\']').attr('disabled', false);
							$('input[type=\'submit\']').val('Salvar');
							$(".msg").text(response.message);

							$.each(response.data, function(key, val){
								$.each(val, function(key, val){
									var element = $("#"+camelcase(model+'_'+key));
									var create = $('<span/>').insertAfter(element);
									create.addClass('error-message col-sm-6 col-sm-offset-2').text(val[0]);
								}
								);
							}
							);
						}else{
							$('form').unbind('submit').submit();
						}
					}
				});
				return false;
			});
		}

		function camelcase(inputstring) {
			var a = inputstring.split('_'), i;
			s = [];
			for (i=0; i<a.length; i++){
				s.push(a[i].charAt(0).toUpperCase() + a[i].substring(1));
			}
			s = s.join('');
			return s;
		}

// Função para efetuar upload de arquivos via ajax

$('input:file').change(function(e){

	var totalsize = 0;
	var inputId = $(this).attr('id');

	files = e.target.files;

	if (window.FormData) {
		formdata = new FormData();
	}else{
		alert('Este browser não suporta upload de arquivos via ajax.');
		return false;
	}

	$.each(files, function(key, value){
		if(this.size > 10000000){
			alert('Este arquivo excede o limite de tamanho para anexos de e-mails.');
		}else{
			formdata.append(key, value);
		}

		totalsize += this.size;
	});
	
	if(totalsize > 10000000){
		alert('O limite de tamanho para anexos foi excedido.');
		$('#'+inputId).val('');
		return false;
	}

	if (formdata){
		$.ajax({
			url: "upload.php",
			type: "POST",
			data: formdata,
			processData: false,
			contentType: false,
			success: function (res) {
				document.getElementById("response").innerHTML = res; 
			}
		});
	}
});

/** Upload de Arquivos via Ajax com listagem de arquivos enviados **/

var Email = {

	enviarAnexo: function(){
		jQuery('input:file').change(function(e){

			e.preventDefault();

			jQuery('input:file+div.carregando').toggle();

			var totalsize = 0;
			var inputId = jQuery(this).attr('id');
			var referencia = jQuery(':file').attr('data-referencia');
			var mensagem = '';

			files = e.target.files;

			if (window.FormData) {
				formdata = new FormData();
			}else{
				alert('Este browser não suporta upload de arquivos via ajax.');
				return false;
			}

			jQuery.each(files, function(key, value){
				if(this.size > 10000000){
					mensagem += 'O arquivo '+this.name+' excede o limite de tamanho para anexos de e-mails.';
				}else{
					formdata.append(key, value);
				}
				
				totalsize += this.size;
			});

			if (formdata){
				jQuery.ajax({
					url: cakebase+'/admin/anexos/add_multiplo/'+referencia+'/Email',
					type: "POST",
					data: formdata,
					processData: false,
					contentType: false,
					success: function (resposta) {
						jQuery('#'+inputId).val('');
						Email.listaAnexos();
						jQuery('input:file+div.carregando').toggle()
					},
				});
			}

		});
	},
	listaAnexos: function(){
		jQuery.post(
			cakebase+'/admin/anexos/lista_anexos/'+jQuery(':file').attr('data-referencia'),
			function (resposta){
				
				var obj = jQuery.parseJSON(resposta);
				jQuery('.exibe-anexos').empty();

				jQuery.each(obj, function(index, element){
					anexo = jQuery('<a/>')
					.attr('href', 'javascript:void(0)')
					.attr('onclick', 'Email.excluirAnexo(this)')
					.addClass('anexo-email')
					.text(element.Anexo.nome_arquivo)
					.attr('id', element.Anexo.id)
					jQuery('.exibe-anexos').append(anexo);
				});
			}
			);
	},
	excluirAnexo: function(element){
		if(!confirm('Deseja excluir o anexo '+element.text+'?'))
			return false;

		jQuery('input:file+div.carregando').toggle();

		jQuery.post(
			cakebase+'/admin/anexos/remove/'+element.id,
			function (resposta){
				Email.listaAnexos();
				jQuery('input:file+div.carregando').toggle()
			}
			);
	}
}

function showBrowserNotifications(icon, title, body){

	if (Notification.permission === 'default'){
		Notification.requestPermission(function(){});
	}

	var options = {
		icon: icon,
		body: body,
		tag: Math.floor(Math.random() * 1000000 + 1)
	}

	var notification = new Notification(title, options);

	setTimeout(notification.close.bind(notification), 4000);
}

// Boooooom


$(document).ready(function () {


	// Add body-small class if window less than 768px
	if ($(this).width() < 769) {
		$('body').addClass('body-small')
	} else {
		$('body').removeClass('body-small')
	}

	// MetsiMenu
	$('#side-menu').metisMenu();

	// Close menu in canvas mode
	// $('.close-canvas-menu').click(function () {
	// 	$("body").toggleClass("mini-navbar");
	// 	SmoothlyMenu();
	// });

	// Run menu of canvas
	$('body.canvas-menu .sidebar-collapse').slimScroll({
		height: '100%',
		railOpacity: 0.9
	});

	// Minimalize menu
	// $('.navbar-minimalize').click(function() {
	// 	$("body").toggleClass('mini-navbar');
	// 	$(".navbar-minimalize").toggleClass("navbar-minimalized");
	// 	SmoothlyMenu();

	// });

	// Full height of sidebar
	function fix_height() {
		var heightWithoutNavbar = $("body > #wrapper").height() - 61;
		$(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");

		var windowHeight = $(document).height();
		$('.min-height').css("min-height", $(window).height() - 230 + "px");
		$('.historico').css("height", $(window).height() - 490 + "px");

		var navbarHeigh = $('nav.navbar-default').height();
		var wrapperHeigh = $('#page-wrapper').height();

		if (navbarHeigh > wrapperHeigh) {
			$('#page-wrapper').css("min-height", navbarHeigh + "px");
		}

		if (navbarHeigh < wrapperHeigh) {
			$('#page-wrapper').css("min-height", $(window).height() + "px");
		}

		if ($('body').hasClass('fixed-nav')) {
			if (navbarHeigh > wrapperHeigh) {
				$('#page-wrapper').css("min-height", navbarHeigh - 60 + "px");
			} else {
				$('#page-wrapper').css("min-height", $(window).height() - 60 + "px");
			}
		}

	}

	fix_height();

	// Fixed Sidebar
	$(window).bind("load", function () {
		if ($("body").hasClass('fixed-sidebar')) {
			$('.sidebar-collapse').slimScroll({
				height: '100%',
				railOpacity: 0.9
			});
		}
	});

	$(window).bind("load resize scroll", function () {
		if (!$("body").hasClass('body-small')) {
			fix_height();
		}
	});

	// Add slimscroll to element
	$('.full-height-scroll').slimscroll({
		height: '100%'
	})
});


// Minimalize menu when screen is less than 768px
$(window).bind("resize", function () {
	if ($(this).width() < 769) {
		$('body').addClass('body-small')
	} else {
		$('body').removeClass('body-small')
	}
});

// For demo purpose - animation css script
function animationHover(element, animation) {
	element = $(element);
	element.hover(
		function () {
			element.addClass('animated ' + animation);
		},
		function () {
		//wait for animation to finish before removing classes
		window.setTimeout(function () {
			element.removeClass('animated ' + animation);
		}, 2000);
	});
}

function SmoothlyMenu() {
	if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
		// Hide menu in order to smoothly turn on when maximize menu
		$('#side-menu').hide();
		// For smoothly turn on menu
		setTimeout(
			function () {
				$('#side-menu').fadeIn(400);
			}, 200);
	} else if ($('body').hasClass('fixed-sidebar')) {
		$('#side-menu').hide();
		setTimeout(
			function () {
				$('#side-menu').fadeIn(400);
			}, 100);
	} else {
		// Remove all inline style from jquery fadeIn function to reset menu state
		$('#side-menu').removeAttr('style');
	}
}

function altera_status_usuario_ativo_inativo(usuario_id){
	$.post(
		cakebase+'admin/usuarios/altera_status_usuario_ativo_inativo/'+usuario_id,
		function(data){}
		);
}

function busca_cliente_base_cnl_il(){
	cnpj = $('.cnpj').val();

	if(cnpj == ''){
		alert('Insira um CNPJ');
		return false;
	}

	$.post(
        cakebase+'clientes/busca_cliente_base_cnl_il/', { cnpj: cnpj },
        function(data){
        	var obj = $.parseJSON(data);
        	if(obj.conlicitacao.ClienteCnl != undefined || obj.intituto.ClienteIl != undefined){
	        	if(obj.conlicitacao.ClienteCnl != undefined){
		        	$('.razao_social').val(obj.conlicitacao.ClienteCnl.razao_social);
		        	$('.nome_fantasia').val(obj.conlicitacao.ClienteCnl.nome_fantasia);
		        	$('.site').val(obj.conlicitacao.ClienteCnl.website);
		        	$('.controle_cnl').val(obj.conlicitacao.ClienteCnl.id);
		        		if(obj.instituto.ClienteIl != undefined)
		        			$('.controle_il').val(obj.instituto.ClienteIl.id);
		        	$('.email').val(obj.conlicitacao.ClienteCnl.email);
		        	$('.logradouro').val(obj.conlicitacao.ClienteCnl.endereco);
		        	$('.numero').val(obj.conlicitacao.ClienteCnl.numero);
		        	$('.complemento').val(obj.conlicitacao.ClienteCnl.complemento);
		        	$('.bairro').val(obj.conlicitacao.ClienteCnl.bairro);
		        	$('.cep').val(obj.conlicitacao.ClienteCnl.cep);
		        	$('.estado').val(obj.conlicitacao.ClienteCnl.estado_id);
		        	buscaCidades(obj.conlicitacao.ClienteCnl.estado_id);
		        	setTimeout(function(){$('.cidade').val(obj.conlicitacao.ClienteCnl.cidade_id)}, 1000);

		        }else{
		        	$('.razao_social').val(obj.instituto.ClienteIl.razao_social);
		        	$('.nome_fantasia').val(obj.instituto.ClienteIl.nome_fantasia);
		        	$('.site').val(obj.instituto.ClienteIl.website);
		        	$('.controle_il').val(obj.instituto.ClienteIl.id);
		        	$('.email').val(obj.instituto.ClienteIl.email);
		        	$('.logradouro').val(obj.instituto.ClienteIl.endereco);
		        	$('.numero').val(obj.instituto.ClienteIl.numero);
		        	$('.complemento').val(obj.instituto.ClienteIl.complemento);
		        	$('.bairro').val(obj.instituto.ClienteIl.bairro);
		        	$('.cep').val(obj.instituto.ClienteIl.cep);
		        	$('.estado').val(obj.instituto.ClienteIl.estado_id);
		        	buscaCidades(obj.instituto.ClienteIl.estado_id);
		        	setTimeout(function(){$('.cidade').val(obj.instituto.ClienteIl.cidade_id)}, 1000);
		        }
        	}else{
        		$('.razao_social, .nome_fantasia, .site').val('');
        	}
        }
    );
}

function desativa_contato_cliente(contato_id){
	$.post(
		cakebase+'clientes/desativa_contato_cliente/'+contato_id,
		function(data){
			window.location.reload();
		}
	);
}

function desativa_email_cliente(email_cliente_id){
	$.post(
		cakebase+'clientes/desativa_email_cliente/'+email_cliente_id,
		function(data){
			window.location.reload();
		}
	);
}

function desativa_telefone_cliente(telefone_cliente_id){
	$.post(
		cakebase+'clientes/desativa_telefone_cliente/'+telefone_cliente_id,
		function(data){
			window.location.reload();
		}
	);
}

function desativa_endereco_cliente(endereco_cliente_id){
	$.post(
		cakebase+'clientes/desativa_endereco_cliente/'+endereco_cliente_id,
		function(data){
			window.location.reload();
		}
	);
}

function finalizar_agendamento(agendamento_id){

	if(!confirm('Deseja finalizar este agendamento?'))
		return false;

	$.post(
		cakebase+'atendimento_agendamentos/finalizar_agendamento/'+agendamento_id,
		function(resposta){
			window.location.reload();
		}
	);
}

function buscaCidades(estado){
	$.post(
		cakebase+'cidades/busca/'+estado,
		function (resposta){
			$(".cidade option").remove();
			$.each(resposta, function(key,val){
				$('.cidade').append('<option value="'+ key +'">'+ val +'</option>')
			});
		}, 'json'
	);
}