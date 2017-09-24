<?php
/**
 * Created by PhpStorm.
 * User: Jaime Handayan
 * Date: 4/6/2016
 * Time: 11:39 AM
 */

namespace Hact\Checkup\Cart;


class OiItem extends Item
{
    protected $suggested_dosage;

    /**
     * OiItem constructor.
     * @param $type
     * @param $name
     * @param $suggested_dosage
     * @param $qty
     * @param $dateStarted
     */
    public function __construct( $name, $suggested_dosage,$qty, $dateStarted)
    {
        $this->type             = 'oi';
        $this->id               = $this->generateRandomString();
        $this->name             = $name;
        $this->suggested_dosage = $suggested_dosage;
        $this->qty              = $qty;
        $this->dateStarted      = $dateStarted;
    }

    /**
     * @param $suggested_dosage
     */
    public function setSuggestedDosage($suggested_dosage)
    {
        $this->suggested_dosage = $suggested_dosage;
    }

    /**
     * @return mixed
     */
    public function getSuggestedDosage()
    {
        return $this->suggested_dosage;
    }


}