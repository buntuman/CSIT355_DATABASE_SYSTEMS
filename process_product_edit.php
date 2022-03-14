<?php

     $product_id = isset($_POST['$id']);

    if($product){
        $query = "UPDATE products SET stock = ?, price = ?, sku = ? WHERE id = ?"; //Use * only when you want to bind many variables to all column attribute values to be used.
                     
        $statement = $db->prepare($query);
    
    }else{
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
