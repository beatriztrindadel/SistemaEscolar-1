<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Address extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [];

    public function getFullAddress()
    {
       $number = empty($this->number) ? 'N/A' : $this->number;

        return sprintf('%s, %s, %s, %s, %s', '%s', $this->street, $number, $this->district, $this->state, $this->city, $this->postal_code);
    }
}
