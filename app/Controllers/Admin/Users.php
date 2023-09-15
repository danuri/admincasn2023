<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel;
        $data['users'] = $model->findAll();

        return view('admin/users/index',$data);
    }
}
