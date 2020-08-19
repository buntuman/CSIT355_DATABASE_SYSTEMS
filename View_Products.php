<?php
//Execute the code found in (database_mysqli.php to connect to the database and make sure the script runs once).
require_once('database_mysqli.php');

    /*
        Code is referenced from Murachs PHP and MySQL.    
    */
    //[WHERE database_column_data = :user_entered_data]
    $query = 'SELECT id, name, holiday, type, description, stock, price, sku FROM products ORDER BY sku';
    
    //Prepare the statement
    $statement = $db->prepare($query);
    
    //Bind the columns in the result set to variables that will access there values.(Used when Displaying Information of each user)
    $statement ->bind_result($id,$name,$holiday,$type, $description, $stock, $price, $sku);
    
    $statement ->execute();
    
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
		  <h1 style = 'text-align: center;'>All Products</h1>
	
		  <form method = 'post' align = 'center' action = 'editProductInfo.php'>
    		  <table style = 'font-size: 20px;' border = '1'>
    		  <tr>
    		    <a class = 'selection'  href = 'Homepage.php'>Go Home</a>
    		    <td>select</td>
    		    <td><b>Name<b></td>
    		    <td><b>Holiday<b></td>
    		    <td><b>Type<b></td>
    		    <td><b>Description<b></td>
    		    <td><b>Stock<b></td>
    		    <td><b>Price<b></td>
    		    <td><b>SKU<b></td>
    		  </tr>
    		  <tbody>";
    		  while($statement->fetch()):
    		  {
        		  echo "<tr>".
        		         "<td><input type = 'checkbox' name = '".$id."'></td>".
        		         "<td style = 'color: blue;'>".$name."</td>".
        		         "<td>".$holiday."</td>".
        		         "<td>".$type."</td>".
        		         "<td>".$description."</td>".
        		         "<td>".$stock."</td>".
        		         "<td>".$price."</td>".
        		         "<td>".$sku."</td>".
        		       "</tr>";
    		  }endwhile;
    		  echo
              "</tbody>
              </table>";
              
    		  if(!empty($error_message_check_box)){
		        echo "<table><tr><td></td></tr></table><b class = 'error' style = 'color: red; text-align: center;'>Error: </b><b style = 'text-align: center;'> Must select a check box to delete a product</b>";
	          }
	          
	          echo 
    		  "<p align = 'center'>
			        <input type = 'submit' value = 'Edit'/>
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
