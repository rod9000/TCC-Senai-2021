<section style="min-height: calc(100vh - 83px)" class="light-bg">
  <div class="container">
    <div class=>
      <form id="form_despesas">

        <input id="id_despesas" name="id_despesas" hidden value="<?php if (isset($editar[0]->id_despesas)) : echo $editar[0]->id_despesas;
                                                                  endif; ?>">
        <?php if ($this->uri->segment(2) == 'cadastroDespesas') : ?>
          <h1 class="center">Cadastro de despesas</h1>
        <?php else : ?>
          <h1 class="center">Editar de despesas</h1>
        <?php endif; ?>
        <div class="form-group">

          <label class="col-lg-2 control-label">Motivo</label>
          <div class="col-lg-10">
            <input id="dp_motivo" name="dp_motivo" class="form-control" maxlength="100" value="<?php if (isset($editar[0]->dp_motivo)) : echo $editar[0]->dp_motivo;
                                                                                                endif; ?>">
            <span class="help-block"></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Valor</label>
          <div class="col-lg-10">
            <input id="dp_valor" name="dp_valor" class="form-control" maxlength="100" value="<?php if (isset($editar[0]->dp_valor)) : echo $editar[0]->dp_valor;
                                                                                              endif; ?>">
            endif; ?>"> -->
            <span class="help-block"></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-2 control-label">Local</label>
          <div class="col-lg-10">
            <input id="dp_local" name="dp_local" class="form-control" value="<?php if (isset($editar[0]->dp_local)) : echo $editar[0]->dp_local;
                                                                              endif; ?>">
            <span class="help-block"></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-2 control-label">Data da Despesa</label>
          <div class="col-lg-10">
            <input type="date" id="dp_data" name="dp_data" class="form-control" maxlength="100" value="<?php if (isset($editar[0]->dp_data)) : echo $editar[0]->dp_data;
                                                                                                        endif; ?>">
            <span class="help-block"></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-2 control-label">Viagem</label>
          <div class="col-lg-10">
            <?php echo form_dropdown('dp_viagem', $viagens, (isset($editar[0]->dp_viagem)) ? explode(',', $editar[0]->dp_viagem) : null,  'id="dp_viagem" class="selectpicker" data-parsley-required data-live-search="true" title="Selecione..."') ?>
            <span class="help-block"></span>
          </div>
        </div>
        <?php if ($user_tipo->user_tipo != 3) : ?>
          <div class="form-group">
            <label class="col-lg-2 control-label">Funcionário</label>
            <div class="col-lg-10">
              <?php echo form_dropdown('dp_funcionario', $funcionario, (isset($editar[0]->dp_funcionario)) ? explode(',', $editar[0]->dp_funcionario) : null,  'id="dp_funcionario" class="selectpicker" data-parsley-required data-live-search="true" title="Selecione..."') ?>
              <span class="help-block"></span>
            </div>
          </div>
        <?php else : ?>
          <input type="hidden" id="dp_funcionario" name="dp_funcionario" class="form-control" value="<?php if (isset($editar[0]->dp_funcionario)) : echo $editar[0]->dp_funcionario;
                                                                                                      else : echo $user_id;
                                                                                                      endif; ?>">
        <?php endif; ?>
        <div class="form-group">
          <label class="col-lg-2 control-label">Forma de Pagamento</label>
          <div class="col-lg-10">
            <?php echo form_dropdown('dp_formDePgm', $pagamento, (isset($editar[0]->dp_formDePgm)) ? explode(',', $editar[0]->dp_formDePgm) : null,  'id="dp_formDePgm" class="selectpicker" data-parsley-required data-live-search="true" title="Selecione..."') ?>
            <span class="help-block"></span>
          </div>
        </div>

        <div class="form-group text-center">
          <button type="submit" id="btn_save_despesas" class="btn btn-primary">
            <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar </button>
          <span class="help-block"></span>
        </div>


      </form>

    </div>
  </div>
</section>