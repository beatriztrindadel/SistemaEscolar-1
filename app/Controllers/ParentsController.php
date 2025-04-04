<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use App\Validation\AddressValidation;
use App\Validation\ParentValidation;
use CodeIgniter\HTTP\RedirectResponse;
use App\Models\ParentModel;
use App\Entities\Address;
use App\Entities\ParentStudent;


class ParentsController extends BaseController
{
    private const  VIEWS_DIRECTORY = 'Parents/';

    private ParentModel $parentModel;

    public function __construct()
    {
        $this->parentModel = model(ParentModel::class);
        
    }
    public function index(): string
    {
        $this->dataToView['title'] = 'Gerenciar os responsáveis';
        $this->dataToView['parents'] = $this->parentModel->orderBy('name', 'ASC')->findAll();

        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }

    public function new(): string
    {
        $this->dataToView['title'] = 'Novo responsável';
        $this->dataToView['parent'] = new ParentStudent([
            'address' => new Address()
        ]);


        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }

    public function create(): RedirectResponse
    {
        $rules = (new ParentValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $parent = new ParentStudent($this->validator->getValidated());

        $rules = (new AddressValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $address = new Address($this->validator->getValidated());


        $success = $this->parentModel->store(parent: $parent, address: $address);

        if (!$success) {
            return redirect()->back()->with('danger', "Ocorreu um erro ao salvar o responsável.");
        }

        return redirect()->route('parents')->with('success', "Sucesso!");
    }

    public function show(string $code): string
    {
        $parent = $this->parentModel->getByCode(code: $code, withAddress: true);



        $this->dataToView['title'] = 'Detalhes do responsável';
        $this->dataToView['parent'] = $parent;



        return view(self::VIEWS_DIRECTORY . 'show', $this->dataToView);
    }

    public function edit(string $code): string
    {
        $parent = $this->parentModel->getByCode(code: $code, withAddress: true);



        $this->dataToView['title'] = 'Editar do responsável';
        $this->dataToView['parent'] = $parent;



        return view(self::VIEWS_DIRECTORY . 'edit', $this->dataToView);
    }

    public function update(string $code): RedirectResponse
    {
        $parent = $this->parentModel->getByCode(code: $code, withAddress: true);

        $rules = (new ParentValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $parent->fill($this->validator->getValidated());

        $rules = (new AddressValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $address = $parent->address;
        $address->fill($this->validator->getValidated());

        $success = $this->parentModel->store(parent: $parent, address: $address);

        if (!$success) {
            return redirect()->back()->with('danger', "Ocorreu um erro na atualização do responsável.");
        }

        return redirect()->route('parents.show', [$parent->code])->with('success', "Sucesso!");
    }

    public function destroy(string $code): RedirectResponse
    {
        $parent = $this->parentModel->getByCode(code: $code);

        $success = $this->parentModel->destroy($parent);

        if(!$success){
            return redirect()->back()->with('danger', "Ocorreu um erro ao excluir o responsável.");
        }

        return redirect()->route('parents')->with('success', "Sucesso!");
    }
}

