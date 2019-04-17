<?php
session_start();

if(session_id()== null || !isset($_SESSION['nome']) ) {
    die('Usuário não logado!');
}


?>
<html>
<body>
Bom dia <?php echo $_SESSION['nome'] ?>
<form method="post">
    CADASTRO<BR>
    Novo Usuário:<input type="text" name="nome"/><br>
    Senha:<input type="password" name="senha"/><br>
    <input type="submit" name="action" value="Cadastrar"/>
</form>
<a href="logout.php">Sair</a>
</body>
</html>
<?php

$pdo = new PDO("mysql:host=localhost:3306;
                    dbname=teste_senha;charset=latin1",
    'root', '');

$senhaAberta = filter_input(INPUT_POST,
                     'senha',
                            FILTER_DEFAULT);

if (!is_null($senhaAberta)) {
    $nome = filter_input(INPUT_POST,
        'nome',
        FILTER_DEFAULT);

    $senhaParaArmazenarNoBanco =
        password_hash($senhaAberta, PASSWORD_DEFAULT);

    echo '<pre>"' . print_r($senhaParaArmazenarNoBanco, true) . '"</pre>';

    $sql = "insert into usuario(nome, senha) " .
           "VALUE('$nome', '$senhaParaArmazenarNoBanco');";

    $pdo->exec($sql);
}


?>

