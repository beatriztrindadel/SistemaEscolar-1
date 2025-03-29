<?php

namespace App\Models;

use App\Entities\SchoolClass;
use App\Entities\Enrollment;
use App\Models\Basic\AppModel;
use CodeIgniter\Exceptions\PageNotFoundException;



class EnrollmentModel extends AppModel
{
    protected $table            = 'enrollments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Enrollment::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [

        'class_id',
        'student_id',

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


    public function getByCode(string $code): Enrollment    {

        $enrollment = $this->where(['code' => $code])->first();

        if ($enrollment == null) {

            throw new PageNotFoundException("Matricula não encontrado. Code: {$code}");
        }

    

        return $enrollment;
    }
}
