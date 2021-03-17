<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;

class App extends Controller
{

    public function index()
    {
        return view("index");
    }

    public function validateCpf()
    {

        $request = service("request");
        $cpf = $request->getPost("cpf");

        if (strlen($cpf) != 11) {
            return redirect()->to(site_url('/?error=CPF com tamanho inválido.'));
        } else {
            $isEqual = $this->isEqual($cpf);
            $firstDigit = $this->validateFirstDigit($cpf);
            $secondDigit = $this->validateSecondDigit($cpf);

            if ($isEqual == 11) {
                return redirect()->to(site_url('/?error=CPF com números iguais.'));
            } else if ($firstDigit != $cpf[9] || $secondDigit != $cpf[10]) {
                return redirect()->to(site_url('/?error=CPF inválido'));
            } else {
                session()->set("cpf", $cpf);
                return redirect()->to('/init');
            }
        }
    }

    public function isEqual($cpf)
    {
        $firstChar = $cpf[0];
        $repetitionsNumber = 0;

        for ($i = 0; $i < strlen($cpf); $i++) {
            if ($firstChar == $cpf[$i]) {
                $repetitionsNumber++;
            }
        }

        return $repetitionsNumber;
    }

    public function validateFirstDigit($cpf)
    {

        $total = 0;
        $multi = 10;
        $result = 0;

        for ($i = 0; $i < 9; $i++) {
            $total += $cpf[$i] * $multi;
            $multi--;
        }

        $result = 11 - ($total % 11);

        if ($result > 9) {
            $result = 0;
        }

        return $result;
    }

    public function validateSecondDigit($cpf)
    {

        $total = 0;
        $multi = 11;
        $result = 0;

        for ($i = 0; $i < 10; $i++) {
            $total += $cpf[$i] * $multi;
            $multi--;
        }

        $result = 11 - ($total % 11);

        if ($result > 9) {
            $result = 0;
        }

        return $result;
    }

    public function initAdd()
    {
        if (session()->get('cpf') == null) {
            return redirect()->to('/');
        } else {
            return view('add');
        }
    }

    public function addPerson()
    {
        if (session()->get('cpf') == null) {
            return redirect()->to('/');
        } else {
            $request = service("request");
            $covid = $request->getPost('symptoms');
            $comorbidities = $request->getPost('comorbidities');
            $localExames = $request->getPost('exame_local');


            $resultCovid = $this->validateCovid($covid);
            $resultComorbidities = $this->validateComorbidities($comorbidities);

            if ($resultCovid == 0 || $resultComorbidities == 0) {
                return redirect()->to('/init?error=Ao selecionar sintomas ou comorbidades, a opção sem comorbidades ou sintomas não pode está marcada!');
            } else {
                $covid_imploded = implode(",", $covid);
                $comorbidities_imploded = implode(',', $comorbidities);
                $localExames_imploded = implode(',', $localExames);
                $name = $request->getPost('name');
                $cpf = session()->get('cpf');
                $gender = $request->getPost('gender');
                $birth_date = $request->getPost('birth_date');
                $street = $request->getPost('street');
                $number_house = $request->getPost('number_house');
                $district = $request->getPost('district');
                $city = $request->getPost('city');
                $telephone = $request->getPost('telephone');
                $this->storeToDatabase($cpf, $name, $gender, $birth_date, $comorbidities_imploded, $covid_imploded, $street, $number_house, $district, $city, $telephone, $localExames_imploded);

                return redirect()->to('/?success=Paciente cadastrado!');
            }
        }
    }

    public function storeToDatabase($cpf, $name, $gender, $birth_date, $comorbidities, $symptoms, $street, $number_house, $district, $city, $telephone, $exame_local)
    {
        $patient = new \App\Models\Patient();
        $patient->set('id', null);
        $patient->set('cpf', $cpf);
        $patient->set('name', $name);
        $patient->set('gender', $gender);
        $patient->set('birth_date', $birth_date);
        $patient->set('comorbidities', $comorbidities);
        $patient->set('symptoms', $symptoms);
        $patient->set('street', $street);
        $patient->set('number_house', $number_house);
        $patient->set('district', $district);
        $patient->set('city', $city);
        $patient->set('telephone', $telephone);
        $patient->set('exame_local', $exame_local);
        $result = $patient->insert();
        return $result;
    }

    public function validateCovid($covid)
    {
        $isValid = 1;

        if (sizeof($covid) > 1 && $covid[sizeof($covid) - 1] == "sem sintomas") {
            $isValid = 0;
        }

        return $isValid;
    }

    public function validateComorbidities($comorbidities)
    {
        $isValid = 1;

        if (sizeof($comorbidities) > 1 && $comorbidities[sizeof($comorbidities) - 1] == "sem comorbidades") {
            $isValid = 0;
        }

        return $isValid;
    }

    public function report()
    {
        $patient = new \App\Models\Patient();
        $data['patients'] = $patient->findAll();
        return view('report', $data);
    }

    public function reportArchive()
    {

        $patient = new \App\Models\Patient();
        $data['patients'] = $patient->findAll();
        $archive = fopen('report.txt', 'w');
        fwrite($archive, "Relatorio do Sistema");
        fwrite($archive, "\n");
        
        foreach ($data['patients'] as $patient) {
            fwrite($archive, "---------------------");
            fwrite($archive, "\n");
            fwrite($archive, strval($patient->id));
            fwrite($archive, "\n");
            fwrite($archive, $patient->name);
            fwrite($archive, "\n");
            fwrite($archive, $patient->cpf);
            fwrite($archive, "\n");
            fwrite($archive, $patient->gender);
            fwrite($archive, "\n");
            fwrite($archive, strtoupper($patient->comorbidities));
            fwrite($archive, "\n");
            fwrite($archive, strtoupper($patient->symptoms));
            fwrite($archive, "\n");
            fwrite($archive, $patient->street);
            fwrite($archive, "\n");
            fwrite($archive, $patient->number_house);
            fwrite($archive, "\n");
            fwrite($archive, $patient->district);
            fwrite($archive, "\n");
            fwrite($archive, $patient->city);
            fwrite($archive, "\n");
            fwrite($archive, $patient->telephone);
            fwrite($archive, "\n");
            fwrite($archive,  strtoupper($patient->exame_local));
            fwrite($archive, "\n");
            fwrite($archive, "---------------------");
            fwrite($archive, "\n");
        }
        return redirect()->to('/report');
    }
}
