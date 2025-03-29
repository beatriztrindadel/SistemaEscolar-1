<?php

namespace App\Models;

use App\Entities\Address;
use App\Entities\ParentStudent;
use App\Models\Basic\AppModel;
use CodeIgniter\Exceptions\PageNotFoundException;



class ParentModel extends AppModel
{
    protected $table            = 'parents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = ParentStudent::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'address_id',
        'name',
        'email',
        'cpf',
        'phone',

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

    public function store(ParentStudent $parent, Address $address): bool
    {
        try {

            $this->db->transException(true)->transStart();

            model(AddressModel::class)->save($address);
            $parent->address_id = $address->id ?? model(AddressModel::class)->getInsertID();

            $this->save($parent);

            //finalizando
            $this->db->transComplete();

            return $this->db->transStatus();
        } catch (\Throwable $th) {
            log_message('error', "Erro ao salvar o responsável: {$th->getMessage()}");

            return false;
        }
    }

    public function getByCode(
        string $code,
        bool $withAddress = false,
        bool $withStudents = false,
        

    ): ParentStudent {

        $parent = $this->where(['code' => $code])->first();

        if ($parent == null) {

            throw new PageNotFoundException("Responsável não encontrado. Code: {$code}");
        }

        if ($withAddress) {
            $parent->address = model(AddressModel::class)->find($parent->address_id);
        }

        return $parent;
    }


    public function destroy(ParentStudent $parent): bool
    {
        try {
            $this->db->transException(true)->transStart();

            $this->delete($parent->id);


            model(AddressModel::class)->delete($parent->address_id);


            $this->db->transComplete();

            return $this->db->transStatus();
        } catch (\Throwable $th) {
            log_message('error', "Erro ao deletar o responsável: {$th->getMessage()}");

            return false;
        }
    }
}
