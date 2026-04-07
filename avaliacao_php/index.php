<?php 
include('config.php'); 

if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $media = $_POST['media'];
    $mensalidade = $_POST['mensalidade'];

    // Corrigir formato brasileiro
    $mensalidade = str_replace('.', '', $mensalidade); 
    $mensalidade = str_replace(',', '.', $mensalidade);

    mysqli_query($conn, "INSERT INTO alunos (nome, media, mensalidade)
    VALUES ('$nome', '$media', '$mensalidade')");

    // 🔥 CORREÇÃO PRINCIPAL (evitar duplicação)
    header("Location: index.php");
    exit;
}
?>

<h2>Cadastrar Aluno</h2>

<form method="POST" action="">
    Nome: <input type="text" name="nome" required><br><br>
    Média: <input type="number" step="0.1" name="media" required><br><br>

    Mensalidade: <input type="text" name="mensalidade" required><br><br>

    <button type="submit">Salvar</button>
</form>

<hr>

<h2>Relatório</h2>

<table border="1">
<tr>
    <th>Nome</th>
    <th>Média</th>
    <th>Mensalidade</th>
    <th>Desconto</th>
    <th>Líquido</th>
    <th>Ações</th>
</tr>

<?php

$result = mysqli_query($conn, "SELECT * FROM alunos");

while($row = mysqli_fetch_assoc($result)) {

    $media = $row['media'];
    $mensalidade = $row['mensalidade'];

    if ($media == 10) {
        $desconto = $mensalidade * 0.20;
    } elseif ($media >= 7) {
        $desconto = $mensalidade * 0.10;
    } else {
        $desconto = $mensalidade * 0.05;
    }

    $liquido = $mensalidade - $desconto;

    echo "<tr>
        <td>{$row['nome']}</td>
        <td>{$media}</td>
        <td>R$ " . number_format($mensalidade, 2, ',', '.') . "</td>
        <td>R$ " . number_format($desconto, 2, ',', '.') . "</td>
        <td>R$ " . number_format($liquido, 2, ',', '.') . "</td>
        <td>
            <a href='editar.php?id={$row['id']}'>Editar</a> |
            <a href='excluir.php?id={$row['id']}'>Excluir</a>
        </td>
    </tr>";
}
?>

</table>
