<?php
    //Connect to the specified database.
    $db = new mysqli('host','username', 'password', 'database_name');
    
    //Returns null if no error has occurred.(Returns an error message if there is an error)
    $check_connection_error = $db->connect_error;
    
    //Check to see if there is a connection error to the database.
    if($check_connection_error != null){
        echo '<p>Error: Could not connect to database.$check_connection_error</p>';
        exit();
    }
    
    //This method does not free the connection to the database.(Must be done in the file that includes this)
    /*[Debugging]
        echo '<p>Connection to database is successful!</p>';
    */
?>
