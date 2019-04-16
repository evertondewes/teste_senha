<html>
<body>
<form method="post">
    Entrar no Sistema<BR>
    Usuário:<input type="text" name="nome"/><br>
    Senha:<input type="password" name="senha"/><br>
    <input type="submit" name="action" value="Login"/>
</form>
</body>
</html>
<?php
$pdo= new PDO("mysql:host=localhost:3306;
                    dbname=teste_senha;charset=latin1",
    'root', '');


$senhaAberta = filter_input(INPUT_POST,
    'senha',
    FILTER_DEFAULT);

if (!is_null($senhaAberta)) {
    $nome = filter_input(INPUT_POST,
        'nome',
        FILTER_DEFAULT);

    $consulta = $pdo->query(
        "select * from usuario where nome = '$nome'");

    $usuario = $consulta->fetchAll(PDO::FETCH_ASSOC);

    $logou = password_verify($senhaAberta, $usuario[0]['senha'] );

    if ($logou) {
        echo 'Senha válida';
    } else {

        echo 'Senha inválida.';
    }


}


?>