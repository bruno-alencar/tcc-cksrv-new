$(function(){

	$( "a.showmodal, .disabledefaultfunction" ).click(function(event){
		event.preventDefault();
	});

	$('tr[data-href]').click(function(){
		document.location = $(this).data('href');
	});
});

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


$(document).ready(function () {

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

function altera_status_servidor_ativo_inativo(servidor_id){
	$.post(
		cakebase+'admin/servidores/altera_status_servidor_ativo_inativo/'+servidor_id,
		function(data){}
		);
}

function testar_conexao(){
	usuario = $('#usuario').val();
	senha = $('#senha').val();
	ip = $('#ip').val();

	$.post(
		cakebase+'admin/servidores/testar_conexao/'+usuario+'/'+senha+'/'+ip,
			function(data){
				console.log(data);
			}
	);
}

function altera_texto_adicionar_servico(servico_id){
	document.getElementById('mensagem-tipo-servico2').style.display = 'none';
	document.getElementById('mensagem-tipo-servico3').style.display = 'none';
	document.getElementById('mensagem-tipo-servico4').style.display = 'none';
	document.getElementById('mensagem-tipo-servico5').style.display = 'none';
	document.getElementById('mensagem-tipo-servico6').style.display = 'none';
	document.getElementById('particao').style.display = 'none';
	$('#botao-particao').attr("disabled", true);

	document.getElementById('mensagem-tipo-servico'+servico_id).style.display = 'block';
	$('#salvar_servico').attr("disabled", false);

	if (servico_id == 6){
		document.getElementById('particao').style.display = 'block';
		$('#botao-particao').attr("disabled", false);
	}else{
		document.getElementById('particao').style.display = 'none';
		$('#botao-particao').attr("disabled", true);
	}
}