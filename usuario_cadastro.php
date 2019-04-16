<html>
<body>
<form method="post">
    CADASTRO<BR>
    Novo Usuário:<input type="text" name="nome"/><br>
    Senha:<input type="password" name="senha"/><br>
    <input type="submit" name="action" value="Cadastrar"/>
</form>
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

    $sql = "insert into usuario(nome, senha) " .
           "VALUE('$nome', '$senhaParaArmazenarNoBanco');";

    $pdo->exec($sql);
}


?>

