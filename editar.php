<?php
require 'conexao.php';

// Recebe o id do cliente do cliente via GET
$id_cliente = (isset($_GET['id'])) ? $_GET['id'] : '';

// Valida se existe um id e se ele é numérico
if (!empty($id_cliente) && is_numeric($id_cliente)):

	// Captura os dados do cliente solicitado
	$conexao = conexao::getInstance();
	$sql = 'SELECT id_servico, descricao, valor, status FROM servico WHERE id_servico = :id';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':id', $id_cliente);
	$stm->execute();
	$cliente = $stm->fetch(PDO::FETCH_OBJ);

	if(!empty($cliente)):

		// Formata a data no formato nacional
		$array_data     = explode('-', $cliente->data_nascimento);
		$data_formatada = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];

	endif;

endif;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Edição de Serviço</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container'>
		<fieldset>
			<legend><h1>Formulário - Edição de Serviço</h1></legend>
			
			<?php if(empty($cliente)):?>
				<h3 class="text-center text-danger">Cliente não encontrado!</h3>
			<?php else: ?>
				<form action="action_cliente.php" method="post" id='form-contato' enctype='multipart/form-data'>
				    <div class="form-group">
				      <label for="nome">Nome</label>
				      <input type="text" class="form-control" id="nome" name="nome" value="<?=$cliente->descricao?>" placeholder="Infome a Descrição">
				      <span class='msg-erro msg-nome'></span>
				    </div>

				    <div class="form-group">
				      <label for="valor">Valor</label>
				      <input type="valor" class="form-control" id="valor" name="valor" value="<?=$cliente->valor?>" placeholder="Informe o Valor">
				      <span class='msg-erro msg-valor'></span>
				    </div>

				    <!--div class="form-group">
				      <label for="cpf">CPF</label>
				      <input type="cpf" class="form-control" id="cpf" maxlength="14" name="cpf" value="<?=$cliente->cpf?>" placeholder="Informe o CPF">
				      <span class='msg-erro msg-cpf'></span>
				    </div>
				    <div class="form-group">
				      <label for="data_nascimento">Data de Nascimento</label>
				      <input type="data_nascimento" class="form-control" id="data_nascimento" maxlength="10" value="<?=$data_formatada?>" name="data_nascimento">
				      <span class='msg-erro msg-data'></span>
				    </div>
				    <div class="form-group">
				      <label for="telefone">Telefone</label>
				      <input type="telefone" class="form-control" id="telefone" maxlength="12" name="telefone" value="<?=$cliente->telefone?>" placeholder="Informe o Telefone">
				      <span class='msg-erro msg-telefone'></span>
				    </div>
				    <div class="form-group">
				      <label for="celular">Celular</label>
				      <input type="celular" class="form-control" id="celular" maxlength="13" name="celular" value="<?=$cliente->celular?>" placeholder="Informe o Celular">
				      <span class='msg-erro msg-celular'></span>
				    </div!-->
				    <div class="form-group">
				      <label for="status">Status</label>
				      <select class="form-control" name="status" id="status">
					    <option value="<?=$cliente->status?>"><?=$cliente->status?></option>
					    <option value="Ativo">Ativo</option>
					    <option value="Inativo">Inativo</option>
					  </select>
					  <span class='msg-erro msg-status'></span>
				    </div>

				    <input type="hidden" name="acao" value="editar">
				    <input type="hidden" name="id" value="<?=$cliente->id?>">
				    <input type="hidden" name="foto_atual" value="<?=$cliente->foto?>">
				    <button type="submit" class="btn btn-primary" id='botao'> 
				      Gravar
				    </button>
				    <a href='index.php' class="btn btn-danger">Cancelar</a>
				</form>
			<?php endif; ?>
		</fieldset>

	</div>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>