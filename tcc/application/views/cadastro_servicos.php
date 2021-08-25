<section style="min-height: calc(100vh - 83px)" class="light-bg">
		<div class="container">
			<div class=>
  
  <div class="form-group">
        <form id="form_servicos">

        <input id="id_servicos" name="id_servicos" hidden value="<?php if(isset($editar[0]->id_servicos)): echo $editar[0]->id_servicos; endif; ?>">
          <?php if($this->uri->segment(2) == 'cadastroDespesas'): ?>
            <h1 class="center">Cadastro de Serviços</h1>
          <?php else: ?>
            <h1 class="center">Editar de Serviços</h1>
          <?php endif;?>
          <div class="form-group">
            <label class="col-lg-2 control-label">Serviço</label>
            <div class="col-lg-10">
              <input id="sv_nome" name="sv_nome" class="form-control" maxlength="100" value="<?php if (isset($editar[0]->sv_nome)) : echo $editar[0]->sv_nome; endif; ?>">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Valor diária do serviço</label>
            <div class="col-lg-10">
              <input id="sv_diaria" name="sv_diaria" class="form-control" maxlength="10" value="<?php if (isset($editar[0]->sv_diaria)) : echo $editar[0]->sv_diaria; endif; ?>">
              <span class="help-block"></span>
            </div>
          </div>
          </br>
          <div class="form-group text-center">
            <button type="submit" id="btn_save_servico" class="btn btn-primary">
              <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar </button>              
              <button onClick="window.history.back();" class="btn btn-danger">
              <i class="fa fa-back"></i>&nbsp;&nbsp;Voltar</button>
              <span class="help-block"></span>
          </div>
</div>
</section>