<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste CodeIgniter 4</title>
</head>

<body class="mx-auto w-50 p-1">
    <h1 class="">Cadastro de Paciente</h1>
    <hr>
    <form action="<?php echo site_url("/validate"); ?>" method="post" class="form-group">
        <label for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf" placeholder="Inserir apenas os números!" class="form-control w-100">
        <button type="submit" class="btn btn-primary w-100 mt-2">Próximo</button>
    </form>
    <button class="btn btn-info w-100"><a class="text-white" href="<?php echo site_url('/report'); ?>">Pacientes Cadastrados</a></button>
    <?php
    if (isset($_GET["error"])) {
        echo "<p class='alert alert-danger w-100 mt-2 text-center'>" . $_GET["error"] . "</p>";
    } else if (isset($_GET["success"])) {
        echo "<p class='alert alert-success w-100 mt-2 text-center'>" . $_GET["success"] . "</p>";
    }
    ?>
</body>

</html>