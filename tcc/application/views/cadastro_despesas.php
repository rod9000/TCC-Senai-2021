<form id="form_despesas">

          <input id="id_despesas" name="id_despesas" hidden>

          <div class="form-group">
            <label class="col-lg-2 control-label">Serviço</label>
            <div class="col-lg-10">
              <input id="dp_servico" name="dp_servico" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Valor</label>
            <div class="col-lg-10">
              <input id="dp_valor" name="dp_valor" class="form-control" maxlength="100" value="<?php if(isset($editar->valor)): echo $editar->valor; endif; ?>">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Local</label>
            <div class="col-lg-10">
              <input id="dp_local" name="dp_local" class="form-control"></input>
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Data da Viagem</label>
            <div class="col-lg-10">
              <input type="date" id="dp_data" name="dp_data" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Viagem</label>
            <div class="col-lg-10">
              <select id="dp_viagem" name="dp_viagem" class="selectpicker show-tick form-control" data-live-search="true" >
                <option value="">Selecione...</option>
                <?php foreach ($viagens as $key => $value) : ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php endforeach; ?>
              </select>
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
        <label class="col-lg-2 control-label">Funcionário</label>
        <div class="col-lg-10">
          <select id="dp_funcionario" name="dp_funcionario" class="selectpicker show-tick form-control" data-live-search="true" >
                <option value="">Selecione...</option>
                <?php foreach ($funcionario2 as $key => $value) : ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php endforeach; ?>
              </select>
          <span class="help-block"></span>
        </div>
      </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Forma de Pagamento</label>
            <div class="col-lg-10">
              <input id="dp_formDePgm" name="dp_formDePgm" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group text-center">
            <button type="submit" id="btn_save_despesas" class="btn btn-primary">
              <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
            </button>
            <span class="help-block"></span>
          </div>

        </form>