<?php 
// Verifica se o arquivo JSON existe
if(!file_exists('banco.json')) {
    // Cria um arquivo JSON vazio
    file_put_contents('banco.json', json_encode([]));
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    // Obtém os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lê o arquivo JSON
    $data = json_decode(file_get_contents('banco.json'), true);

    // Verifica se o usuário já existe
    if (isset($data[$username])) {
        echo "Usuário já existe!";
    } else {
        // Adiciona o novo usuário ao array
        $data[$username] = password_hash($password, PASSWORD_BCRYPT);
        
        // Salva o array de volta no arquivo JSON
        file_put_contents('banco.json', json_encode($data));
        
        echo "Usuário cadastrado com sucesso!";
    }

    //mensagem de erro para o caso de campos vazios
    if (empty($username) || empty($password)) {
        echo "Preencha todos os campos!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <form action="" method="post">
        <label for="username">Usuário:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Entrar</button>
    </form> 
</body>
</html>