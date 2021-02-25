<?php

/* model/data-layer.php
 * returns data for my app
 *
 */

class DataLayer
{
    private $_dbh;

    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    /* Return all of the rows in the db orders table */
    function getOrders()
    {
        //Define the query
        $sql = "SELECT * FROM orders";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters

        //Execute
        $statement->execute();

        //Get the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);
        return $result;
    }

    function saveOrder($order)
    {
        //var_dump($order);
        //echo "<p>Saving order</p>";

        //Define the query
        $sql = "INSERT INTO orders(food, meal, condiments) 
	            VALUES (:food, :meal, :condiments)";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':food', $order->getFood(), PDO::PARAM_STR);
        $statement->bindParam(':meal', $order->getMeal(), PDO::PARAM_STR);
        $statement->bindParam(':condiments', $order->getCondiments(), PDO::PARAM_STR);

        //Execute
        $statement->execute();
        $id = $this->_dbh->lastInsertId();
    }

    /** getMeals() returns an array of meals
     *  @return array
     */
    function getMeals()
    {
        return array("breakfast", "2nd breakfast", "lunch", "dinner");
    }

    /** getCondiments() returns an array of condiments
     *  @return array
     */
    function getCondiments()
    {
        return array("ketchup", "mustard", "kim chi", "sriracha", "mayo");
    }
}

