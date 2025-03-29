<?php

namespace App\Controllers;
use App\Validation\StudentValidation;
use App\Controllers\BaseController;
use App\Entities\Student;
use App\Models\ParentModel;
use App\Models\StudentModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RedirectResponse;
//use App\Models\Validation\StudentValidation;




use App\Entities\ParentStudent;
use App\Validation\ParentValidation;
use CodeIgniter\HTTP\RequestInterface;



class StudentsController extends BaseController
{
    private const  VIEWS_DIRECTORY = 'Students/';

    private StudentModel $studentModel;

    public function __construct()
    {
        $this->studentModel = model(StudentModel::class);
    }

    public function index(): string
    {
        $this->dataToView['title'] = 'Gerenciar os alunos';
        $this->dataToView['students'] = $this->studentModel->orderBy('name', 'ASC')->findAll();



        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }

    public function new(): string
    {
        
        $parentCode = esc($this->request->getGet('parent_code'));
        
  
        $parent = model(ParentModel::class)->getByCode(code: $parentCode);
      
        

        $this->dataToView['title'] = 'Novo aluno';
        $this->dataToView['student'] = new Student(['parent' => $parent]);



        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }

    public function create(): RedirectResponse
    {
        $rules = (new StudentValidation)->getRules();
       // var_dump($rules);

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $parentCode = (string) $this->request->getPost('parent_code');
        $parent = model(ParentModel::class)->getByCode(code: $parentCode);

        $student = new Student($this->validator->getValidated());
        $student->parent_id = $parent->id;

        $success = $this->studentModel->save($student);

        if (!$success) {
            return redirect()->back()->with('danger', "Ocorreu um erro na criação do aluno");
        }

        $createdStudent = $this->studentModel->find($this->studentModel->getInsertID());

        return redirect()->route('students.show', [$createdStudent->code])->with('success', "Sucesso!");
    }


    public function show(string $code){
        
        //buscando aluno com o responsável
        $student = $this->studentModel-> getByCode(code: $code, withParent: true);
      
        

        $this->dataToView['title'] = 'Detalhes do aluno';
        $this->dataToView['student'] = $student;


        return view(self::VIEWS_DIRECTORY . 'show', $this->dataToView);
    }

    public function edit(string $code){
        
        //buscando aluno com o responsável
        $student = $this->studentModel-> getByCode(code: $code, withParent: true);
      
        

        $this->dataToView['title'] = 'Editar o aluno';
        $this->dataToView['student'] = $student;


        return view(self::VIEWS_DIRECTORY . 'edit', $this->dataToView);
    }

    public function update(string $code): RedirectResponse
    {
        $student = $this->studentModel-> getByCode(code: $code);
        
        $rules = (new StudentValidation)->getRules($student->id);
       // var_dump($rules);

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

       
        //populamos as propriedades do aluno com os dados validados
        $student->fill($this->validator->getValidated());
    

        $success = $this->studentModel->save($student);

        if (!$success) {
            return redirect()->back()->with('danger', "Ocorreu um erro na atualização do aluno");
        }

        $createdStudent = $this->studentModel->find($this->studentModel->getInsertID());

        return redirect()->route('students.show', [$student->code])->with('success', "Sucesso!");
    }

    public function destroy(string $code): RedirectResponse
    {
        $student = $this->studentModel-> getByCode(code: $code);

        $success = $this->studentModel->delete($student->id);

    
        return redirect()->route('students')->with('success', "Sucesso!");
    }
}
