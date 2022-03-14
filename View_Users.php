<?php

    $query = 'SELECT role_id, user_id, username, passwor_d, firstName, lastName, email, user_id FROM USERS ORDER BY role_id';
    
    $statement = $db->prepare($query);
    
    $statement ->bind_result($role_id,$user_id,$username,$password, $firstName, $lastName, $email, $user_id);
    
    $statement ->execute();

    $userType = ["Administrator","Manager","Employee","Customer"];
    
    
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


    $db->close();
?>
