<?php

namespace App\Models;

use App\Helpers\NotificationHelper;

class Contact extends BaseModel
{
    protected $table = 'Contact';
    protected $id = 'id';

    public function getAllContact()
    {
        return $this->getAll();
    }
   
    public function createContact($data)
    {
        return $this->create($data);
    }
    public function deleteContact($id)
    {
        return $this->delete($id);
    }
}
