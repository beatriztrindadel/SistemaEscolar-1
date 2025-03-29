<?php

namespace App\Models;

use App\Entities\SchoolClass;
use App\Models\Basic\AppModel;
use CodeIgniter\Exceptions\PageNotFoundException;



class ClassModel extends AppModel
{
    protected $table            = 'classes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = SchoolClass::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
    
        'name',
        'description',
        
    ];



    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';




    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['escapeData', 'setCode'];
    protected $afterInsert    = ['escapeData'];


    public function getByCode(string $code, bool $withSchedules = false, bool $withStudents = false): SchoolClass {

        $class = $this->where(['code' => $code])->first();

        if ($class == null) {

            throw new PageNotFoundException("Turma não encontrado. Code: {$code}");
        }

        if ($withSchedules) {
            
            $class->schedules = [];

        }

        if ($withStudents) {
           
            $class->schedules = [];
        }


        return $class;
    }


    
}
