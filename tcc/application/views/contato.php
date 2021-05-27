<body>
	<section style="min-height: calc(100vh - 83px)" class="light-bg">
		<div class="container">
			<div class="center">
				<div class="column is-half">
					<h1>Entre em contato</h1>
					<div>
						<form action="https://postmail.invotes.com/send" 
						method="POST" id="email_form">

							<input type="hidden" name="access_token" value="wynrz1tt3s16exo8n8wvcsba"/>
							<input type="hidden" name="success_url" value="<?php echo base_url(); ?>home" />
							<input type="hidden" name="error_url" value="<?php echo base_url(); ?>home" />
							<div class="field">
								<label class="control-label">Nome</label>
								<div>
									<input style="width: 100%;border: 2;" name="extra_nome" class="form-control" type="text" placeholder="Seu nome">
								</div>
							</div>

							<div class="field">
								<label class="control-label">Email *</label>
								<div>
									<input style="width: 100%;border: 2;" class="form-control" name="extra_email" type="email" placeholder="Seu email">
								</div>
							</div>

							<div class="field">
								<label class="control-label">Assunto</label>
								<div class="control">
									<div class="select is-fullwidth">
										<select name="subject" class="form-control">
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
									<textarea class="form-control" style="width: 100%;border: 2;" name="text" placeholder="Deixe sua mensagem" ></textarea>
								</div>
							</div>
							</br>
							<div class="field is-grouped">
								<div class="control">
									<input id="submit_form" type="submit" value="Send" />
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
