<?php

namespace App\Models;

use App\Models\Basic\AppModel;
use App\Entities\Schedule;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\I18n\Time;

class ScheduleModel extends AppModel
{
    protected $table            = 'schedules';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Schedule::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'class_id',
        'subject_id',
        'teacher_id',
        'day_of_week',
        'start_at',
        'end_at',    
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['escapeData'];
    protected $afterInsert    = ['escapeData'];

   /** 
   * Recupera os horários da turma informada 
   * @param int $classId
   * @param null | string &$year se não for informado, serão recuperado de acordo com o ano letivo corrente atual
   * 
   */
    public function getByClassId(int $classId, ?string $year = null): array 
    {
        $this->select([
            'schedules.*', 
            'subjects.name AS subject', 
            'teachers.name AS teacher'
        ]);

        $this->join('subjects', 'subjects.id = schedules.subject_id');
        $this->join('teachers', 'teachers.id = schedules.teacher_id');

        $this->where('schedules.class_id', $classId);
        $this->where('YEAR(schedules.created_at)', $year ?? Time::now()->getYear());

        $this->orderBy('schedules.day_of_week', 'ASC');

        return $this->findAll();
    }
}