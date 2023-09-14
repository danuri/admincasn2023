<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Formasi extends BaseController
{
  public function index(): string
  {
      return view('formasi');
  }
}
