<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Exception;

class Users extends BaseController
{
    use ResponseTrait;
    public $db;
    public function __construct() {
        $this->db = \Config\Database::connect();
      }
    public function index()
    {        
        $userModel = new UserModel();
        $data = $userModel->findAll();
        return $this->getResponse($data);
    }
    public function find()
    {                
        $id = $this->getSegment(3);
        $userModel = new UserModel();        
        try {
            $user = $userModel->find($id);
            return $this->response->setJSON($user);
        } catch (\Exception $e) {
            die($e->getMessage());
        }        
        
    }
}