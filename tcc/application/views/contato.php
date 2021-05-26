<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Formulário de contato</title>
	<link rel="stylesheet" href="css/bulma.min.css">
</head>
<style>
.center {
  margin: auto;
  width: 55%;
  text-align: center;
  padding: 50px;
}
</style>
<body>
	<section style="min-height: calc(100vh - 83px)" class="light-bg">
		<div class="container">
			<div class="center">
				<div class="column is-half">
					<h1>Entre em contato:</h1>
					<div >
					<form action="enviar.php" method="POST">
						<div class="field">
							<label class="control-label" >Nome</label>
							<div >
								<input style="width: 100%;border: 2;"name="nome" class="form-control" type="text" placeholder="Seu nome" >
							</div>
						</div>
 
						<div class="field">
							<label class="control-label">Email *</label>
							<div  >
								<input style="width: 100%;border: 2;" class="form-control" name="email" type="email" placeholder="Seu email">
							</div>
						</div>
 
						<div class="field">
							<label class="control-label">Assunto</label>
							<div class="control">
								<div class="select is-fullwidth">
									<select name="assunto" class="form-control">
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
							<div>
								<textarea class="form-control" style="width: 100%;border: 2;" name="mensagem"  placeholder="Deixe sua mensagem" maxlength="2000" class="form-control"></textarea>
							</div>
						</div>
						</br>
						<div class="field is-grouped">
							<div class="control">
								<button class="btn btn-block">Enviar</button>
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
