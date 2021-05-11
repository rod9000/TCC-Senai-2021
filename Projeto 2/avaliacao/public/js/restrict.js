$(function() {

	// EXIBIR MODAIS
	$("#btn_add_viagens").click(function(){
		clearErrors();
		$("#form_viagens")[0].reset();
		$("#modal_viagens").modal();
	});

	$("#btn_add_despesas").click(function(){
		clearErrors();
		$("#form_despesas")[0].reset();
		$("#modal_despesas").modal();
	});

	$("#btn_add_relatorio").click(function(){
		clearErrors();
		$("#form_relatorio")[0].reset();
		$("#modal_relatorio").modal();
	});

	$("#btn_add_user").click(function(){
		clearErrors();
		$("#form_user")[0].reset();
		$("#modal_user").modal();
	});
	
})