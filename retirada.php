<style type="text/css">
<!--

.style1 {
	color: #FF0000;
	font-size: medium;
}
		
}


-->
</style>

<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
// Datalist que exibe produtos
$connectiond = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("Error " . mysqli_error($connection));
mysqli_set_charset($connectiond, "utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produtoErro = null;
    $quantidadeErro = null;
    $colaboradorErro = null;
    
	
    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['produto'])) {
			$sqlprod = "select * from produtos where produto = '".$_POST['produto']."'";
			$resulprod = mysqli_query($connectiond, $sqlprod) or die("Error " . mysqli_error($connectiond));
			$rowProd = mysqli_fetch_array($resulprod);
			$produto = $rowProd["id"];
        } else {
            $produtoErro = 'Insira o produto!';
            $validacao = False;
        }


        if (!empty($_POST['quantidade'])) {
            $quantidade = $_POST['quantidade'];
        } else {
            $quantidadeErro = 'Digite a quantidade!';
            $validacao = False;
        }


        if (!empty($_POST['colaborador'])) {
            $colaborador = $_POST['colaborador'];
        } else {
            $colaboradorErro = 'Digite seu nome!';
            $validacao = False;
        }
		
		}
			$setor = $_POST['setor'];	
            $observacao = $_POST['observacao'];
            $lote = $_POST['lote'];
	
	//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO retirada (data, produto, quantidade, colaborador, setor, observacao, lote, valida_op) VALUES(NOW(),?,?,?,?,?,?,'valida')";
        $q = $pdo->prepare($sql);
        $q->execute(array($produto, $quantidade, $colaborador, $setor, $observacao, $lote));
        Banco::desconectar();
        header("Location: retirada.php");
    }
}

$sqld = "select produto from produtos";
$resultd = mysqli_query($connectiond, $sqld) or die("Error " . mysqli_error($connectiond));

?>
<script>
	

</script>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <title>Retirada</title>
</head>

<body>
<?php include_once("menu.php"); ?> 
<br/>
<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Cadastro de retirada </h3>
									
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="retirada.php" method="post">

                    <div class="control-group  <?php echo !empty($produtoErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Produto:</label><span class="style1">*</span>
                        <div class="controls">
                            <input size="50" class="form-control" name="produto"  type="text" list="categoryname" id="pcategory" placeholder="Escaneie o cód. do produto"
                                   value="<?php echo !empty($produto) ? $produto : ''; ?>">
                            <?php if (!empty($produtoErro)): ?>
                                <span class="text-danger"><?php echo $produtoErro; ?></span>
                            <?php endif; ?>
							
							<!-- Datalist que exibe os produtos -->
				<datalist id="categoryname"><?php while($row = mysqli_fetch_array($resultd)) { ?>
            	<option value="<?php echo $row['produto']; ?>"><?php echo $row['produto']; ?></option>
        				<?php } ?></datalist>
    					<?php mysqli_close($connectiond); ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($quantidadeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Quantidade:</label><span class="style1">*</span>
                        <div class="controls">
                            <input size="80" class="form-control" name="quantidade" type="number" placeholder="Digite a quantidade"
                                   value="<?php echo !empty($quantidade) ? $quantidade : ''; ?>">
                            <?php if (!empty($quantidadeErro)): ?>
                                <span class="text-danger"><?php echo $quantidadeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($colaboradorErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Colaborador:</label><span class="style1">*</span>
                        <div class="controls">
                            <input size="35" class="form-control" name="colaborador" type="text" placeholder="Digite seu nome"
                                   value="<?php echo !empty($colaborador) ? $colaborador : ''; ?>">
                            <?php if (!empty($colaboradorErro)): ?>
                                <span class="text-danger"><?php echo $colaboradorErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Setor:</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="setor" type="text" placeholder="Setor de destino">                      
                        </div>
                    </div>
					
					 <div class="control-group">
                        <label class="control-label">Observações:</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="observacao" type="text" placeholder="Observações">                      
                        </div>
                    </div>
					
					 <div class="control-group">
                        <label class="control-label">Lote(APENAS para PCR):</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="lote" type="text" placeholder="Lote do(s) kit(s) de amplificação">                      
                        </div>
                    </div>
					</br><h6 class="well" >Campos com <span class="style1">*</span> são obrigatórios</h6>

                   
                    <div class="form-actions">
						<br/>
                        
                        <button type="submit" class="btn btn-success">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
						
                    </div>
                </form>
				<div class="row">
                
				<table align="center">					
							<th align="center">Últimas retiradas:</th>   					     
				</table>
				<table class="table table-striped">							
                    <thead>	
                        <tr>
							<th scope="col">Id</th>
							<th scope="col">Data</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Colaborador</th>                           
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $pdo = Banco::conectar();
                        $sql = 'SELECT r.id as idRetirada, p.produto, p.id as produtoId, r.data, r.quantidade, r.colaborador FROM retirada r, produtos p WHERE p.id=r.produto AND valida_op LIKE "valida" ORDER BY data DESC LIMIT 7';
						
						

                        foreach($pdo->query($sql)as $row)
							
                        {
                            
                            $date = new DateTime($row['data']);
                            echo '<tr>';
			                echo '<th scope="row">'. $row['idRetirada'] . '</th>';
							echo '<td>'.  $date->format('d/m/Y H:i:s') . '</td>';
                            echo '<td>'. $row['produto'] . '</td>';
                            echo '<td align="center">'. $row['quantidade'] . '</td>';
                            echo '<td align="center">'. $row['colaborador'] . '</td>';                       	            
                            echo '<td width=250>';
							
                            /* echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'">Info</a>';
                            echo ' '; */
							
                           /* echo '<a align="center" class="btn btn-success" href="?id='.$row['id'].'">Finalizar</a>'; */
							
							echo ' ';
							
                            echo '&emsp;&emsp;<a align="right" class="btn btn-danger" href="deleteret.php?id='.$row['idRetirada'].'">REMOVER</a>';
							
                            echo '</td>';
                            echo '</tr>';
                        }
                        Banco::desconectar();
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
	
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>


</body>

</html>

