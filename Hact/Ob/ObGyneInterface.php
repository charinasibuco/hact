<?php
/**
 * Created by PhpStorm.
 * User: Jaime
 * Date: 12/22/2015
 * Time: 1:23 PM
 */

namespace Hact\Ob;


interface ObGyneInterface {

    public function getObGynes($request);

    public function getPatients($request);

    public function find($id);

    public function create($input);

    public function update($input, $id);

    public function delete($id);

    public function search($request);

    public function obGyneHistory($id, $request);

    public function chart($request);
}