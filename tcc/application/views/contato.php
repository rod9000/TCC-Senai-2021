<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Formulário de contato</title>
	<link rel="stylesheet" href="css/bulma.min.css">
</head>
<body>
	<section class="section">
		<div class="container">
			<div class="columns is-centered">
				<div class="column is-half">
					<h1 class="title has-text-centered">Entre em contato:</h1>
					<div style="top:29%;width:300px;height:270px;position:relative;border-style: double;">
					<form action="enviar.php" method="POST">
						<div class="field">
							<label class="control-label" >Nome</label>
							<div class="control">
								<input name="nome" class="input" type="text" placeholder="Seu nome">
							</div>
						</div>
 
						<div class="field">
							<label class="control-label">Email *</label>
							<div class="control">
								<input name="email" class="input" type="email" placeholder="Seu email">
							</div>
						</div>
 
						<div class="field">
							<label class="control-label">Assunto</label>
							<div class="control">
								<div class="select is-fullwidth">
									<select name="assunto">
										<option>Selecione</option>
										<option>Reportar erro</option>
										<option>Conhecer serviço</option>
										<option>Outro</option>
									</select>
								</div>
							</div>
						</div>
 
						<div class="field">
							<label class="control-label">Mensagem *</label>
							<div class="control">
								<textarea name="mensagem" class="textarea" placeholder="Deixe sua mensagem" maxlength="2000"></textarea>
							</div>
						</div>
 
						<div class="field is-grouped">
							<div class="control">
								<button class="button is-link is-medium">Enviar</button>
							</div>
						</div>
						</div>
					</form>
 
				</div>
			</div>
		</div>
	</section>
</body>
</html>
