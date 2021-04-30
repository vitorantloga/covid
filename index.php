<?php 
    include_once("environment_variables.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>	
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Página Inicial</title>
</head>

<body>
        <?php include_once("menu.php") ?>
            </br>
			</br>
            <div class="row">
                
				<table align="center">					
							<th align="center">REQUISIÇÕES:</th>   					     
				</table>
				<table class="table table-striped">							
                    <thead>	
                        <tr>
							<th scope="col">Id</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Setor requerente</th>
                            <th scope="col">Status</th>
                            <th scope="col">Data</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * FROM requisicao WHERE status_op LIKE "aguardando" ORDER BY data DESC ';
						date_default_timezone_set('America/Sao_Paulo');
						

                        foreach($pdo->query($sql)as $row)
							
                        {
                            $date = new DateTime($row['data']);

                            echo '<tr>';
			                echo '<th scope="row">'. $row['id'] . '</th>';
                            echo '<td>'. $row['produto'] . '</td>';
                            echo '<td>'. $row['quantidade'] . '</td>';
                            echo '<td>'. $row['requerente'] . '</td>';
                            echo '<td>'. $row['status_op'] . '</td>';
                            echo '<td>' .$date->format('d/m/Y H:i:s'). '</td>';
                            echo '<td width=250>';
							
                            /* echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'">Info</a>';
                            echo ' '; */
							
                            echo '<a align="center" class="btn btn-success" href="finalizareq.php?id='.$row['id'].'">Finalizar</a>';
							
							echo ' ';
							
                            echo '<a align="center" class="btn btn-danger" href="deletereq.php?id='.$row['id'].'">REMOVER</a>';
							
                            echo '</td>';
                            echo '</tr>';
                        }
                        Banco::desconectar();
                        ?>
                    </tbody>
                </table>
			</div>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
