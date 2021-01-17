<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
</head>
<body>

	<form method="get" action="<?php echo base_url("Cart/checkLogin"); ?>">
		<label>Email</label>
		<input type="email" name="Email">
		<label>Password</label>
		<input type="password" name="Password">
		<button type="submit">log in</button>
	</form>

</body>
</html>