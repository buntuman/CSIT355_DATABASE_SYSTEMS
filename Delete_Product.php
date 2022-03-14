<?php
//Execute the code found in (database_mysqli.php to connect to the database and make sure the script runs once).
require_once('database_mysqli.php');

    //Get all elements in the specified array and apply a filter to make them safe to use.
    //(FILTER_REQUIRE_ARRAY constant ensures the function gets the array correctly otherwise if you don't it won't get the array correctly)
    //(FILTER_SANITIZE_SPECIAL_CHARS constant replaces special characters (such as: <and> with HTML entities)to guard against xss attacks.(Script injections are malicious)
    $product_names = filter_input(INPUT_POST, 'product_names', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
    
    /*
        Must prevent the whole table from being deleted by not allowing the WHERE clause to be empty.
        To circumvend this we need to check if the array contains at least one value.(Can't be identical or of the same type as null)
        Otherwise it will delete the entire table.(Prevents administrator from accidentally deleting all accounts)
    */
    //Check to see if array contains atleast one item.(Protects against an empty array, therefore protecting against all tables from being deleted)
    if($product_names !== NULL){
        $query = "DELETE FROM products WHERE id = ?";                       
        $statement = $db->prepare($query);
    
        
    }else{
        $error_message_check_box = 'Select a checkbox to delete a product';
        include('View_Products.php');
        exit();
    }
    
    /*
        Loop the entire array user_types to bind to the parameter and delete each one that has the same values.
        Ex: User_id[0] = 10000 ,User_id[1] = 10001 
    */
    //If zero then the SQL statement was a success.(Executes properly)
    $is_execution_successful = 0;
    
    //Key starts at the value 0..to the last index of the array.(value is the value stored at that specific index.Association)
    //(EX: [$key:0, $value: role_id])
    foreach($product_names as $key => $value)
    {
        //Binds values to the parameters.
        //Binds the value to the parameter.(string format: s since there is one string argument)
        $statement->bind_param("s",$value);
        
        //Executes the SQL statement.(Updates the data, but does not return a result set)
        $is_execution_successful  = $statement->execute();
    }
    
    //Check to make sure that the SQL operation was successful.
    if($is_execution_successful)
    {
        //Get number of affected rows.
        $number_of_rows_affected = $db->affected_rows;
        echo "<p>The number of rows in the table removed: $number_of_rows_affected</p>";
        
        /*[Used to display the key and value of the selected user]*/
        //Key starts at the value 0..to the last index of the array.(value is the value stored at that specific index.Association)
        //(EX: [$key:0, $value: role_id])
        foreach($product_names as $key => $value):
            echo "<p>Removed id:".$value."</p>";
        endforeach;
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
