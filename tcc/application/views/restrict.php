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
          <a id="btn_your_user" class="btn btn-link" user_id="<?= $user_id ?>"><i class="fa fa-user"> Usuário</i></a>
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
      <li><a href="#tab_servicos" role="tab" data-toggle="tab">Serviços</a></li>
      <li><a href="#tab_user" role="tab" data-toggle="tab">Usuários</a></li>
    </ul>
    <!-- Tabelas de dados -->
    <div class="tab-content">
      <div id="tab_viagens" class="tab-pane active">
        <div class="container-fluid">
          <h2 class="text-center"><strong>Gerenciar Viagens</strong></h2>
          <a id="btn_add_viagens" class="btn btn-primary" href="<?php echo base_url(); ?>restrict/cadastroViagens"><i class="fa fa-plus">&nbsp;&nbsp;Adicionar viagens</i></a>
          <table id="dt_viagens" class="table table-striped table-bordered">
            <thead>
              <tr class="tableheader">
                <th class="dt-center">ID</th>
                <th class="dt-center">Destino</th>
                <th type="date" class="dt-center">Data Saida</th>
                <th type="date" class="dt-center">Data Retorno</th>
                <th class="dt-center no-sort">Serviço</th>
                <th class="dt-center">Funcionário</th>
                <th class="dt-center no-sort">Valor</th>
                <th class="dt-center">Realizada</th>
                <th class="dt-center no-sort">Motivo</th>
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
          <a id="btn_add_despesas" class="btn btn-primary" href="<?php echo base_url(); ?>restrict/cadastroDespesas"><i class="fa fa-plus">&nbsp;&nbsp;Adicionar despesas</i></a>
          <table id="dt_despesas" class="table table-striped table-bordered">
            <thead>
              <tr class="tableheader">
                <th class="dt-center">ID</th>
                <th class="dt-center">Serviço</th>
                <th class="dt-center no-sort">Valor</th>
                <th class="dt-center">Local</th>
                <th type="date" class="dt-center">Data</th> 
                <th class="dt-center">Viagem</th>
                <th class="dt-center">Funcionário</th>
                <th class="dt-center no-sort">Forma de pagamento</th>
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
<!--          <a id="btn_add_relatorio" stlye ="marring-bottom: 2px" class="btn btn-primary"><i class="fa fa-plus">&nbsp;&nbsp;Gerar relatório</i></a> -->
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
      <div id="tab_servicos" class="tab-pane">
        <div class="container-fluid">
          <h2 class="text-center"><strong>Gerenciar Serviços</strong></h2>
          <a id="btn_add_servicos" class="btn btn-primary" href="<?php echo base_url(); ?>restrict/cadastroServicos"><i class="fa fa-plus">&nbsp;&nbsp;Adicionar Serviços</i></a>
          <table id="dt_servicos" class="table table-striped table-bordered">
            <thead>
              <tr class="tableheader">
                <th class="dt-center">ID</th>
                <th class="dt-center">Servico</th>
                <th class="dt-center no-sort">Diaria</th>
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
          <a id="btn_add_user" class="btn btn-primary" href="<?php echo base_url(); ?>restrict/cadastroUsuario"><i class="fa fa-plus">&nbsp;&nbsp;Adicionar Usuário</i></a>
          <table id="dt_users" class="table table-striped table-bordered">
            <thead>
              <tr class="tableheader">
                <th>Login</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th class="dt-center no-sort">E-mail</th>
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
