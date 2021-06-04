<section style="min-height: calc(100vh - 83px)" class="light-bg">
  <div class="container">
    <div class=>

      <div class="form-group">
        <form id="form_viagens">

          <input id="id_viagens" name="id_viagens" hidden value="<?php if (isset($editar[0]->id_viagens)) : echo $editar[0]->id_viagens; endif; ?>">
          <?php if ($this->uri->segment(2) == 'cadastroViagens') : ?>
            <h1 class="center">Cadastro de Viagens</h1>
          <?php else : ?>
            <h1 class="center">Editar de Viagens</h1>
          <?php endif; ?>

          <div class="form-group">
            <label class="col-lg-2 control-label">Destino</label>
            <div class="col-lg-10">
              <input id="vg_destino" name="vg_destino" class="form-control" maxlength="100" value="<?php if (isset($editar[0]->vg_destino)) : echo $editar[0]->vg_destino; endif; ?>">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Data de saida</label>
            <div class="col-lg-10">
              <input type="date" id="vg_dsaida" name="vg_dsaida" class="form-control" maxlength="100" value="<?php if (isset($editar[0]->vg_dsaida)) : echo $editar[0]->vg_dsaida; endif; ?>">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Data de retorno</label>
            <div class="col-lg-10">
              <input type="date" id="vg_dtretorno" name="vg_dretorno" class="form-control" maxlength="100" value="<?php if (isset($editar[0]->vg_dretorno)) : echo $editar[0]->vg_dretorno; endif; ?>">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Serviço</label>
            <div class="col-lg-10">
               <?php echo form_dropdown('vg_servico',$servicos,(isset($editar[0]->vg_servico)) ? explode(',',$editar[0]->vg_servico) : null,  'id="vg_servico" class="selectpicker" data-parsley-required data-live-search="true" title="Selecione..."') ?>
              <span class="help-block"></span>
            </div>
          </div>
      <div class="form-group">
        <label class="col-lg-2 control-label">Funcionário</label>
        <div class="col-lg-10">
          <?php echo form_dropdown('vg_funcionario',$funcionario,(isset($editar[0]->vg_funcionario)) ? explode(',',$editar[0]->vg_funcionario) : null,  'id="vg_funcionario" class="selectpicker" data-parsley-required data-live-search="true" title="Selecione..."') ?>
          <span class="help-block"></span>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Valor inicial</label>
        <div class="col-lg-10">
          <input id="vg_valorIn" name="vg_valorIn" class="form-control" maxlength="100" value="<?php if (isset($editar[0]->vg_valorIn)) : echo $editar[0]->vg_valorIn; endif; ?>">
          <span class="help-block"></span>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Realizada</label>
        <div class="col-lg-10">
            <?php echo form_dropdown('vg_realizada',$realizada,(isset($editar[0]->vg_realizada)) ? explode(',',$editar[0]->vg_realizada) : null,  'id="vg_realizada" class="selectpicker" data-parsley-required title="Selecione..."') ?>
            <span class="help-block"></span>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label">Motivo da Viagens</label>
        <div class="col-lg-10">
            <input id="vg_motivo" name="vg_motivo" class="form-control" maxlength="100" value="<?php if (isset($editar[0]->vg_motivo)) : echo $editar[0]->vg_motivo; endif; ?>">
            <span class="help-block"></span>
        </div>
      </div>

      <div class="form-group text-center">
        <button type="submit" id="btn_save_viagens" class="btn btn-primary">
          <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
        </button>
        <span class="help-block"></span>
      </div>

      </form>
    </div>
  </div>
</section>