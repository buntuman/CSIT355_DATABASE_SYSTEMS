<?php
    
    //With SQL Join
    $query = "SELECT username, passwor_d, role_id, role_description FROM USERS,ROLE WHERE username = ? AND passwor_d = ? AND role_description = ? AND role_id = user_role_id"; 
    
    //Binds the value to the parameter.(string format: s, and ss since there are two string arguments)
	
	// With SQL JOIN
	$statement->bind_param("sss",$user_name, $user_password, $user_role);
	
	//Bind the columns in the result set to the variables that provide access to their values.(Binds username and passwor_d to the parameters $username, $password, $role_id)
    //With SQL JOIN
    $statement->bind_result($username, $password, $role_id, $role_description);// Extracts the tuple values(data) and stores them into variables.(Bounded it to a memory location)
	
?>
