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

    if(isset($usuario[0])) {
        $logou = password_verify($senhaAberta, $usuario[0]['senha'] );
        if ($logou) {
            session_start();
            $_SESSION['nome'] = $usuario[0]['nome'];
            header('Location: usuario_cadastro.php');
            die();
        } else {
            $mensagem =  'Senha inválida.';
        }
    } else {
        $mensagem = 'Usuário não encontrado!';
    }
}
?>
<html>
<body>
<form method="post">
    Entrar no Sistema<BR>
    Usuário:<input type="text" name="nome"/><br>
    Senha:<input type="password" name="senha"/><br>
    <input type="submit" name="action" value="Login"/>
</form>
<?php echo isset($mensagem)?$mensagem:''; ?>
</body>
</html>
