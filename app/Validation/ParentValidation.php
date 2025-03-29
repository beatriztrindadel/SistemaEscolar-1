<?php

namespace App\Validation;

use App\Traits\CPFValidationTrait;

class ParentValidation
{
    use CPFValidationTrait;

    public function getRules(?int $id = null): array
    {
        return [
            'id' => [
                'rules' => 'permit_empty|is_natural_no_zero'
            ],
            'name' => [
                'rules' => "required|max_length[128]",
                'errors' => [
                    'required' => 'O campo nome é obrigatório',
                    'max_length' => 'O campo nome deve ter no máximo 128 caracteres'
                ],
            ],
            'cpf' => [
                'rules' => "required|exact_length[14]|validaCPF|is_unique[parents.cpf,id,{$id}]",
                'errors' => [
                    'required' => 'Informe um CPF válido',
                    'exact_length' => 'O CPF precisa ter exatamente 14 caracteres',
                    'is_unique' => 'Este CPF já está cadastrado',
                   
                ],
            ],
            'email' => [
                'rules' => "required|max_length[128]|is_unique[parents.email,id,{$id}]",
                'errors' => [
                    'required' => 'Informe o email',
                    'max_length' => 'O email deve ter no máximo 128 caracteres',
                    'valid_email' => 'Informe um email válido',
                    'is_unique' => 'Este email já está cadastrado'
                ],
            ],
            'phone' => [
                'rules' => "required|max_length[128]|is_unique[parents.phone,id,{$id}]",
                'errors' => [
                    'required' => 'Informe o telefone',
                    'max_length' => 'O telefone deve ter no máximo 128 caracteres',
                    'is_unique' => 'Este telefone já está cadastrado'
                ],
            ],
        ];
    }
}
