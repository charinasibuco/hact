<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/6/2016
 * Time: 10:13 AM
 */

namespace Hact\Checkup\Cart;

use Carbon\Carbon;

class ArvItem extends Item
{
    protected $infection_id;
    protected $medicine_id;
    protected $dateDiscontinue;
    protected $reason;
    protected $prescription_specify;

    /**
     * ArvItem constructor.
     */
    public function __construct($infection_id = '', $medicine_id, $name, $qty, $reason = '', $prescription_specify = '', $dateStarted = '', $dateDiscontinue = '')
    {
        $this->id                       = $this->generateRandomString();
        $this->type                     = 'arv';
        $this->infection_id             = $infection_id;
        $this->medicine_id              = $medicine_id;
        $this->name                     = $name;
        $this->qty                      = $qty;
        $this->reason                   = $reason;
        $this->prescription_specify     = $prescription_specify;
        $this->dateStarted              = $dateStarted;
        $this->dateDiscontinue          = $dateDiscontinue;
    }

    /**
     * @param $id
     */
    public function setInfectionId($id){
        $this->infection_id     = $id;
    }

    /**
     * @param $id
     */
    public function setMedicineId($id){
        $this->medicine_id      = $id;
    }

    /**
     * @param $string
     */
    public function setReason($string){
        $this->reason = $string;
    }

    /**
     * @param $string
     */
    public function setPrescriptionSpecify($string){
        $this->prescription_specify = $string;
    }

    /**
     * @param $dateDiscontinue
     */
    public function setDateDiscontinue($dateDiscontinue)
    {
        $this->dateDiscontinue = $dateDiscontinue;
    }

    /**
     * @return integer
     */
    public function getInfectionId()
    {
        return $this->infection_id;
    }

    /**
     * @return mixed
     */
    public function getMedicineId()
    {
        return $this->medicine_id;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return string
     */
    public function getPrescriptionSpecify()
    {
        return $this->prescription_specify;
    }

    /**
     * @return string
     */
    public function getDateDiscontinue()
    {
        return Carbon::parse($this->dateDiscontinue)->format($this->date_format);
    }

}