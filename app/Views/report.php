<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório</title>
</head>

<body class="mx-auto w-50 p-1">
<h1>Lista de Pacientes</h1>
<hr>
    <table class="table table-striped w-100">
        <thead class="thead-dark">
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Sexo</th>
                <th>Comorbidades</th>
                <th>Sintomas COVID</th>
                <th>Telefone</th>
                <th>Rua</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>Local do Exame</th>
            </tr>
        </thead>
        <?php
        foreach ($patients as $patient) {
            echo "<tr>";
            echo "<td>" . $patient->name . "</td>";
            echo "<td>" . $patient->cpf . "</td>";
            echo "<td>" . $patient->gender . "</td>";
            echo "<td>" . strtoupper($patient->comorbidities) . "</td>";
            echo "<td>" . strtoupper($patient->symptoms) . "</td>";
            echo "<td>" . $patient->telephone . "</td>";
            echo "<td>" . $patient->street . "</td>";
            echo "<td>" . $patient->district . "</td>";
            echo "<td>" . $patient->city . "</td>";
            echo "<td>" . strtoupper($patient->exame_local). "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <button class="btn btn-info mt-2 w-100"><a class="text-white" href="<?php echo site_url('/reportArchive'); ?>">Gerar Relatório</a></button>
    <button class="btn btn-primary mt-2 w-100"><a class="text-white" href="<?php echo site_url('/'); ?>">Página Inicial</a></button>
    <p class="text-center mt-2"><?php echo strtoupper("O relatório gerado fica localizado na pasta PUBLIC do projeto")?></p>
</body>

</html>