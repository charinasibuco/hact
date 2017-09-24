<?php
/**
 * Created by PhpStorm.
 * User: Jaime Handayan
 * Date: 4/5/2016
 * Time: 5:00 PM
 */
namespace Hact\Checkup\Cart;

interface ItemInterface{

    public function setID($id);

//    public function setPatientID($id);

    public function setName($name);

    public function setQTY($qty);

    public function setType($type);

    public function setDateStarted($date);

    public function getID();

//    public function getPatientID();

    public function getName();

    public function getQTY();

    public function getType();

    public function getDateStarted();

    public function generateRandomString($length = 8);
}