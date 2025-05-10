<?php 
session_start();
    //verifica se o arquivo JSON Existe
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

        // Verifica se o usuário existe e a senha está correta
        if (isset($data[$username]) && password_verify($password, $data[$username])) {
            $_SESSION['username'] = $username; // Armazena o nome de usuário na sessão
            echo "Login bem-sucedido!";
        } else {
            echo "Usuário ou senha incorretos!";
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
    <title>Login</title>
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

    <!-- Mostrar botao de logout apenas quando o login for bem-sucedido -->
    <?php 
   if (isset($_SESSION['username'])) {
        echo '<form action="logout.php" method="post">
                <button type="submit">Logout</button>
              </form>';
    }
    ?>
    <p><a href="index.php">Voltar</a></p>
        
    <p><a href="cadastro.php">Cadastrar</a></p>
</body>
</html>