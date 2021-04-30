<?php 
include_once("environment_variables.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Consulta retirada</title>
</head>
	
	
<?	
	
		?>
<body>
	<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well">Consultar retirada</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="consultaret.php" method="post">

                  <div class="control-group  <?php echo !empty($produtoErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Produto:</label><span class="style1">*</span>
                        <div class="controls">
                            <input size="50" class="form-control" name="produto" type="text" placeholder="Escaneie o cód. do produto"
                                   value="<?php echo !empty($produto) ? $produto : ''; ?>">
                            <?php if (!empty($produtoErro)): ?>
                                <span class="text-danger"><?php echo $produtoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
					
					
				
				<div class="form-actions">
                        <br/>
                        <input class="btn btn-success" type="submit" value="BUSCAR">
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
				
				
                  
            </div>
            </div>
        </div>
    
	
	
	<div class="row">
                
				<table align="center">					
							<th align="center">Resultado da sua busca para os registros do último mês:</th>   					     
				</table>
				<table class="table table-striped">							
                    <thead>	
                        <tr>
							<th scope="col">Id</th>
							<th scope="col">Data(A-M-D H:M:S)</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Colaborador</th>                           
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                       
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produtoErro = null;
    
    
    

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['produto'])) {
            $produto = $_POST['produto'];
        } else {
            $produtoErro = 'Insira o produto!';
            $validacao = False;
        }
	}
							
						
		 				$servidor = DB_HOST;
						$usuario = DB_USER;
						$senha = DB_PASS;
						$dbname = DB_NAME;
						//Criar a conexao
						$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
						
						
						if ($validacao) {
                       $pesquisar = $_POST['produto'];
							
					   $result = "SELECT * FROM retirada WHERE produto LIKE '%$pesquisar%' AND valida_op LIKE 'valida'";
					   $resultado = mysqli_query($conn, $result);
							
						
	
	

                        if ($validacao) 
							while($row = mysqli_fetch_array($resultado))
								
                        {
                            echo '<tr>';
			                echo '<th scope="row">'. $row['id'] . '</th>';
							echo '<td>'. $row['data'] . '</td>';
                            echo '<td>'. $row['produto'] . '</td>';
                            echo '<td align="center">'. $row['quantidade'] . '</td>';
                            echo '<td align="center">'. $row['colaborador'] . '</td>';                       	            
                            echo '<td width=250>';
							
                            /* echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'">Info</a>';
                            echo ' '; */
							
                           /* echo '<a align="center" class="btn btn-success" href="?id='.$row['id'].'">Finalizar</a>'; */
							
							echo ' ';
							
                            echo '&emsp;&emsp;<a align="right" class="btn btn-danger" href="deleteret.php?id='.$row['id'].'">CANCELAR</a>';
							
                            echo '</td>';
                            echo '</tr>';
                        }
						}
							}
                        
                        ?>
                    </tbody>
                </table>
            </div>
	</body>
	
