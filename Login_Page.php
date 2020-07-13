<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Login</title>
		<link type = "text/css" rel = "stylesheet" href = "CStyles/styles.css">
	</head>

	<body>
		<header>
			<h1>Login</h1>
			<hr/>
		</header>
		
		<form method = "post" align = "center" action = "process_login_mysqli.php">
		    
		    <input name = "action" type = "hidden" value = "login"> 
			<p>
				<label>Username:
				    <!--[PHP] refers to the data in the text boxes by their name attributes.-->
				    <input name = "user_name" type = "text" placeholder = "username" required> 
				</label>
				
				<label>Password:
				    <input name = "user_password" type = "password" placeholder = "password" required> 
			    </label>
			</p>
			
			<script type = "text/javascript" src = "JavaScript_scripts/display_user_types.js"></script>
			
			<p align = "center">
				<input type = "submit" value = "Login"/>
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

<!--
        [Input Text Boxes in Forms]

        When a form contains controls such as: text boxes(text fields), password boxes(password fields), hidden fields, it is submitted to a server, and its passed in as an array of name/value pairs.

            Ex: <input name = "user_name"> 
        
        When the user enters into the text field some text like [myname], that value is paired with the name attribute [user_name] of the input. (user_name: myname)
        
        Good practice to make PHP variable the same name as the name when passing the data to a PHP script. (name = user_name), so make a variable called $user_name. (Good practice)
        
        The method of sending password and username information should be done through using POST because its more secure for sensitive data.(GET method displays the data in the URL which is BAD!!!)
        ==============================================================================================================================================================================================
        
        [Drop Down Lists]
        
        When the page is submitted to the server, the value attributes specifies the value that is submitted to the server.
        
        A name/value pair will always be submitted to a server, don't need to check filter_input or if its NULL.
        
        <select name = "user_role">
            <option value = "administrator">Administrator</option>
            <option value = "manager">Manager</option>
            <option value = "employee">Employee</option>
            <option value = "customer">Customer</option>
        </select>
-->
