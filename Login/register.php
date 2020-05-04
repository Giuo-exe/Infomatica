

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="css/styleRegister.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="img/waveR.png">
	<div class="container">
		<div class="login-content">
			<form action="regi.php" Method="POST">
				<h2 class="title">Registrati</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="username">
           		   </div>
                </div>
                <div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Nome</h5>
           		   		<input type="text" class="input" name="nome">
           		   </div>
							 </div>
								 <div class="input-div one">
            		   <div class="i">
            		   		<i class="fas fa-user"></i>
            		   </div>
            		   <div class="div">
            		   		<h5>Cognome</h5>
            		   		<input type="text" class="input" name="cognome">
            		   </div>
           		</div>
							<div class="input-div one">
								<div class="i">
									 <i class="fas fa-user"></i>
								</div>
								<div class="div">
									 <h5>E-mail</h5>
									 <input type="text" class="input" name="email">
								</div>
					 </div>
           		<div class="input-div pass">
           		   <div class="i">
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="password">
            	   </div>
                </div>
                <div class="input-div pass">
           		   <div class="i">
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Conferma Password</h5>
           		    	<input type="password" class="input" name="conpassword">
            	   </div>
							 </div>
							 <div class='radio-group'>
								 <ul>
								  <li>
								    <input type="radio" id="f-option" name="ruolo" value="studente">
								    <label for="f-option">Studente</label>

								    <div class="check"></div>
								  </li>

								  <li>
								    <input type="radio" id="s-option" name="ruolo" value="professore">
								    <label for="s-option">Professore</label>

								    <div class="check"><div class="inside"></div></div>
								  </li>
								</ul>
							</div>

								<div class="input-div one">
	           		   <div class="i">
	           		   		<i class="fas fa-user"></i>
	           		   </div>
	           		   <div class="div">
	           		   		<h5>Classe (facoltativo)</h5>
	           		   		<input type="text" class="input" name="classe">
	           		   </div>
	                </div>

				<input type="submit" class="btn" value="Register">
				<a href="index.php">Hai già un account? Accedi</a>
			</form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
