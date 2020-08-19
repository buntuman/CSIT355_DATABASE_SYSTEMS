<?php
//Execute the code found in (database_mysqli.php to connect to the database and makes sure the script runs once).
require_once('database_mysqli.php');

    /*
        Code is referenced from PHP and MYSQL Murach's.
    */

    //Get all elements in the specified array and apply a filter to make them safe to use.
    //(FILTER_REQUIRE_ARRAY constant ensures the function gets the array correctly otherwise if you don't it won't get the array correctly)
    //(FILTER_SANITIZE_SPECIAL_CHARS constant replaces special characters (such as: <and> with HTML entites)to guard against xss attacks.(Script injections are malicious)
    $product_id = isset($_POST['$id']);
    
    //Check to see if it is set.(Protects)
    if($product){
        //Prepared statements improve the performance and security of the application.(Use whenever possible)
        //Uses ? for parameters.[WHERE database_column_data = :user_entered_data]
        $query = "UPDATE products SET stock = ?, price = ?, sku = ? WHERE id = ?"; //Use * only when you want to bind many variables to all column attribute values to be used.
        
        //Returns an object.       
        //Prepare() statement improves both database security and performance.                       
        $statement = $db->prepare($query);
    
        
    }else{
        //Error occurs when the user selects delete and does not select any check box.
        //Error message that will be displayed to the user on the view users page.
        $error_message_check_box = 'Select a check box to modify a product';
        include('View_Products.php');
        exit();
    }
    
    //If zero then the SQL statement was a success.(Executes properly)
    $is_execution_successful = 0;
    
    //Binds values to the parameters.
    //Binds the value to the parameter.(string format: s since there is one string argument)
    $statement->bind_param("idii",$stock, $price, $sku, $product_id);
        
    //Executes the SQL statement.(Updates the data, but does not return a result set)
    $is_execution_successful  = $statement->execute();
    
    //Check to make sure that the SQL operation was successful.
    if($is_execution_successful)
    {
        //Get number of affected rows.
        $number_of_rows_affected = $db->affected_rows;
        echo "<p>The number of rows in the table removed: $number_of_rows_affected</p>";
        
        echo "<p>modified product:".$product_id."</p>";
    }
    else 
    {
        $error_message = $db->$error;
        echo "<p>An error occurred: $error_message</p>";
    }
    
    //Free the resources.
    $statement->close();
    
    //Disconnect from server.
    $db->close();
?>
