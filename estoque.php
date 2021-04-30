<?php 
	include_once("environment_variables.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Consulta estoque</title>
</head>

<body>
<?php include_once("menu.php"); ?> <br/>
	<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well">Consultar estoque</h3>
            </div>
        </div>
    
	
	
	<div class="row">
				<table class="table table-striped">							
                    <thead>	
                        <tr>
							<th scope="col">Id</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Saldo</th>                           
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                       

							$connectiond = mysqli_connect(DB_HOST,DB_USER ,DB_PASS,DB_NAME ) or die("Error " . mysqli_error($connectiond));
							mysqli_set_charset($connectiond, "utf8");
							$sql_produtos = 'SELECT * from produtos';
							
							$result = mysqli_query($connectiond, $sql_produtos) or die("Error " . mysqli_error($connectiond));
							if($result) {
								while($row = mysqli_fetch_array($result)){ // Verificando de produto a produto
									//Iniciando os valores de entrada e retirada para cada produto
									$entrada = 0;
									$retirada = 0;

									// Pega todas as entradas deste produto e soma as quantidades
									$sql_entrada = 'SELECT SUM(quantidade) as entrada from entrada where produto = '.$row["id"];
									$result_entrada = mysqli_query($connectiond, $sql_entrada);
									if($result_entrada) {
										$row_entrada = mysqli_fetch_array($result_entrada);
										//se existir alguma entrada, atualiza a variável de entrada
										$entrada = $row_entrada["entrada"];
									}

									// Pega todas as retiradas válidas deste produto e soma as quantidades
									$sql_retirada = 'SELECT SUM(quantidade) as retirada from retirada where valida_op="valida" AND produto = '.$row["id"];
									$result_retirada = mysqli_query($connectiond, $sql_retirada);
									
									if($result_retirada) {
										$row_retirada = mysqli_fetch_array($result_retirada);
										//se existir alguma retirada, atualiza a variável de retirada
										$retirada = $row_retirada["retirada"];
									}

									$saldo = $entrada - $retirada;
									
									if($row["alert_number"] >= $saldo){
										$class = "style='background: pink'";
									}
									else {
										$class = "";
									}

									echo '<tr '.$class.'>';
									echo '<th scope="row">'. $row['id'] . '</th>';
									echo '<td>'. $row['produto'] . '</td>';
									echo '<td>'.$saldo.'</td>';                  	            
									echo '<td width=250></td>';
									echo '</tr>';
								}
							}
                        
                        ?>
                    </tbody>
                </table>
            </div>
	</body>
	
