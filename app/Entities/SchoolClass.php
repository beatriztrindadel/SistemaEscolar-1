<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class SchoolClass extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [];

    public function schedules(): string
    {


        return 'Não há dados para exibir';
    }

    public function students(): string
    {


        return 'Não há dados para exibir';
    }
}
