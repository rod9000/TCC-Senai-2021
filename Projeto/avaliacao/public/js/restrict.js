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

	$("#btn_add_user").click(function(){
		clearErrors();
		$("#form_user")[0].reset();
		$("#modal_user").modal();
	});
	
	$("#form_clientes").submit(function () //Js para salvar os dados do form do clientes
	{

		$.ajax({
			type: "POST",
			url: BASE_URL + "restrict/ajax_save_clientes",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function () {
				clearErrors();
				$("#btn_save_clientes").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function (response) {
				clearErrors();
				if (response["status"]) {
					$("#modal_clientes").modal("hide");
					swal("Sucesso!", "Cliente salvo com sucesso!", "success");
					dt_clientes.ajax.reload();
				} else {
					showErrorsModal(response["error_list"])
				}
			}
		})

		return false;
	});
	$("#form_produtos").submit(function () //Js para salvar os dados do form do produtos
	{

		$.ajax({
			type: "POST",
			url: BASE_URL + "restrict/ajax_save_produtos",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function () {
				clearErrors();
				$("#btn_save_produtos").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function (response) {
				clearErrors();
				if (response["status"]) {
					$("#modal_produtos").modal("hide");
					swal("Sucesso!", "Produto salvo com sucesso!", "success");
					dt_produtos.ajax.reload();
				} else {
					showErrorsModal(response["error_list"])
				}
			}
		})

		return false;
	});
	$("#form_pedidos").submit(function () //Js para salvar os dados do form do pedidos
	{

		$.ajax({
			type: "POST",
			url: BASE_URL + "restrict/ajax_save_pedidos",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function () {
				clearErrors();
				$("#btn_save_pedidos").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function (response) {
				clearErrors();
				if (response["status"]) {
					$("#modal_pedidos").modal("hide");
					swal("Sucesso!", "Produto salvo com sucesso!", "success");
					dt_pedidos.ajax.reload();
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
					$("#modal_user").modal("hide");
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
				$("#modal_user").modal();
			}
		})

		return false;
	});
	var dt_clientes = $("#dt_clientes").DataTable({ //Js de organização do data table dos clientes
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "restrict/ajax_list_clientes",
			"type": "POST",
		},
		"columnDefs": [
			{ targets: "no-sort", orderable: false },
			{ targets: "dt-center", className: "dt-center" },
		],
		"drawCallback": function() {
			active_btn_clientes();
		}
	});

	function active_btn_clientes() { //Js do botão edita e exlui da data table
		
		$(".btn-edit-clt").click(function(){
			$.ajax({
				type: "POST",
				url: BASE_URL + "restrict/ajax_get_clientes_data",
				dataType: "json",
				data: {"clientes_id": $(this).attr("clientes_id")},
				success: function(response) {
					clearErrors();
					$("#form_clientes")[0].reset();
					$.each(response["input"], function(id, value) {
						$("#"+id).val(value);
					});
					$("#modal_clientes").modal();
				}
			})
		});

		$(".btn-del-clt").click(function(){
			
			clientes_id	 = $(this);
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
						url: BASE_URL + "restrict/ajax_delete_clientes_data",
						dataType: "json",
						data: {"clientes_id": clientes_id.attr("clientes_id")},
						success: function(response) {
							swal("Sucesso!", "Ação executada com sucesso", "success");
							dt_clientes.ajax.reload();
						}
					})
				}
			})

		});
	}
	
	var dt_produtos = $("#dt_produtos").DataTable({ //Js de organização do data table dos produtos
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "restrict/ajax_list_produtos",
			"type": "POST",
		},
		"columnDefs": [
			{ targets: "no-sort", orderable: false },
			{ targets: "dt-center", className: "dt-center" },
		],
		"drawCallback": function() {
			active_btn_prod();
		}
	});
	function active_btn_prod() { //Js do botão edita e exlui da data table
		
		$(".btn-edit-prod").click(function(){
			$.ajax({
				type: "POST",
				url: BASE_URL + "restrict/ajax_get_produtos_data",
				dataType: "json",
				data: {"produtos_id": $(this).attr("produtos_id")},
				success: function(response) {
					clearErrors();
					$("#form_produtos")[0].reset();
					$.each(response["input"], function(id, value) {
						$("#"+id).val(value);
					});
					$("#modal_produtos").modal();
				}
			})
		});

		$(".btn-del-prod").click(function(){
			
			produtos_id = $(this);
			swal({
				title: "Atenção!",
				text: "Deseja deletar esse Produto?",
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
						url: BASE_URL + "restrict/ajax_delete_produtos_data",
						dataType: "json",
						data: {"produtos_id": produtos_id.attr("produtos_id")},
						success: function(response) {
							swal("Sucesso!", "Ação executada com sucesso", "success");
							dt_produtos.ajax.reload();
						}
					})
				}
			})
	
		});
	}

	var dt_pedidos = $("#dt_pedidos").DataTable({ //Js de organização do data table dos pedidos
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "restrict/ajax_list_pedidos",
			"type": "POST",
		},
		"columnDefs": [
			{ targets: "no-sort", orderable: false },
			{ targets: "dt-center", className: "dt-center" },
		],
		"drawCallback": function() {
			active_btn_pedidos();
		}
	});
	function active_btn_pedidos() { //Js do botão edita e exlui da data table
		
		$(".btn-edit-pdd").click(function(){
			$.ajax({
				type: "POST",
				url: BASE_URL + "restrict/ajax_get_pedidos_data",
				dataType: "json",
				data: {"pedidos_id": $(this).attr("pedidos_id")},
				success: function(response) {
					clearErrors();
					$("#form_pedidos")[0].reset();
					$.each(response["input"], function(id, value) {
						$("#"+id).val(value);
					});
					$("#modal_pedidos").modal();
				}
			})
		});

		$(".btn-del-pdd").click(function(){
			
			pedidos_id = $(this);
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
						url: BASE_URL + "restrict/ajax_delete_pedidos_data",
						dataType: "json",
						data: {"pedidos_id": pedidos_id.attr("pedidos_id")},
						success: function(response) {
							swal("Sucesso!", "Ação executada com sucesso", "success");
							dt_pedidos.ajax.reload();
						}
					})
				}
			})

		});
	}

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
		
		$(".btn-edit-user").click(function(){
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
					$("#modal_user").modal();
				}
			})
		});

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
	
})