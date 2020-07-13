<?php
//Execute the code found in (database_mysqli.php to connect to the database and makes sure the script runs once).
require_once('database_mysqli.php');

    /*
        Code is referenced from Murachs PHP and MySQL.    
    */
    //[WHERE database_column_data = :user_entered_data]
    $query = 'SELECT role_id, user_id, username, passwor_d, firstName, lastName, email, user_id FROM USERS ORDER BY role_id';
    
    //Prepare the statement
    $statement = $db->prepare($query);
    
    //Bind the columns in the result set to variables that will access there values.(Used when Displaying Information of each user)
    $statement ->bind_result($role_id,$user_id,$username,$password, $firstName, $lastName, $email, $user_id);
    
    $statement ->execute();
    
    //Holds the usertype to display the type of the user.(Ex: Administrator, Manager, Employee, Customer)
    $userType = ["Administrator","Manager","Employee","Customer"];
    
    /*[For the forms input]
        The name attribute for the forms will all be the same.
        PHP allows to combine the values of multiple checkboxes into a single array.(The same name is used for all related checkboxes)
        Indicated with a bracket[] to show that check boxes  will be stored in an array.(Ex: name = 'user_role[]')
        
        When the form data is submitted, PHP creates an array when it reads the first check box name that ends with a bracket.Then it adds the value stored in the inputs value attribute(check box) to the array.
        
        If there is another checkbox, it will append that value to the array.(Once done PHP will nest the array within the $_GET or $_POST array)
        
        The values in the inputs for the checkboxes is used to identify the checkbox and indicate that it is checked.(This value corresponds to the primary key of the data in the database. For example: user_id)
        
        Each user has a unique user_id, so this is good for the value attribute.(The value can be used to obtain more information about the selected textbox)
        
    */
    
echo 
"<!DOCTYPE html>
<html>
	<head>
	  <meta charset = 'utf-8'>
		<title>Holiday Apparel Homepage</title>
		<link type = 'text/css' rel = 'stylesheet' href = 'CStyles/styles.css'>
	</head>

	<body>
		<main>
		  <h1 style = 'text-align: center;'>All User Accounts</h1>
	
		  <form method = 'post' align = 'center' action = 'Delete_User.php'>
    		  <table style = 'font-size: 20px;' border = '1'>
    		  <tr>
    		    <a class = 'selection'  href = 'Homepage.php'>Go Home</a>
    		    <td>select</td>
    		    <td><b>User<b></td>
    		    <td><b>username<b></td>
    		    <td><b>password<b></td>
    		    <td><b>firstname<b></td>
    		    <td><b>lastname<b></td>
    		    <td><b>email<b></td>
    		    <td><b>user_id<b></td>
    		  </tr>
    		  <tbody>";
    		  while($statement->fetch()):
    		  {
    		      if($userType[$role_id - 1] != $userType[0]){
        		  echo "<tr>".
        		         "<td><input type = 'checkbox' name = 'user_role[]' value = '".$user_id."'></td>".
        		         "<td style = 'color: blue;'>".$userType[$role_id - 1]."</td>".
        		         "<td>".$username."</td>".
        		         "<td>".$password."</td>".
        		         "<td>".$firstName."</td>".
        		         "<td>".$lastName."</td>".
        		         "<td>".$email."</td>".
        		         "<td>".$user_id."</td>".
        		       "</tr>";
    		      }else
    		      echo "<tr>".
    		             "<td></td>".
        		         "<td style = 'color: blue;'>".$userType[$role_id - 1]."</td>".
        		         "<td>".$username."</td>".
        		         "<td>".$password."</td>".
        		         "<td>".$firstName."</td>".
        		         "<td>".$lastName."</td>".
        		         "<td>".$email."</td>".
        		         "<td>".$user_id."</td>".
        		       "</tr>";
        		  
    		  }endwhile;
    		  echo
              "</tbody>
              </table>";
              
    		  if(!empty($error_message_check_box)){
		        echo "<table><tr><td></td></tr></table><b class = 'error' style = 'color: red; text-align: center;'>Error: </b><b style = 'text-align: center;'> Must select a check box to delete a user</b>";
	          }
	          
	          echo 
    		  "<p align = 'center'>
			        <input type = 'submit' value = 'Delete'/>
                    <input type = 'reset' value = 'Deselect all'/>
              </p>
    	   </form>
		</main>
		
		<footer>
			<h6>&copy; 2020 by Holiday Apparel, Inc. All rights reserved</h6>
		</footer>
	</body>
</html>";

        
    //Disconnect from server.
    $db->close();
?>
