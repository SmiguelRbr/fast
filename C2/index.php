<?php 
$host = "localhost";
$user = "root";
$password = "root";
$db = "chat";

$conn = mysqli_connect($host, $user, $password, $db);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//verifica se todos os campos estao preenchidos e caso não, não deixa enviar
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remetente']) && isset($_POST['destinatario']) && isset($_POST['mensagem'])){
    $remetente = $conn->real_escape_string($_POST['remetente']);
    $destinatario = $conn->real_escape_string($_POST['destinatario']);
    $mensagem = $conn->real_escape_string($_POST['mensagem']);
    
    //verifica se o remetente e o destinatario são diferentes
    if($remetente !== $destinatario){
        $sql = "INSERT INTO mensagem (remetente, destinatario, mensagem) VALUES ('$remetente', '$destinatario', '$mensagem')";
        if($conn->query($sql) === TRUE){
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        //Exiba a mensagem enviada na mesma tela, em uma lista que mostre as mensagens mais recentes no topo e as mais antigas na parte inferior.
       
    } else {
        echo "Remetente e destinatário não podem ser iguais.";
    }
} else {
    echo "Preencha todos os campos.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <title>Correio Elegante</title>
</head>
<body>
    <form action="" method="POST">
        <label for="remetente">Remetente</label>
        <input type="text" name="remetente" id="remetente" >
        <label for="destinatario">Destinatario</label>
        <input type="text" name="destinatario" id="destinatario" >
        <label for="mensagem">Mensagem</label>
        <textarea name="mensagem" id="mensagem"></textarea>
        <button type="submit">Enviar</button>
    </form>

    <?php 
    $sql = "SELECT * FROM mensagem ORDER BY id DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { 
        echo "<ul>";
        while ($row = $result->fetch_assoc()) { 
            echo "<li><strong>" . 
                 htmlspecialchars($row['remetente']) . 
                 "</strong> para <strong>" . 
                 htmlspecialchars($row['destinatario']) . 
                 "</strong>: " . 
                 htmlspecialchars($row['mensagem']) . 
                 "</li>";
        }
        echo "</ul>";
    } else {
        echo "Nenhuma mensagem encontrada.";    
    }
        ?>
</body>
</html>

