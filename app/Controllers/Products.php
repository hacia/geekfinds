<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\Items;

/**
 *
 * For the sake of getting this done quickly for review. Some security precautions such
 * as field validations, allowed fields, authorized users, http status codes, etc have been omitted.
 * If this were to be used in real world I would break this out further to include the above and more.
 *
 */

class Products extends ResourceController
{
    use ResponseTrait;

    public function index() {
        $items = new Items();
        $list = $items->where('isActive', '1')->findAll();
        return $this->respond(!$list ? [] : $list);
    }

    public function itemInfo($id = 0) {
        $items = new Items();
        return $this->respond($items->where('id', $id)->first());
    }

    public function createItem() {
        $request = service('request');
        $items = new Items();
        $data = json_decode(file_get_contents('php://input', true));
        $data->isActive = 1;
        $items->insert($data);
        $data->id = $items->getInsertID();
        return $this->respond($data);
    }

    public function updateItem($id = 0) {
        $request = service('request');
        $items = new Items();
        $data = json_decode(file_get_contents('php://input', true));
        $items->update($id, $data);
        $data->id = $id;
        return $this->respond($data);
    }

    public function removeItem($id = 0) {
        $items = new Items();
        $items->update($id, ['isActive' => 0]);
        return $this->respond(['success']);
    }
}
