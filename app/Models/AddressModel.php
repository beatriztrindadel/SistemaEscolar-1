<?php

namespace App\Models;

use App\Entities\Address;
use App\Models\Basic\AppModel;


class AddressModel extends AppModel
{
    protected $table            = 'addresses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Address::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
    'street',
    'city',   
    'district',
    'postal_code',   
    'state', 
    'number',
]; 

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   

  

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['escapeData'];
    protected $afterInsert    = ['escapeData'];

}
