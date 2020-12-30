<?php
require_once "CartItem.php";
require_once "DBAccess.php";

class ShoppingCart
{
    private $_cartItems = [];
    private $_shoppingOrderId;

    public function count()
    {
        return count($this->_cartItems);
    }

    public function setShoppingOrderID($id)
    {
        $this->_shoppingOrderId = (int)$id;
    }

    public function getItems()
    {
        return $this->_cartItems;
    }

    public function addItem($cartItem)
    {
        $found = $this->inCart($cartItem);
        if($found != null)
        {
            $this->updateItem($cartItem);
        }
        else
        {
            $this->_cartItems[] = $cartItem;
        }
    }

    public function updateItem($cartItem)
    {
        $index = $this->itemIndex($cartItem);

        $oldQty = $this->_cartItems[$index]->getQuantity();
        $additionalQty = $cartItem->getQuantity();

        $newQty = $oldQty + $additionalQty;

        $this->_cartItems[$index]->setQuantity($newQty);
    }

    public function removeItem($cartItem) 
    {
        $index = $this->itemIndex($cartItem);

        if($index >= 0)
        {
            unset($this->_cartItems[$index]);
            $this->_cartItems = array_values($this->_cartItems);
        }
    }

    public function calculateTotal()
    {
        $total = 0.0;
        
        foreach ($this->_cartItems as $item) 
        {
            $total += $item->getQuantity() * $item->getPrice();
        }
        
        return $total;
    }

    public function saveCart($Address, $ContactNumber, $CreditCardNumber, $CSV, $Email, $ExpiryDate, $FirstName, $LastName, $NameOnCard) 
    {
        include "settings/db.php";
        $db=new DBAccess($dsn, $username, $password);
        $pdo = $db->connect();
        
        $sql = "insert into shoppingorder (Address, ContactNumber, CreditCardNumber, CSV,
        Email, ExpiryDate, FirstName, LastName, NameOnCard, OrderDate) values(:Address,
        :ContactNumber, :CreditCardNumber, :CSV, :Email, :ExpiryDate, :FirstName, :LastName,
        :NameOnCard, curdate())";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(":Address" , $Address, PDO::PARAM_STR);
        $stmt->bindValue(":ContactNumber" , $ContactNumber, PDO::PARAM_STR);
        $stmt->bindValue(":CreditCardNumber" , $CreditCardNumber, PDO::PARAM_STR);
        $stmt->bindValue(":CSV" , $CSV, PDO::PARAM_STR);
        $stmt->bindValue(":Email" , $Email, PDO::PARAM_STR);
        $stmt->bindValue(":ExpiryDate" , $ExpiryDate, PDO::PARAM_STR);
        $stmt->bindValue(":FirstName" , $FirstName, PDO::PARAM_STR);
        $stmt->bindValue(":LastName" , $LastName, PDO::PARAM_STR);
        $stmt->bindValue(":NameOnCard" , $NameOnCard, PDO::PARAM_STR);

        $shoppingOrderID = $db->executeNonQuery($stmt, true);

        foreach ($this->_cartItems as $item)
        {
            $sql = "insert into orderitem (ItemID, Price, Quantity, shoppingOrderID)
            values(:ItemID, :Price, :Quantity, :shoppingOrderID)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":ItemID" , $item->getItemId(), PDO::PARAM_INT);
            $stmt->bindValue(":Price" , $item->getPrice(), PDO::PARAM_STR);
            $stmt->bindValue(":Quantity" , $item->getQuantity(), PDO::PARAM_INT);
            $stmt->bindValue(":shoppingOrderID" , $shoppingOrderID, PDO::PARAM_INT);
            $db->executeNonQuery($stmt);
        }
        return $shoppingOrderID;
    }

    private function inCart($cartItem) 
    {
        $found = null;

        foreach ($this->_cartItems as $item) 
        {
            if($item->getItemId() == $cartItem->getItemId())
            {
                $found = $item;
            }
        }
        return $found;
    }

    private function itemIndex($cartItem)
    {
        $index = -1;

        for($i=0; $i<$this->count(); $i++)
        {
            if($cartItem->getItemId() == $this->_cartItems[$i]->getItemId())
            {
                $index = $i;
            }
        }
        return $index;
    }

    public function displayArray() 
    {
        print_r($this->_cartItems);
    }
}

?>