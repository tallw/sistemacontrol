<?php
require 'conexao.php';

	$conexao = conexao::getInstance();
	$sql = 'SELECT id_servico, descricao FROM servico';
	$stm = $conexao->prepare($sql);
	$stm->execute();
	$clientes = $stm->fetchAll(PDO::FETCH_OBJ);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Cadastro de Serviço</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container'>
		<fieldset>
			<legend><h1>Formulário - Cadastro de Serviço</h1></legend>
			
			<form action="action_cliente.php" method="post" id='form-contato' enctype='multipart/form-data'>
				

			    <div class="form-group">
			      <label for="nome">Descrição</label>
			      <input type="text" class="form-control" id="nome" name="nome" placeholder="Infome o Nome">
			      <span class='msg-erro msg-nome'></span>
			    </div>

			    <div class="form-group">
			      <label for="appt">Hora Inicio</label>
			      <input type="time" class="form-control" id="appt" name="appt" min="06:00" max="23:59" required>
			      <span class='msg-erro'></span>
			    </div>

			    
			    <div class="form-group">
			      <label for="appt">Hora Final</label>
			      <input type="time" class="form-control" id="appt" name="appt" min="06:00" max="23:59" required>
			      <span class='msg-erro'></span>
			    </div>
			    <!--div class="form-group">
			      <label for="cpf">CPF</label>
			      <input type="cpf" class="form-control" id="cpf" maxlength="14" name="cpf" placeholder="Informe o CPF">
			      <span class='msg-erro msg-cpf'></span>
			    </div>
			    <div class="form-group">
			      <label for="data_nascimento">Data de Nascimento</label>
			      <input type="data_nascimento" class="form-control" id="data_nascimento" maxlength="10" name="data_nascimento">
			      <span class='msg-erro msg-data'></span>
			    </div>
			    <div class="form-group">
			      <label for="telefone">Telefone</label>
			      <input type="telefone" class="form-control" id="telefone" maxlength="12" name="telefone" placeholder="Informe o Telefone">
			      <span class='msg-erro msg-telefone'></span>
			    </div>
			    <div class="form-group">
			      <label for="celular">Celular</label>
			      <input type="celular" class="form-control" id="celular" maxlength="13" name="celular" placeholder="Informe o Celular">
			      <span class='msg-erro msg-celular'></span>
			    </div!-->
			    <div class="form-group">
				      <label for="status">Serviço</label>
				      <select class="form-control" name="status" id="status">
    					<?php foreach($clientes as $cliente):?>
    					<option value="<?php echo $cliente->descricao ?>"><?php echo $cliente->descricao ?></option>
    						<?php endforeach;?>
					    <!--option value="<?=$cliente->status?>"><?=$cliente->status?></option!-->
					    <!--option value="Ativo">Ativo</option>
					    <option value="Inativo">Inativo</option!-->
					  </select>
					  <span class='msg-erro msg-status'></span>
				    </div>

			    <input type="hidden" name="acao" value="incluir">
			    <button type="submit" class="btn btn-primary" id='botao'> 
			      Gravar
			    </button>
			    <a href='index2.php' class="btn btn-danger">Cancelar</a>
			</form>
		</fieldset>
	</div>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>