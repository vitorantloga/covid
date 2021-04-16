<?php
require 'banco.php';

$id = 0;

if(!empty($_GET['id']))
{
    $id = $_REQUEST['id'];
}

if(!empty($_POST))
{
    $id = $_POST['id'];

    //Delete do banco:
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE retirada SET valida_op = 'invalida' where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Banco::desconectar();
    header("Location: retirada.php");
	
}
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <title>Excluir retirada</title>
    </head>

    <body>
		
        </br></br><div class="container">
            <div class="span10 offset1">
                <div class="row">
					<h3 class="well">Cancelar retirada</h3>
                </div>
                <form class="form-horizontal" action="deleteret.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                    <div class="alert alert-danger"> Tem certeza de que deseja EXCLUIR a retirada?
						</br></br> O item foi devolvido?
                    </div>
					
                    <div class="form actions">
                        <button type="submit" class="btn btn-danger">Sim</button>
                        <a href="javascript:void(0)" onClick="history.go(-1); return false;" type="btn" class="btn btn-primary">Não</a>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="assets/js/bootstrap.min.js"></script>

    </body>

    </html>
