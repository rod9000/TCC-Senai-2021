<section style="min-height: calc(100vh - 83px)" class="light-bg">
  <div class="container">
    <div class=>

      <form id="form_user">

        <input id="user_id" name="user_id" hidden value="<?php if (isset($editar[0]->user_id)) : echo $editar[0]->user_id; endif; ?>">
        <?php if ($this->uri->segment(2) == 'cadastroUsuario') : ?>
          <h1 class="center">Cadastro de usuarios</h1>
        <?php else : ?>
          <h1 class="center">Editar de usuarios</h1>
        <?php endif; ?>

        <div class="form-group">
          <label class="col-lg-2 control-label">Login</label>
          <div class="col-lg-10">
            <input id="user_login" name="user_login" class="form-control" maxlength="30" value="<?php if (isset($editar[0]->user_login)) : echo $editar[0]->user_login; endif; ?>">
            <span class="help-block"></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-2 control-label">Nome Completo</label>
          <div class="col-lg-10">
            <input id="user_full_name" name="user_full_name" class="form-control" maxlength="100" value="<?php if (isset($editar[0]->user_full_name)) : echo $editar[0]->user_full_name; endif; ?>">
            <span class="help-block"></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-2 control-label">E-mail</label>
          <div class="col-lg-10">
            <input id="user_email" name="user_email" class="form-control" maxlength="100" value="<?php if (isset($editar[0]->user_email)) : echo $editar[0]->user_email; endif; ?>">
            <span class="help-block"></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-2 control-label">Confirmar E-mail</label>
          <div class="col-lg-10">
            <input id="user_email_confirm" name="user_email_confirm" class="form-control" maxlength="100" value="<?php if (isset($editar[0]->user_email_confirm)) : echo $editar[0]->user_email_confirm; endif; ?>">
            <span class="help-block"></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-2 control-label">Senha</label>
          <div class="col-lg-10">
            <input type="password" id="user_password" name="user_password" class="form-control" value="<?php if (isset($editar[0]->user_password)) : echo $editar[0]->user_password; endif; ?>">
            <span class="help-block"></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-2 control-label">Confirmar Senha</label>
          <div class="col-lg-10">
            <input type="password" id="user_password_confirm" name="user_password_confirm" class="form-control" value="<?php if (isset($editar[0]->user_password_confirm)) : echo $editar[0]->user_password_confirm; endif; ?>">
            <span class="help-block"></span>
          </div>
        </div>

        <div class="form-group text-center">
          <button type="submit" id="btn_save_user" class="btn btn-primary">
            <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
          </button>
          <span class="help-block"></span>
        </div>

      </form>

    </div>
  </div>
</section>