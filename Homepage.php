<!DOCTYPE html>
<html>
	
	<body>
		<div id = "Links">
		        <!--To get the element value of the from the home page.(It goes through to process_login.php), so we have to retrieve it from that file if the user logs in correctly.-->
		        <?php if($user_role == 'Administrator' ||  $user_role == 'Manager'  || $user_role == 'Employee' || $user_role == 'Customer'){?> 
		            <a class = "selection"  href = "Shop_Clothing.html">Shop_Clothing</a>
		            <a class = "selection"  href = "Page7.html">Search_Products</a>
        			<a class = "selection"  href = "Cart/cart.php">Cart</a>
        			<a class = "selection"  href = "Page5.html">Create_Account</a>
		        <?php }?>
        		<?php if($user_role == 'Administrator' ||  $user_role == 'Manager'  || $user_role == 'Employee'){?>
        			<a class = "selection"  href = "Page7.html">View_Orders</a>
        		<?php }?>
                <?php if($user_role == 'Administrator' ||  $user_role == 'Manager'){?>
        			<a class = "selection"  href = "editProduct.php">Edit_Product_Information</a>
        		<?php }?>
        		<?php if($user_role == 'Administrator'){ ?>
        		    <a class = "selection"  href = "Products/addProduct.php">Add_Products</a>
        			<a class = "selection"  href = "View_Products.php">Delete_Products</a>
        			<a class = "selection"  href = "View_Users.php">View_User_Accounts</a>
        		<?php }?>
		</div>
		<p>Welcome to Holiday Apparel!</p> 
		<p>Holiday Shoes, Socks, Pants, Sweats, Hats, Shirts.</p> 
		<footer>
			<h6>&copy; 2020 by Holiday Apparel, Inc. All rights reserved</h6>
		</footer>
	</body>
</html>
<!--Note: In order to save variables from one page to another it requires the use of sessions.-->
