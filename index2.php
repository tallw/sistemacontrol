<?php
require 'conexao.php';

// Recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa está vazio, se estiver executa uma consulta completa
if (empty($termo)):

	$conexao = conexao::getInstance();
	$sql = 'SELECT o.funcionario, s.descricao, o.id_ordem FROM ordem o, servico s where s.id_servico = o.fk_id_ordem;';
	$stm = $conexao->prepare($sql);
	$stm->execute();
	$clientes = $stm->fetchAll(PDO::FETCH_OBJ);

else:

	// Executa uma consulta baseada no termo de pesquisa passado como parâmetro
	$conexao = conexao::getInstance();
	$sql = 'SELECT id_ordem, funcionario FROM ordem WHERE funcionario LIKE :nome';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':nome', $termo.'%');
	//$stm->bindValue(':email', $termo.'%');
	$stm->execute();
	$clientes = $stm->fetchAll(PDO::FETCH_OBJ);

endif;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title> Sistema Serviço </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container'>
		<fieldset>

			<!-- Cabeçalho da Listagem -->
			<legend><h1>Listagem</h1></legend>

			<!-- Formulário de Pesquisa -->
			<form action="" method="get" id='form-contato' class="form-horizontal col-md-10">
				<label class="col-md-2 control-label" for="termo">Pesquisar Ordem de Serviço</label>
				<div class='col-md-7'>
			    	<input type="text" class="form-control" id="termo" name="termo" placeholder="Informe Ordem">
				</div>
			    <button type="submit" class="btn btn-primary">Pesquisar</button>
			    <a href='index2.php' class="btn btn-primary">Ver</a>
			    <a href='index.php' class="btn btn-danger">Serviço</a>
			</form>

			<!-- Link para página de cadastro -->
			<a href='cadastro_servico.php' class="btn btn-success pull-right">Ordem de Serviço</a>
			<div class='clearfix'></div>

			<?php if(!empty($clientes)):?>

				<!-- Tabela de Clientes -->
				<table class="table table-striped">
					<tr class='active'>
						<th>Funcionario</th>
						<th>Tipo de Serviço</th>
						<th>Ação</th>
					</tr>
					<?php foreach($clientes as $cliente):?>
						<tr>
							<td><?=$cliente->funcionario?></td>
							<td><?=$cliente->descricao?></td>
							<td>
								<a href='editar.php?id=<?=$cliente->id_ordem?>' class="btn btn-primary">Editar Serviço</a>
								<a href='javascript:void(0)' class="btn btn-danger link_exclusao" rel="<?=$cliente->id_ordem?>">Excluir</a>
							</td>
						</tr>	
					<?php endforeach;?>
				</table>

			<?php else: ?>

				<!-- Mensagem caso não exista clientes ou não encontrado  -->
				<h3 class="text-center text-primary">Não Existe Ordens cadastrado</h3>
			<?php endif; ?>
		</fieldset>
	</div>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>