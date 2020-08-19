<?php
    $product_id = isset($_POST['$id']);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Login</title>
		<link type = "text/css" rel = "stylesheet" href = "CStyles/styles.css">
	</head>

	<body>
		<header>
			<h1>Edit Product</h1>
			<hr/>
		</header>
		
		<form method = "post" align = "center" action = "process_product_edit.php">
		    
		    <input name = "action" type = "hidden" value = "echo <?php $product_id?>"> 
			<p>
				<label>Stock:
				    <!--[PHP] refers to the data in the text boxes by their name attributes.-->
				    <input name = "product_stock" type = "text" placeholder = "1" required> 
				</label>
				
				<label>Price:
				    <input name = "product_price" type = "password" placeholder = "$19.99" required> 
			    </label>
			    
			    <label>sku:
				    <input name = "product_sku" type = "password" placeholder = "120938" required> 
			    </label>
			</p>
			
			<p align = "center">
				<input type = "submit" value = "Edit"/>
                <input type = "reset" value = "Clear" />
            </p>
            
            
            <?php if(!empty($error_message)){?>
			        <b class = "error" align = "center" style = "color: red;">Error:</b><?php echo $error_message; ?>
		    <?php }?>
		</form>
		
		<footer>
			<h6>&copy; 2020 by Holiday Apparel, Inc. All rights reserved</h6>
		</footer>
	</body>
</html>

