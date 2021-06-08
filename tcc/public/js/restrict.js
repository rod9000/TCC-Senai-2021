
$(document).ready(function() {

	// EXIBIR MODAIS
	$("#btn_add_viagens").on('click', function(){
		clearErrors();
		$("#form_viagens")[0].reset();
		$("#modal_viagens").modal();
	});
	$("#btn_add_despesas").click(function(){
		clearErrors();
		$("#form_despesas")[0].reset();
		$("#modal_despesas").modal();
	});
	$("#btn_add_user").click(function(){
		clearErrors();
		$("#form_user")[0].reset();
		$("#modal_user").modal();
	});	
	
	$("#form_despesas").submit(function () //Js para salvar os dados do form da despesas
	{

		$.ajax({
			type: "POST",
			url: BASE_URL + "restrict/ajax_save_despesas",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function () {
				clearErrors();
				$("#btn_save_despesas").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function (response) {
				clearErrors();
				if (response["status"]) {
					// $("#modal_despesas").modal("hide");
					swal("Sucesso!", "Despesas salva com sucesso!", "success");
					dt_clientes.ajax.reload();
				} else {
					showErrorsModal(response["error_list"])
				}
			}
		})

		return false;
	});
	$("#form_viagens").submit(function () //Js para salvar os dados do form da viagem
	{

		$.ajax({
			type: "POST",
			url: BASE_URL + "restrict/ajax_save_viagens",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function () {
				clearErrors();
				$("#btn_save_viagens").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function (response) {
				clearErrors();
				if (response["status"]) {
					// $("#modal_viagens").modal("hide");
					swal("Sucesso!", "Viagem salva com sucesso!", "success");
					dt_viagens.ajax.reload();
				} else {
					showErrorsModal(response["error_list"])
				}
			}
		})

		return false;
	});
	$("#form_servicos").submit(function () //Js para salvar os dados do form dos servicos
	{

		$.ajax({
			type: "POST",
			url: BASE_URL + "restrict/ajax_save_servicos",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function () {
				clearErrors();
				$("#btn_save_servico").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function (response) {
				clearErrors();
				if (response["status"]) {
					// $("#modal_viagens").modal("hide");
					swal("Sucesso!", "Serviço salvo com sucesso!", "success");
					dt_servicos.ajax.reload();
				} else {
					showErrorsModal(response["error_list"])
				}
			}
		})

		return false;
	});
	$("#form_user").submit(function () //Js para salvar os dados do form do usuário
	{

		$.ajax({
			type: "POST",
			url: BASE_URL + "restrict/ajax_save_user",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function () {
				clearErrors();
				$("#btn_save_user").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function (response) {
				clearErrors();
				if (response["status"]) {
					swal("Sucesso!", "Usuário salvo com sucesso!", "success");
					dt_user.ajax.reload();
				} else {
					showErrorsModal(response["error_list"])
				}
			}
		})

		return false;
	});
	$("#btn_your_user").click(function() //Js para obter dados dos usuarios e colocar no form do usuário logado
	{

		$.ajax({
			type: "POST",
			url: BASE_URL + "restrict/ajax_get_user_data",
			dataType: "json",
			data: {"user_id": $(this).attr("user_id")},
			success: function(response) {
				clearErrors();
				$("#form_user")[0].reset();
				$.each(response["input"], function(id, value) {
					$("#"+id).val(value);
				});
			}
		})

		return false;
	});
	var dt_despesas = $("#dt_despesas").DataTable({ //Js de organização do data table das despesas
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "restrict/ajax_list_despesas",
			"type": "POST",
		},
		"columnDefs": [
			{ targets: "no-sort", orderable: false },
			{ targets: "dt-center", className: "dt-center" },
		],
		"drawCallback": function() {
			active_btn_despesas();
		}
	});
	function active_btn_despesas() { //Js do botão edita e exlui da data table
		
		// $(".btn-edit-dps").click(function(){
		// 	$.ajax({
		// 		type: "POST",
		// 		url: BASE_URL + "restrict/ajax_get_despesas_data",
		// 		dataType: "json",
		// 		data: {"id_despesas": $(this).attr("id_despesas")},
		// 		success: function(response) {
		// 			clearErrors();
		// 			$("#form_despesas")[0].reset();
		// 			$.each(response["input"], function(id, value) {
		// 				$("#"+id).val(value);
		// 			});
		// 			$("#modal_despesas").modal();
		// 		}
		// 	})
		// });

		$(".btn-del-dps").click(function(){
			
			id_despesas	 = $(this);
			swal({
				title: "Atenção!",
				text: "Deseja deletar essa despesas?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#d9534f",
				confirmButtonText: "Sim",
				cancelButtontext: "Não",
				closeOnConfirm: true,
				closeOnCancel: true,
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: BASE_URL + "restrict/ajax_delete_despesas_data",
						dataType: "json",
						data: {"id_despesas": id_despesas.attr("id_despesas")},
						success: function(response) {
							swal("Sucesso!", "Ação executada com sucesso", "success");
							dt_despesas.ajax.reload();
						}
					})
				}
			})

		});
	}

	var dt_viagens = $("#dt_viagens").DataTable({ //Js de organização do data table das viagens
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "restrict/ajax_list_viagens",
			"type": "POST",
		},
		"columnDefs": [
			{ targets: "no-sort", orderable: false },
			{ targets: "dt-center", className: "dt-center" },
		],
		"drawCallback": function() {
			active_btn_viag();
		}

	});
	function active_btn_viag() { //Js do botão edita e exlui da data table
		$(".btn-del-viag").click(function(){
			
			id_viagens = $(this);
			swal({
				title: "Atenção!",
				text: "Deseja deletar essa viagem?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#d9534f",
				confirmButtonText: "Sim",
				cancelButtontext: "Não",
				closeOnConfirm: true,
				closeOnCancel: true,
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: BASE_URL + "restrict/ajax_delete_viagens_data",
						dataType: "json",
						data: {"id_viagens": id_viagens.attr("id_viagens")},
						success: function(response) {
							swal("Sucesso!", "Ação executada com sucesso", "success");
							dt_viagens.ajax.reload();
						}
					})
				}
			})
	
		});
	}
	var dt_relatorio = $("#dt_relatorio").DataTable({ //Js de organização do data table dos usuários
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "restrict/ajax_list_relatorio",
			"type": "POST",
		},
		"columnDefs": [
			{ targets: "no-sort", orderable: false },
			{ targets: "dt-center", className: "dt-center" },
		],
		"drawCallback": function() {
			active_btn_user();
		},
		"dom": 'Bfrtip',
		"buttons": [
			{
				extend: 'collection',
				text: 'Gerar Relatório',
				buttons: [
					'excel',
					'csv',
					'pdf',
					'print'
				]
			}
		],
	});
	var dt_user = $("#dt_users").DataTable({ //Js de organização do data table dos usuários
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "restrict/ajax_list_user",
			"type": "POST",
		},
		"columnDefs": [
			{ targets: "no-sort", orderable: false },
			{ targets: "dt-center", className: "dt-center" },
		],
		"drawCallback": function() {
			active_btn_user();
		}
	});
	function active_btn_user() { //Js do botão edita e exlui da data table
		
		// $(".btn-edit-user").click(function(){
		// 	$.ajax({
		// 		type: "POST",
		// 		url: BASE_URL + "restrict/ajax_get_user_data",
		// 		dataType: "json",
		// 		data: {"user_id": $(this).attr("user_id")},
		// 		success: function(response) {
		// 			clearErrors();
		// 			$("#form_user")[0].reset();
		// 			$.each(response["input"], function(id, value) {
		// 				$("#"+id).val(value);
		// 			});
		// 			$("#modal_user").modal();
		// 		}
		// 	})
		// });

		$(".btn-del-user").click(function(){
			
			user_id = $(this);
			swal({
				title: "Atenção!",
				text: "Deseja deletar esse usuário?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#d9534f",
				confirmButtonText: "Sim",
				cancelButtontext: "Não",
				closeOnConfirm: true,
				closeOnCancel: true,
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: BASE_URL + "restrict/ajax_delete_user_data",
						dataType: "json",
						data: {"user_id": user_id.attr("user_id")},
						success: function(response) {
							swal("Sucesso!", "Ação executada com sucesso", "success");
							dt_user.ajax.reload();
						}
					})
				}
			})

		});
	}
	var dt_servicos = $("#dt_servicos").DataTable({ //Js de organização do data table das despesas
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "restrict/ajax_list_servicos",
			"type": "POST",
		},
		"columnDefs": [
			{ targets: "no-sort", orderable: false },
			{ targets: "dt-center", className: "dt-center" },
		],
		"drawCallback": function() {
			active_btn_despesas();
		}
	});
	function active_btn_servicos() { //Js do botão edita e exlui da data table
		
		// $(".btn-edit-dps").click(function(){
		// 	$.ajax({
		// 		type: "POST",
		// 		url: BASE_URL + "restrict/ajax_get_despesas_data",
		// 		dataType: "json",
		// 		data: {"id_despesas": $(this).attr("id_despesas")},
		// 		success: function(response) {
		// 			clearErrors();
		// 			$("#form_despesas")[0].reset();
		// 			$.each(response["input"], function(id, value) {
		// 				$("#"+id).val(value);
		// 			});
		// 			$("#modal_despesas").modal();
		// 		}
		// 	})
		// });

		$(".btn-del-sv").click(function(){
			
			id_despesas	 = $(this);
			swal({
				title: "Atenção!",
				text: "Deseja deletar essa Serviço?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#d9534f",
				confirmButtonText: "Sim",
				cancelButtontext: "Não",
				closeOnConfirm: true,
				closeOnCancel: true,
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: BASE_URL + "restrict/ajax_delete_servicos_data",
						dataType: "json",
						data: {"id_servicos": id_servicos.attr("id_servicos")},
						success: function(response) {
							swal("Sucesso!", "Ação executada com sucesso", "success");
							dt_servicos.ajax.reload();
						}
					})
				}
			})

		});
	}
	
});

var submitButton = document.getElementById("submit_form");
var form = document.getElementById("email_form");
form.addEventListener("submit", function(e) {
	setTimeout(function() {
		submitButton.value = "Enviando...";
		submitButton.disabled = true;
	}, 1);
});