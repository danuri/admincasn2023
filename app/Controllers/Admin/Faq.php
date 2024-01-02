<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FaqModel;

class Faq extends BaseController
{
    public function index()
    {
        $model = new FaqModel;
        $data['faqs'] = $model->findAll();

        return view('admin/faqs/index', $data);
    }

    public function add()
    {
        return view('admin/faqs/add');
    }

    public function edit($id)
    {
        $model = new FaqModel;
        $data['faq'] = $model->find($id);
        return view('admin/faqs/edit', $data);
    }

    public function save()
    {
        $model = new FaqModel;

        $category = $this->request->getVar('category');
        $question = $this->request->getVar('question');
        $answer = $this->request->getVar('answer');
        $created = session('nip');

        $param = [
          'category' => $category,
          'question' => $question,
          'answer' => $answer,
          'created_by' => $created,
        ];

        $insert = $model->insert($param);
        return redirect()->back()->with('message','Faq telah ditambahkan');
    }

    public function saveedit($id)
    {
        $model = new FaqModel;

        $category = $this->request->getVar('category');
        $question = $this->request->getVar('question');
        $answer = $this->request->getVar('answer');
        $created = session('nip');

        $param = [
          'category' => $category,
          'question' => $question,
          'answer' => $answer,
          'created_by' => $created,
        ];

        $insert = $model->update($id,$param);
        return redirect()->back()->with('message','Faq telah diupdate');
    }
}
