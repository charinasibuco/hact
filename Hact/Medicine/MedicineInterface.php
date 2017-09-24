<?php

namespace Hact\Medicine;


interface MedicineInterface {

    public function find($id);

    public function getMedicine($request = null);

    public function getReStockMedicine();

    public function getMedicineHistory($request);

    public function getExpiredMedicines($request);

    public function getLowStockMedicines($request);

    public function create($input);

    public function update($id, $input);

    public function delete($id);

    public function search($string);
}