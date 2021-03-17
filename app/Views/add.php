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
    <h1>Iniciando Cadastro!</h1>
    <hr>
    <form action="<?php echo site_url('/addPerson') ?>" method="post" class="form-group"> 
        <label for="name">Nome completo</label>
        <input type="text" name="name" id="name" class="form-control w-100" required>
        <p>
            <label for="gender">Sexo</label>
            <select name="gender" id="gender" required class="form-control w-100">
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
            </select>
        </p>
        <p>
            <label for="birth-date">Data Nasc.</label>
            <input type="date" name="birth_date" id="birth-date" required class="form-control w-100">
        </p>
        <p>
            <label for="comorbidities">Comorbidades</label>
            <select name="comorbidities[]" id="comorbidities" multiple required class="form-control w-100">
                <option value="arritmia">Arritmia</option>
                <option value="asma descompensada">Asma descompensada</option>
                <option value="diabetes">Diabetes</option>
                <option value="doenças hepaticas">Doenças hepáticas crônicas</option>
                <option value="gestante">Gestante de alto risco</option>
                <option value="hipertensao">Hipertensão</option>
                <option value="idade 60">Idade acima de 60</option>
                <option value="imunossupressao por medicacao">Imunossupressão por medicação</option>
                <option value="insuficiencia cardiaca">Insuficiência cardiaca</option>
                <option value="insuficiencia renal">Insuficiência renal crônica</option>
                <option value="obesidade">Obesidade com IMC acima de 40</option>
                <option value="sem comorbidades">Sem comorbidades</option>
            </select>
        </p>
        <p>
            <label for="symptoms">Sintomas COVID 19</label>
            <select name="symptoms[]" id="symptomns" multiple required class="form-control w-100">
                <option value="anosmia">Anosmia (falta de olfato)</option>
                <option value="astenia">Astenia (fraqueza ou cansaço)</option>
                <option value="sem paladar">Ausência de paladar</option>
                <option value="coriza">Coriza</option>
                <option value="dor de cabeça">Dor de cabeça</option>
                <option value="dor de garganta">Dor de garganta</option>
                <option value="falta de ar">Falta de ar</option>
                <option value="febre">Febre</option>
                <option value="tosse">Tosse</option>
                <option value="sem sintomas">Sem sintomas</option>
            </select>
        </p>
        <p>
            <label for="street">Rua</label>
            <input type="text" name="street" id="street" required class="form-control w-100">
            <label for="number-house">Número da casa</label>
            <input type="number" name="number_house" id="number-house" required class="form-control w-100"> 
            <label for="district">Bairro</label>
            <input type="text" name="district" id="district" required class="form-control w-100">
            <label for="city">Cidade</label>
            <input type="text" name="city" id="city" required class="form-control w-100">
            <label for="telephone">Telefone</label>
            <input type="tel" name="telephone" id="telephone" required class="form-control w-100">
        </p>
        <p>
            <label for="">Local do Teste</label>
            <select name="exame_local[]" id="exame_local" multiple required class="form-control w-100">
                <option value="upa">UPA</option>
                <option value="hospital privado">Hospital privado</option>
                <option value="hospital publico">Hospital público</option>
            </select>
        </p>
        <button type="submit" class="btn btn-primary mt-2 w-100">Cadastrar</button>
    </form>
    <?php
        if(isset($_GET["error"])) {
            echo "<p class='alert alert-danger w-100 mt-2 text-center'>".$_GET['error']."</p>";
        }
    ?>
</body>

</html>