<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\TeacherModel;
use App\Controllers\BaseController;

class SchedulesController extends BaseController
{
    private const VIEWS_DIRECTORY = 'Schedules/';

    private ClassModel $classModel;
    protected array $viewData = []; // Nome diferente

    public function __construct()
    {
        $this->classModel = model(ClassModel::class);
    }

    public function index(string $classCode)
    {
        $class = $this->classModel->getByCode(code: $classCode, withSchedules: true);

        $this->viewData['title'] = "Gerenciar os horários das turmas: {$class->name}";
        $this->viewData['class'] = $class;
        $this->viewData['subjects'] = model(SubjectModel::class)->orderBy('name', 'ASC')->findAll();
        $this->viewData['teachers'] = model(TeacherModel::class)->orderBy('name', 'ASC')->findAll();

        return view(self::VIEWS_DIRECTORY . 'index', $this->viewData);
    }
}