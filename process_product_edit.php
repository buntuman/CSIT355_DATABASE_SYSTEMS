<?php

     $product_id = isset($_POST['$id']);

    if($product){
        $query = "UPDATE products SET stock = ?, price = ?, sku = ? WHERE id = ?";  
                     
        $statement = $db->prepare($query);
    
    }else{
        $error_message_check_box = 'Select a check box to modify a product';
        include('View_Products.php');
        exit();
    }
    
    //If zero then the SQL statement was a success.(Executes properly)
    $is_execution_successful = 0;
    
    
    $statement->bind_param("idii",$stock, $price, $sku, $product_id);
        
    $is_execution_successful  = $statement->execute();
    
    if($is_execution_successful)
    {
        $number_of_rows_affected = $db->affected_rows;
        echo "<p>The number of rows in the table removed: $number_of_rows_affected</p>";
        
        echo "<p>modified product:".$product_id."</p>";
    }
    else 
    {
        $error_message = $db->$error;
        echo "<p>An error occurred: $error_message</p>";
    }
?>
