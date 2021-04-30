
<?php header("Content-type: text/html; charset=utf-8"); ?>
<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produtoErro = null;
    $quantidadeErro = null;
    $colaboradorErro = null;
    $emailErro = null;
    $sexoErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['produto'])) {
            $produto = $_POST['produto'];
        } else {
            $produtoErro = 'Escolha o produto!';
            $validacao = False;
        }


        if (!empty($_POST['quantidade'])) {
            $quantidade = $_POST['quantidade'];
        } else {
            $quantidadeErro = 'Digite a quantidade!';
            $validacao = False;
        }


        if (!empty($_POST['requerente'])) {
            $requerente = $_POST['requerente'];
        } else {
            $requerenteErro = 'Digite o setor requerente!';
            $validacao = False;
        }


      
    }

//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO requisicao (data, produto, quantidade, requerente, status_op) VALUES(NOW(),?,?,?,'aguardando')";
        $q = $pdo->prepare($sql);
        $q->execute(array( $produto, $quantidade, $requerente));
        Banco::desconectar();
        header("Location: index.php");
    }
}

// Datalist que exibe produtos
$connectiond = mysqli_connect(DB_HOST,DB_USER ,DB_PASS,DB_NAME ) or die("Error " . mysqli_error($connectiond));
mysqli_set_charset($connectiond, "utf8");

$sqld = "select produto from produtos";
$sqls = "select setor from setores";
$resultd = mysqli_query($connectiond, $sqld) or die("Error " . mysqli_error($connectiond));
$resultds = mysqli_query($connectiond, $sqls) or die("Error " . mysqli_error($connectiond));
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Requisição</title>
</head>

<body>
<?php include_once("menu.php"); ?> <br/>
<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Cadastro de requisição</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="requisicao.php" method="post">

                    <div class="control-group  <?php echo !empty($produtoErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Produto:</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="produto" type="text" list="categoryname" id="pcategory" placeholder="Produto" 
                                   value="<?php echo !empty($produto) ? $produto : ''; ?>">
                            <?php if (!empty($produtoErro)): ?>
                                <span class="text-danger"><?php echo $produtoErro; ?></span>
                            <?php endif; ?>
							<!-- Datalist que exibe os produtos -->
				<datalist id="categoryname"><?php while($row = mysqli_fetch_array($resultd)) { ?>
            	<option value="<?php echo $row['produto']; ?>"><?php echo $row['produto']; ?></option>
        				<?php } ?></datalist>
    					
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($quantidadeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Quantidade:</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="quantidade" type="number" placeholder="Quantidade"
                                   value="<?php echo !empty($quantidade) ? $quantidade : ''; ?>">
                            <?php if (!empty($quantidadeErro)): ?>
                                <span class="text-danger"><?php echo $quantidadeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($requerenteErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Setor requerente:</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="requerente" type="text" list="categorynames" id="pcategorys" placeholder="Setor requerente"
                                   value="<?php echo !empty($requerente) ? $requerente : ''; ?>">
                            <?php if (!empty($requerenteErro)): ?>
                                <span class="text-danger"><?php echo $requerenteErro; ?></span>
                            <?php endif; ?>
							<!-- Datalist que exibe os produtos -->
				<datalist id="categorynames"><?php while($row = mysqli_fetch_array($resultds)) { ?>
            	<option value="<?php echo $row['setor']; ?>"><?php echo $row['setor']; ?></option>
        				<?php } ?></datalist>
    					<?php mysqli_close($connectiond); ?>
                        </div>
                    </div>

                    
                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

