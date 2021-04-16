<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Consulta estoque</title>
</head>
	
	
<?	
	
		// SELECT * FROM PRODUTO
		// ... 
		// while($row = mysql_fetch_array($resultProdutos)) {
				// SELECT SUM(quantidade) FROM entrada where [valida] and idproduto = $row["id"] GROUP BY idProduto
				//  
	//     }
	
		$sqlEstoque = 'SELECT (e.quantidade-r.quantidade) as saldo FROM entrata e LEFT JOIN (retirada r) ON e.produto=r.produto where e.valida_op="valida"'; 
	
		?>
<body>
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
							
						
		 				$servidor = "localhost";
						$usuario = "root";
						$senha = "usbw";
						$dbname = "covid";
						//Criar a conexao
						$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
						
						
						if ($validacao) {
                       $pesquisar = $_POST['produto'];
							
					   $result = "SELECT * FROM retirada WHERE produto LIKE '%$pesquisar%' AND valida_op LIKE 'valida'";
					   $resultado = mysqli_query($conn, $result);


                        if ($validacao) 
							while($row = mysqli_fetch_array($resultado)){
								
								$result = "SELECT * FROM retirada WHERE produto LIKE '%$pesquisar%' AND valida_op LIKE 'valida'";
					   			
								$resultado = mysqli_query($conn, $result);
								
								echo '<tr>';
								echo '<th scope="row">'. $row['id'] . '</th>';
								echo '<td>'. $row['produto'] . '</td>';
								echo '<td>'. $row['quantidade'] . '</td>';                  	            
								echo '<td width=250>';

								/* echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'">Info</a>';
								echo ' '; */

							   /* echo '<a align="center" class="btn btn-success" href="?id='.$row['id'].'">Finalizar</a>'; */

								echo ' ';

					//                            ec ='.$row['id'].'">CANCELAR</a>';

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
	
