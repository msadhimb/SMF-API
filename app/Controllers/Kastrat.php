<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\KastratModel;

class Kastrat extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        $model = new KastratModel();
        $data = $model->findAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new KastratModel();
        $data = $model->find(['id' => $id]);
        if(!$data) return $this->failNotFound('No Data Found');
        return $this->respond($data[0]);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        helper(['form']);
        $rules = [
            'kastrat_author' => 'required',
            'kastrat_title' => 'required',
            'kastrat_subject' => 'required',
            'kastrat_desc' => 'required',
        ];
        $file = $this->request->getFile('kastrat_image');
        $fileName = $file->getRandomName();
        $file->move('uploads/kastrat', $fileName);
        $data = [
            'kastrat_author' => $this->request->getVar('kastrat_author'),
            'kastrat_image' => $fileName,
            'kastrat_title' => $this->request->getVar('kastrat_title'),
            'kastrat_subject' => $this->request->getVar('kastrat_subject'),
            'kastrat_desc' => $this->request->getVar('kastrat_desc'),
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors()); 
        $model = new KastratModel();
        $model->save($data);
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data Added'
            ]
        ];
        return $this->respondCreated($response);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        helper(['form']);
        $rules = [
            'kastrat_author' => 'required',
            'kastrat_title' => 'required',
            'kastrat_subject' => 'required',
            'kastrat_desc' => 'required',
        ];
        $data = [
            'kastrat_author' => $this->request->getVar('kastrat_author'),
            'kasrat_image' => $this->request->getVar('kastrat_image'),
            'kastrat_title' => $this->request->getVar('kastrat_title'),
            'kastrat_subject' => $this->request->getVar('kastrat_subject'),
            'kastrat_desc' => $this->request->getVar('kastrat_desc'),
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors()); 
        $model = new KastratModel();
        $findById = $model->find(['id' => $id]);
        if(!$findById) return $this->failNotFound('No Data Found');
        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new KastratModel();
        $findById = $model->find(['id' => $id]);
        if(!$findById) return $this->failNotFound('No Data Found');
        $model->delete($id);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data Deleted'
            ]
        ];
        return $this->respond($response);
    }
}
