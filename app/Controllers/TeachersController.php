<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use App\Validation\AddressValidation;
use CodeIgniter\HTTP\RedirectResponse;
use App\Entities\Address;
use App\Entities\Teacher;
use App\Models\TeacherModel;
use App\Validation\TeacherValidation;

class TeachersController extends BaseController
{
    private const  VIEWS_DIRECTORY = 'Teachers/';

    private TeacherModel $teacherModel;

    public function __construct()
    {
        $this->teacherModel = model(TeacherModel::class);
    }

    public function index(): string
    {
        $this->dataToView['title'] = 'Gerenciar os professores';
        $this->dataToView['teachers'] = $this->teacherModel->orderBy('name', 'ASC')->findAll();

        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }


    public function new(): string
    {
        $this->dataToView['title'] = 'Novo professor';
        $this->dataToView['teacher'] = new Teacher([
            'address' => new Address()
        ]);


        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }

    public function create(): RedirectResponse
    {
        $rules = (new TeacherValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $teacher = new Teacher($this->validator->getValidated());

        $rules = (new AddressValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $address = new Address($this->validator->getValidated());


        $success = $this->teacherModel->store(teacher: $teacher, address: $address);

        if (!$success) {
            return redirect()->back()->with('danger', "Ocorreu um erro ao salvar o professor.");
        }

        return redirect()->route('teachers')->with('success', "Sucesso!");
    }

    public function show(string $code): string
    {
        $teacher = $this->teacherModel->getByCode(code: $code, withAddress: true);



        $this->dataToView['title'] = 'Detalhes do professor';
        $this->dataToView['teacher'] = $teacher;



        return view(self::VIEWS_DIRECTORY . 'show', $this->dataToView);
    }

    public function edit(string $code): string
    {
        $teacher = $this->teacherModel->getByCode(code: $code, withAddress: true);



        $this->dataToView['title'] = 'Editar do professor';
        $this->dataToView['teacher'] = $teacher;



        return view(self::VIEWS_DIRECTORY . 'edit', $this->dataToView);
    }

    public function update(string $code): RedirectResponse
    {
        $teacher = $this->teacherModel->getByCode(code: $code, withAddress: true);

        $rules = (new TeacherValidation)->getRules($teacher->id);

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $teacher->fill($this->validator->getValidated());

        $rules = (new AddressValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $address = $teacher->address;
        $address->fill($this->validator->getValidated());

        $success = $this->teacherModel->store(teacher: $teacher, address: $address);

        if (!$success) {
            return redirect()->back()->with('danger', "Ocorreu um erro na atualização do professor.");
        }

        return redirect()->route('teachers.show', [$teacher->code])->with('success', "Sucesso!");
    }

    public function destroy(string $code): RedirectResponse
    {
        $teacher = $this->teacherModel->getByCode(code: $code);

        $success = $this->teacherModel->destroy($teacher);

        if (!$success) {
            return redirect()->back()->with('danger', "Ocorreu um erro ao excluir o professor.");
        }

        return redirect()->route('teachers')->with('success', "Sucesso!");
    }
}
