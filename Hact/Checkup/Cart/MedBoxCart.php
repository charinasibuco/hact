<?php
/**
 * Created by PhpStorm.
 * User: Jaime Handayan
 * Date: 4/5/2016
 * Time: 3:44 PM
 */

namespace Hact\Checkup\Cart;


class MedBoxCart
{
    private $items = [];
    protected $transaction_id;
    protected $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    /**
     * MedBoxCart constructor.
     */
    public function __construct(){
        $this->id = $this->generateTransctionID();
    }

    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }

    /**
     * @param null $type
     * @return array
     */
    public function getItems($type = null){
        if($type != null){
            $list = [];
            foreach($this->items as $item){
                if($item->getType() == $type){
                    $list[] = $item;
                }
            }
            return $list;
        }
        return $this->items;
    }

    /**
     * @param $id
     * @return bool
     */
    public function SearchItem( $id ){
        $list		= array();
        foreach( $this->items as $itemKey => $itemValue ){
            $list[]	= $this->items[$itemKey];
        }
        if(in_array( $id, $list ))
            return true;
        else
            false;
    }

    /**
     * @param $id
     * @return null
     */
    public function findItem($id){
        $result = null;
        foreach($this->items as $item){
            if($item->getID() == $id){
                $result = $item;
                break;
            }
        }

        return $result;
    }

    public function updateItem($id, $item){
        $result         = $this->findItem($id);
        if($item->getType() == 'arv'){
            $result->setInfectionId($item->getInfectionId());
            $result->setMedicineId($item->getMedicineId());
            $result->setName($item->getName());
            $result->setQTY($item->getQTY());
            $result->setReason($item->getReason());
            $result->setPrescriptionSpecify($item->getPrescriptionSpecify());
            $result->setPrescriptionSpecify($item->getDateStarted());
            $result->setDateDiscontinue($item->getDateDiscontinue());
        }elseif($item->getType() == 'oi' || $item->getType() == 'others'){
            $result->setName($item->getName());
            $result->setSuggestedDosage($item->getSuggestedDosage());
            $result->setQTY($item->getQTY());
            $result->setDateStarted($item->getDateStarted());
        }


    }



    /**
     * @param $item
     */
    public function addItem($item){
        $q = false;

        //if item already in cart update the quantity
        foreach( $this->items as $itemKey => $itemValue ){
            if( $this->items[$itemKey]->getID() == $item->getID() ){
                $this->items[$itemKey]->setQTY( $this->items[$itemKey]->getQty() + $item->getQTY() );
                $q				= true;
                break;
            }
        }

        //if item not in cart add the item to cart
        if(!$q)
            $this->items[] = $item;
    }

    /**
     * @param $itemID
     */
    public function removeItem( $itemID ){
        $return = false;
        foreach( $this->items as $itemKey => $itemValue ){
            if( $this->items[$itemKey]->getID() == $itemID ){
                unset($this->items[$itemKey]);
                $return = true;
                break;
            }
        }

        return $return;
    }

    /**
     * @param $itemID
     */
    public function addQty( $itemID ){
        foreach($this->items as $itemKey => $itemValue){
            if( $this->items[$itemKey]->getID() == $itemID ){
                $this->items[$itemKey]->setQTY($this->items[$itemKey]->getQTY() + 1);
                break;
            }
        }
    }

    /**
     * @param $itemID
     */
    public function minusQty( $itemID ){
        foreach( $this->items as $itemKey => $itemValue ){
            if( $this->items[$itemKey]->getID() == $itemID ){
                $this->items[$itemKey]->setQTY( $this->items[$itemKey]->getQTY() - 1 );
                if( $this->items[$itemKey]->getQTY() <= 0 )
                    $this->removeItem($itemID);
                break;
            }
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function ItemQtyEach( $id ){
        foreach( $this->items as $itemKey => $itemValue ){
            if( $this->items[$itemKey]->getID() == $id ){
                return $this->items[$itemKey]->getQTY();
            }
        }
    }

    /**
     * @param int $length
     * @return string
     */
    public function generateTransctionID($length = 8)
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