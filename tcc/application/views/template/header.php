<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="favicon.ico">
		<title>Sistema</title>
		<!--selectpicker-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
		<!-- dt -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.jqueryui.min.css">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.jqueryui.min.css">
		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Custom styles for this template -->
     	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
		<link href="<?php echo base_url(); ?>public/css/owl.carousel.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>public/css/owl.theme.default.min.css"  rel="stylesheet">
		<link href="<?php echo base_url(); ?>public/css/style.css" rel="stylesheet">
		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="<?php echo base_url(); ?>public/js/ie-emulation-modes-warning.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<?php if (isset($styles)) {
			foreach ($styles as $style_name) {
				$href = base_url() . "public/css/" . $style_name; ?>
				<link href="<?=$href?>" rel="stylesheet">
			<?php }
		} ?>
		
	</head>
	<body id="page-top">
		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-shrink navbar-fixed-top">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand page-scroll" href="#page-top"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li class="hidden">
							<a href="#page-top"></a>
						</li>
						<li>
							<a class="header-button" href="<?php echo base_url(); ?>home">Home</a>
						</li>
						<?php if($this->uri->segment(1) == 'cadastro_viagens' || $this->uri->segment(1) == 'cadastro_despesas' || $this->uri->segment(1) == 'cadastro_usuario'): ?>
						<li>
							<a class="header-button" href="<?php echo base_url(); ?>restrict">Relatorios</a>
						</li>
						<?php endif; ?>

						<?php if($this->uri->segment(1) == 'home' || $this->uri->segment(1) == ''): ?>
						<li>
							<a class="header-button" href="<?php echo base_url(); ?>restrict">Login</a>
						</li>
						<li>
							<a class="header-button" href="<?php echo base_url(); ?>restrict/contato">Contato</a>
						</li>
						<?php endif; ?>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>
