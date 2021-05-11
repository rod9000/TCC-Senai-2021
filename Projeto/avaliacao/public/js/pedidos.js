$(document).ready(function(){

    $('#tabelaVendasTempLoad').load("tabelaVendasTemp.php");

    $('#produtoVenda').change(function(){

        $.ajax({
            type:"POST",
            data:"idproduto=" + $('#produtoVenda').val(),
            url:"../procedimentos/vendas/obterDadosProdutos.php",
            success:function(r){
                dado=jQuery.parseJSON(r);

                $('#descricaoV').val(dado['descricao']);

                $('#quantidadeV').val(dado['quantidade']);
                $('#precoV').val(dado['preco']);
                
                $('#imgProduto').prepend('<img class="img-thumbnail" id="imgp" src="' + dado['url'] + '" />');
                
            }
        });
    });

    $('#btnAddVenda').click(function(){
        vazios=validarFormVazio('frmVendasProdutos');

        quant = 0;
        quantidade = 0;

        quant = $('#quantV').val();
        quantidade = $('#quantidadeV').val();



        if(quant > quantidade){
            alertify.alert("Quantidade inexistente em estoque!!");
            quant = $('#quantV').val("");
            return false;
        }else{
            quantidade = $('#quantidadeV').val();
        }

        if(vazios > 0){
            alertify.alert("Preencha os Campos!!");
            return false;
        }

        dados=$('#frmVendasProdutos').serialize();
        $.ajax({
            type:"POST",
            data:dados,
            url:"../procedimentos/vendas/adicionarProdutoTemp.php",
            success:function(r){
                $('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");
            }
        });
    });

    $('#btnLimparVendas').click(function(){

    $.ajax({
        url:"../procedimentos/vendas/limparTemp.php",
        success:function(r){
            $('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");
        }
    });
});

});