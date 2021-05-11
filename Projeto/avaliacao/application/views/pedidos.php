<section style="min-height: calc(100vh - 83px)" class="light-bg">
<div class="row">
	<div class="container">
		<h4>Fazer Pedidos</h4>
		<div class="row">
			<div class="col-sm-5">
				<form id="frmPedidos">
					<label>Selecionar Cliente</label>
					<select class="form-control input-sm" name="clientePedidos" id="clientePedidos">
						<option value="A">Selecionar</option>
						<option value="0">Sem Cliente</option>
					</select>
					<label>Produto</label>
					<select class="form-control input-sm" name="clientePedidos" id="clientePedidos">
						<option value="A">Selecionar</option>
					</select>
					<label>Descrição</label>
					<textarea readonly="" id="descricaoV" name="descricaoV" class="form-control input-sm"></textarea>
					<label>Quantidade Estoque</label>
					<input readonly="" type="text" class="form-control input-sm" id="quantidadeV" name="quantidadeV">
					<label>Preço</label>
					<input readonly="" type="text" class="form-control input-sm" id="precoV" name="precoV">
					<label>Quantidade Vendida</label>
					<input type="text" class="form-control input-sm" id="quantV" name="quantV">
					<p></p>
					<span class="btn btn-primary" id="btnAddVenda">Adicionar</span>
					<span class="btn btn-danger" id="btnLimparVendas">Limpar Venda</span>
					</select>
				</form>
			</div>
			<div class="col-sm-3">
				<div id="imgProduto"></div>
			</div>
			<div class="col-sm-3">


<h4>Criar Venda</h4>
<h4><strong><div id="nomeclienteVenda"></div></strong></h4>
<table class="table table-bordered table-hover table-condensed" style="text-align: center;">
 <caption>
	 <span class="btn btn-success" onclick="criarVenda()"> Criar Venda
		 <span class="glyphicon glyphicon-usd"></span>
	 </span>
 </caption>
 <tr>
	 <td>Nome</td>
	 <td>Descrição</td>
	 <td>Preço</td>
	 <td>Quantidade</td>
	 <td>Remover</td>
 </tr>
 <?php 
 $total=0;//total da venda em dinheiro
 $cliente=""; //nome cliente
	 if(isset($_SESSION['tabelaComprasTemp'])):
		 $i=0;
		 foreach (@$_SESSION['tabelaComprasTemp'] as $key) {

			 $d=explode("||", @$key);
  ?>

 <tr>
	 <td><?php echo $d[1] ?></td>
	 <td><?php echo $d[2] ?></td>
	 <td><?php echo "R$ ".$d[3].",00" ?></td>
	 <td><?php echo $d[6]; ?></td>
	 <td>

		 

		 <span class="btn btn-danger btn-xs" onclick="fecharP('<?php echo $i; ?>'), editarP('<?php echo $d[0]; ?>, <?php echo $d[5]; ?>')">
			 <span class="glyphicon glyphicon-remove"></span>
		 </span>
	 </td>
 </tr>

<?php 
	 $calc = $d[3] * $d[6];
	 $total=$total + $calc;
	 $i++;
	 $cliente=$d[4];
 }
 endif; 
?>

 <tr>
	 <td>Total da venda: <?php echo "R$ ".$total.",00"; ?></td>
 </tr>

</table>


<script type="text/javascript">
 $(document).ready(function(){
	 nome="<?php echo @$cliente ?>";
	 $('#nomeclienteVenda').text("Nome de cliente: " + nome);
 });
</script>

			</div>
		</div>
	</div>
</section>

