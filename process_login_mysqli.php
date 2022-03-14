<?php
//Execute the code found in (database_mysqli.php to connect to the database and makes sure the script runs once).
require_once('database_mysqli.php');
  
/*------------------------------------------------------------------------------[DATABASE ACCESS]--------------------------------------------------------------------------*/

    /*[Without SQL JOIN]
        $query = "SELECT username, passwor_d, role_id FROM USERS WHERE username = ? AND passwor_d = ?"; //Use * only when you want to bind many variables to all column attribute values to be used.
    */
    //With SQL Join
    $query = "SELECT username, passwor_d, role_id, role_description FROM USERS,ROLE WHERE username = ? AND passwor_d = ? AND role_description = ? AND role_id = user_role_id"; 
         
    //Returns an object.       
    //Prepare() statement improves both database security and performance.                       
    $statement = $db->prepare($query);
    
    //Binds $user_name and $user_password.
    //Binds the value to the parameter.(string format: s, and ss since there are two string arguments)
	/*[Without SQL Join]
	    $statement->bind_param("ss",$user_name, $user_password);
	*/
	//With SQL JOIN
	$statement->bind_param("sss",$user_name, $user_password, $user_role);
	
	//Bind the columns in the result set to the variables that provide access to their values.(Binds username and passwor_d to the parameters $username, $password, $role_id)
    /*[Without SQL Join]
        $statement->bind_result($username, $password, $role_id);
    */
    //With SQL JOIN
    $statement->bind_result($username, $password, $role_id, $role_description);// Extracts the tuple values(data) and stores them into variables.(Bounded it to a memory location)
	
	//Executes the SQL statement.
	$statement->execute();

	
	//Tells if the one record is retrieved for that specific user. (Solved Problem through debugging by using echo print statement)
	//The method fetch(): copies the values from the current row into the bound variables.(Returns true(1) when user enters in correct credentials, and does not print out anything if row is not retrieved)
	$isClientCredentialsValid = $statement->fetch();
    
    
    $_SESSION['username'] = $username;
    
	//Free resources.
	$statement->close();
	
	//If the user enters in the correct credentials then the message is empty.
    $error_message = '';
	
    
	//If the credentials the user entered are correct.(Log in if the user credentials match the correct information in the database and matches the selection box)
	
	/*[This code would have to be used to verify if the user logging in is a specific user without using SQL Join. ]
	    [Without SQL Join]
	    $does_selection_match_login_info = (($user_role == 'administrator' && $role_id == 1) ||  ($user_role == 'manager'  && $role_id == 2)  || ($user_role == 'employee' && $role_id == 3) || ($user_role == 'customer' && $role_id == 4));
	    
	    SQL Join prevents if statement code from being long.(Don't need when using join) SQL takes care of it automatically.(Improves code dramtically) 
	    because we SQL automatically matches the credentials with the correct user chosen in the drop down list.(Don't have to manually check if they match)
	*/
	
	//With SQL Join.
	//Don't need long if statement.(Only need this when using SQL join)
	if($isClientCredentialsValid)
	{
	    $error_message = '';
	    $permit = "Logged in as: ";
	    $response = $username;
	    include('Homepage.php');
	}
	else 
	{
	    $error_message = 'Invalid credentials';
	    /*[DEBUGGING PURPOSES]
	        $permit = "Username not found [";
	        $response = $user_name."] or password not found: [". $user_password."] as a ".$user_role;
	    */
	    include('Login_Page.php');
	}
	
	//[DEBUGGING PURPOSES]
	echo "<p>".$permit.$response."</p>";
	
    
    //Disconnect from server.(Close Connection)
    $db->close();
    
    /*[Debugging]
        echo 'Connection to database closed!';
    */    
?>
