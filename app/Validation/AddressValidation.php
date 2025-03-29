<?php

namespace App\Validation;



class AddressValidation
{
  

    public function getRules(?int $id = null): array
    {
        return [
           
            'postal_code' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Informe o CEP',
                    
                ],
            ],

            'street' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Informe a rua',
                    
                ],
            ],

            'district' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Informe o bairro',      
                ],
            ],

            'number' => [
                'rules' => "permit_empty",          
                
            ],

            'city' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Informe a cidade',
                    
                ],
            ],

            'state' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Informe o estado',
                    
                ],
            ],
            
        ];
    }
}
