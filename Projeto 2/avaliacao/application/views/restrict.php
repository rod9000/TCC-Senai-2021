<section style="min-height: calc(100vh - 83px)" class="light-bg">
  
  <div class="container">
    <div class="row">
      <div class="col-lg-offset-3 col-lg-6 text-center">
        <div class="section-title">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-offset-5 col-lg-3 text-center">
        <div class="form-group">
          <a id="btn_your_user" class="btn btn-link" user_id="<?=$user_id?>"><i class="fa fa-user"> Usuário</i></a>
          <a class="btn btn-link" href="restrict/logoff"><i class="fa fa-sign-out"> Sair</i></a>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
  <!-- Abas de Navegação -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_viagens" role="tab" data-toggle="tab">Viagens</a></li>
      <li><a href="#tab_despesas" role="tab" data-toggle="tab">Despesas</a></li>
      <li><a href="#tab_relatorio" role="tab" data-toggle="tab">Relatório</a></li>
      <li><a href="#tab_user" role="tab" data-toggle="tab">Usuários</a></li>
    </ul>
    <!-- Tabelas de dados -->
    <div class="tab-content">
      <div id="tab_viagens" class="tab-pane active">
         <div class="container-fluid">
          <h2 class="text-center"><strong>Gerenciar Viagens</strong></h2>
          <a id="btn_add_viagens" class="btn btn-primary"><i class="fa fa-plus">&nbsp;&nbsp;Adicionar viagens</i></a>
          <table id="dt_viagens" class="table table-striped table-bordered">
            <thead>
              <tr class="tableheader">
                <th class="dt-center">Local</th>
                <th type="date" class="dt-center">Data</th>
                <th class="dt-center">Serviço</th>
                <th class="dt-center">Funcionário</th>
                <th class="dt-center">Valor para despesas</th>
                <th class="dt-center no-sort">Ações</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
         </div>
      </div>

      <div id="tab_despesas" class="tab-pane">
        <div class="container-fluid">
          <h2 class="text-center"><strong>Gerenciar despesas</strong></h2>
          <a id="btn_add_despesas" class="btn btn-primary"><i class="fa fa-plus">&nbsp;&nbsp;Adicionar despesas</i></a>
          <table id="dt_despesas" class="table table-striped table-bordered">
            <thead>
              <tr class="tableheader">
                <th class="dt-center">Serviço</th>
                <th class="dt-center no-sort">Valor</th>
                <th class="no-sort">Local</th>
                <th type="date" class="dt-center">Data</th>
                <th class="dt-center">Forma de pagamento</th>
                <th type="date" class="dt-center">Viagem</th>
                <th class="dt-center no-sort">Ações</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
         </div>
      </div>

      <div id="tab_relatorio" class="tab-pane">
        <div class="container-fluid">
          <h2 class="text-center"><strong>Gerenciar relatório</strong></h2>
          <a id="btn_add_relatorio" class="btn btn-primary"><i class="fa fa-plus">&nbsp;&nbsp;Gerar relatório</i></a>
          <table id="dt_relatorio" class="table table-striped table-bordered">
            <thead>
              <tr class="tableheader">
                <th class="dt-center">Nome do usuário</th>
                <th class="dt-center no-sort">Viagem</th>
                <th class="dt-center">Total de dias</th>
                <th class="dt-center">Despesas</th>
                <th class="dt-center no-sort">Ações</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
         </div>
      </div>
      <div id="tab_user" class="tab-pane">
        <div class="container-fluid">
          <h2 class="text-center"><strong>Gerenciar Usuários</strong></h2>
          <a id="btn_add_user" class="btn btn-primary"><i class="fa fa-plus">&nbsp;&nbsp;Adicionar Usuário</i></a>
          <table id="dt_users" class="table table-striped table-bordered">
            <thead>
              <tr class="tableheader">
                <th>Login</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th class="dt-center no-sort">Ações</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
         </div>
      </div>
    </div>
  </div>
</section>
<!-- Forms e modais -->
<div id="modal_viagens" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h4 class="modal-title">viagens</h4>
      </div>

      <div class="modal-body">
        <form id="form_viagens">

          <input id="viagens_id" name="viagens_id" hidden>

          <div class="form-group">
            <label class="col-lg-2 control-label">Local</label>
            <div class="col-lg-10">
              <input id="cl_local" name="cl_local" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Data</label>
            <div class="col-lg-10">
            <input type="date" id="pd_data" name="pd_data" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Serviço</label>
            <div class="col-lg-10">
              <input type="text" step="0.1" id="cl_servico" name="cl_servico" class="form-control">
              <span class="help-block"></span>
            </div>
          </div>

          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Funcionário</label>
            <div class="col-lg-10">
              <input type="text" step="0.1" id="cl_funcionario" name="cl_funcionario" class="form-control">
              <span class="help-block"></span>
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-2 control-label">Valor para despesas</label>
            <div class="col-lg-10">
            <input id="pd_valor" name="pd_valor" class="form-control" maxlength="100">
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
  </div>
</div>

<div id="modal_despesas" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h4 class="modal-title">despesas</h4>
      </div>

      <div class="modal-body">
        <form id="form_despesas">

          <input id="despesas_id" name="despesas_id" hidden>

          <div class="form-group">
            <label class="col-lg-2 control-label">Serviço</label>
            <div class="col-lg-10">
              <input id="pd_servico" name="pd_servico" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-2 control-label">Valor</label>
            <div class="col-lg-10">
              <input id="pd_valor" name="pd_valor" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Local</label>
            <div class="col-lg-10">
              <textarea id="pd_local" name="pd_local" class="form-control"></textarea>
              <span class="help-block"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-2 control-label">Data da Viagem</label>
            <div class="col-lg-10">
              <input type="date" id="pd_datadaviagem" name="pd_datadaviagem" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-2 control-label">Forma de Pagemnto</label>
            <div class="col-lg-10">
              <input id="pd_formadepamento" name="pd_formadepamento" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>

          
          <div class="form-group">
            <label class="col-lg-2 control-label">Viagem</label>
            <div class="col-lg-10">
              <textarea id="pd_viagem" name="pd_viagem" class="form-control"></textarea>
              <span class="help-block"></span>
            </div>

          <div class="form-group text-center">
            <button type="submit" id="btn_save_despesas" class="btn btn-primary">
              <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
            </button>
            <span class="help-block"></span>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<div id="modal_relatorio" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h4 class="modal-title">relatorio</h4>
      </div>

      <div class="modal-body">
        <form id="form_relatorio">

          <input id="relatorio_id" name="relatorio_id" hidden>

          <div class="form-group">
            <label class="col-lg-2 control-label">Nome do usuário</label>
            <div class="col-lg-10">
              <input id="pdd_nome" name="pdd_nome" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Viagem</label>
            <div class="col-lg-10">
              <textarea id="pd_viagem" name="pd_viagem" class="form-control"></textarea>
              <span class="help-block"></span>
            </div>

            <div class="form-group">
            <label class="col-lg-2 control-label">Total</label>
            <div class="col-lg-10">
              <input id="pdd_total" name="pdd_total" class="form-control" vaule=""maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>
 
          <div class="form-group">
            <label class="col-lg-2 control-label">Despesas</label>
            <div class="col-lg-10">
              <input id="pdd_despesas" name="pdd_despesas" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>
          
          <div class="form-group text-center">
            <button type="submit" id="btn_save_relatorio" class="btn btn-primary">
              <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
            </button>
            <span class="help-block"></span>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<div id="modal_user" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h4 class="modal-title">Usuário</h4>
      </div>

      <div class="modal-body">
        <form id="form_user">

          <input id="user_id" name="user_id" hidden>

          <div class="form-group">
            <label class="col-lg-2 control-label">Login</label>
            <div class="col-lg-10">
              <input id="user_login" name="user_login" class="form-control" maxlength="30">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Nome Completo</label>
            <div class="col-lg-10">
              <input id="user_full_name" name="user_full_name" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">E-mail</label>
            <div class="col-lg-10">
              <input id="user_email" name="user_email" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Confirmar E-mail</label>
            <div class="col-lg-10">
              <input id="user_email_confirm" name="user_email_confirm" class="form-control" maxlength="100">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Senha</label>
            <div class="col-lg-10">
              <input type="password" id="user_password" name="user_password" class="form-control">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Confirmar Senha</label>
            <div class="col-lg-10">
              <input type="password" id="user_password_confirm" name="user_password_confirm" class="form-control">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group text-center">
            <button type="submit" id="btn_save_user" class="btn btn-primary">
              <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
            <span class="help-block"></span>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>