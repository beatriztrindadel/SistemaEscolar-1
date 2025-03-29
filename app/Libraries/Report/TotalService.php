<?php

declare(strict_types=1);

namespace App\Libraries\Report;

use App\Models\ClassModel;
use CodeIgniter\I18n\Time;

use App\Models\SubjectModel;
use App\Models\TeacherModel;


class TotalService {
    

    public function totalTeachers(): int {
        return model(TeacherModel::class)->countAllResults();
    }

    public function totalClasses(): int {
        return model(ClassModel::class)->countAllResults();
    }

    public function totalSubjects(): int {
        return model(SubjectModel::class)->countAllResults();
    }
}