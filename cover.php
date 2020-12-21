<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style type="text/css">
		body{
			margin: 0;
			background-color: #ffffff;

		}

		.login{
			position: absolute;
			top: 150px;
			right: 100px;
			border-radius: 50px;
			box-shadow: 5px 5px #0B203E;
		}

    input[type=text],input[type=number]{
    width: 70%;
    height: 20px;
    border: 1px solid black;
    border-radius: 5px;
    text-align: center;
    outline: none;
  }
  .logo{
  	position: absolute;
			top: 110px;
			left: 100px;			
  }
  .create{
  	position: absolute;
			top: 600px;
			right: 210px;
			box-shadow: 5px 5px #888888;
			border-radius: 20px;
			padding: 10px 20px 10px 20px; 
			background-color: #0B203E;
			button:disabled;
  }
	</style>
</head>
<body align="center">

	<h2><font color="#0B203E">Store Management</font></h2>
	<hr>

	<table border="0" class="login">
	<tr height="400px">
			<td width="400px">
			<b>LOGIN</b><br><br><br>
			Username<br>
			<input type="text" name=""><br><br>
			Password<br>
			<input type="text" name=""><br><br>
			<input type="checkbox" name="">&nbspRemember me <br><br><br>
			<a href="#"><i><font color="black"> Forget password </font></i></a>
		    </td></tr>
	</table>

	<a href="#"><div class="create">
		<font color="white">Create an account?</font>
	</div></a>

</body>
</html>