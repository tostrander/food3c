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

    function saveOrder($order)
    {
        var_dump($order);
        //echo "<p>Saving order</p>";

        //Define the query
        $sql = "INSERT INTO orders(food, meal, condiments) 
	            VALUES (:food, :meal, :condiments)";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);
/*
        //Bind the parameters
        $type = 'kangaroo';
        $name = 'Joey';
        $color = 'purple';
        $statement->bindParam(':type', $type, PDO::PARAM_STR);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':color', $color, PDO::PARAM_STR);

        //Execute
        $statement->execute();
        $id = $dbh->lastInsertId();
        echo "<p>kangaroo added:  ID $id!</p>";
*/
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

