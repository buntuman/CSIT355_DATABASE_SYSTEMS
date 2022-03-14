<?php
    $query = 'SELECT id, name, holiday, type, description, stock, price, sku FROM products ORDER BY sku';
    
    $statement = $db->prepare($query);
    
    $statement ->bind_result($id,$name,$holiday,$type, $description, $stock, $price, $sku);
    
    $statement ->execute();
    
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
	
		  <form method = 'post' align = 'center' action = 'Delete_Product.php'>
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
        		         "<td><input type = 'checkbox' name = 'product_names[]' value = '".$id."'></td>".
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
