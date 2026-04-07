<?php
include('config.php');

$id = $_GET['id'];


$result = mysqli_query($conn, "SELECT * FROM alunos WHERE id=$id");
$dados = mysqli_fetch_assoc($result);


if ($_POST) {
    $nome = $_POST['nome'];
    $media = $_POST['media'];
    $mensalidade = $_POST['mensalidade'];

    mysqli_query($conn, "UPDATE alunos SET 
        nome='$nome',
        media='$media',
        mensalidade='$mensalidade'
        WHERE id=$id");

    header("Location: index.php");
}
?>

<h2>Editar Aluno</h2>

<form method="POST">
    Nome: <input type="text" name="nome" value="<?=$dados['nome']?>"><br><br>
    Média: <input type="text" name="media" value="<?=$dados['media']?>"><br><br>
    Mensalidade: <input type="text" name="mensalidade" value="<?=$dados['mensalidade']?>"><br><br>
    <button type="submit">Atualizar</button>
</form>