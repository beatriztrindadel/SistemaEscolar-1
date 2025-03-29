<?php

namespace App\Models;

use App\Entities\Teacher;
use App\Entities\Address;
use App\Models\Basic\AppModel;
use CodeIgniter\Exceptions\PageNotFoundException;



class TeacherModel extends AppModel
{
    protected $table            = 'teachers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Teacher::class;
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

    public function store(Teacher $teacher, Address $address): bool
    {
        try {

            $this->db->transException(true)->transStart();

            model(AddressModel::class)->save($address);
            $teacher->address_id = $address->id ?? model(AddressModel::class)->getInsertID();

            $this->save($teacher);

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
    ): Teacher {

        $teacher = $this->where(['code' => $code])->first();

        if ($teacher == null) {

            throw new PageNotFoundException("Professor não encontrado. Code: {$code}");
        }

        if ($withAddress) {
            $teacher->address = model(AddressModel::class)->find($teacher->address_id);
        }

        return $teacher;
    }


    public function destroy(Teacher $teacher): bool
    {
        try {
            $this->db->transException(true)->transStart();

            $this->delete($teacher->id);


            model(AddressModel::class)->delete($teacher->address_id);


            $this->db->transComplete();

            return $this->db->transStatus();
        } catch (\Throwable $th) {
            log_message('error', "Erro ao deletar o professor: {$th->getMessage()}");

            return false;
        }
    }
}
