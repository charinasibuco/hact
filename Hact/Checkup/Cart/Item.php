<?php
/**
 * Created by PhpStorm.
 * User: Jaime Handayan
 * Date: 4/5/2016
 * Time: 4:09 PM
 */

namespace Hact\Checkup\Cart;


use Carbon\Carbon;

abstract class Item implements ItemInterface
{
    /**
     * @var
     */
    protected $id;
//    protected $patient_id;
    protected $name;
    protected $qty;
    protected $type;
    protected $dateStarted;
    protected $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public $date_format     = 'F d, Y';

    /**
     * Item constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $id
     */
    public function setID($id)
    {
        // TODO: Implement setID() method.
        $this->id = $id;
    }

    /**
     * @param $id
     */
//    public function setPatientID($id)
//    {
//        // TODO: Implement setPatientID() method.
//        $this->patient_id = $id;
//    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        // TODO: Implement setName() method.
        $this->name = $name;
    }

    /**
     * @param $qty
     */
    public function setQTY($qty)
    {
        // TODO: Implement setQTY() method.
        $this->qty = $qty;
    }

    /**
     * @param $type
     */
    public function setType($type)
    {
        // TODO: Implement setType() method.
        $this->type = $type;
    }

    /**
     * @param $date
     */
    public function setDateStarted($date)
    {
        // TODO: Implement setDateStarted() method.
        $this->dateStarted = $date;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        // TODO: Implement getID() method.
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        // TODO: Implement getName() method.
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getQTY()
    {
        // TODO: Implement getQTY() method.
        return $this->qty;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        // TODO: Implement getType() method.
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getDateStarted()
    {
        // TODO: Implement getDateStarted() method.
        return Carbon::parse($this->dateStarted)->format($this->date_format);
    }

    /**
     * @param int $length
     * @return string
     */
    public function generateRandomString($length = 8)
    {
        // TODO: Implement generateRandomString() method.
        $charactersLength = strlen($this->characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $this->characters[rand(0, $charactersLength - 1)];
        }

        return time().$randomString;
    }
}