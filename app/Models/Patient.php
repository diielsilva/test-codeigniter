<?php

namespace App\Models;

use CodeIgniter\Model;

class Patient extends Model
{
    protected $table = 'patient';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'cpf', 'name', 'gender', 'birth_date', 'comorbidities', 'symptoms', 'street', 'number_house', 'district', 'city', 'telephone', 'exame_local'];
    protected $returnType = 'object';
}
