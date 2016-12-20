<?php
session_start();
if(isset($_SESSION['login']))
header('Location: ../EditModeCalendar');

if(isset($_GET["wrong"]))
{
	?>
	<script>
		alert("username or password incorrect")
	</script>
	
	<?php
}

?>












<form name="myForm" method="post" action="validate.php" onsubmit="return validateForm()">
  <h2><span class="entypo-login"></span> Login</h2>
  <button class="submit"><span class="entypo-lock"></span></button>
  <span class="entypo-user inputUserIcon"></span>
			<input type="text" class="user" placeholder="username" name="uid" id="uid"/>
  <span class="entypo-key inputPassIcon"></span>
			<input type="password" class="pass" placeholder="password" name="pass" id="pass"/>
</form>

<style>
@import url(http://weloveiconfonts.com/api/?family=entypo);
@import url(http://fonts.googleapis.com/css?family=Roboto);

/* zocial */
[class*="entypo-"]:before {
  font-family: 'entypo', sans-serif;
  color:rgba(255,255,255,.8);
}

*,
*:before,
*:after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box; 
}


h2 {
  margin-left:12px;
  color: #7f8c8d;
}

body {
  background-image: url(../images/background.jpg);
  background-size: cover;
  background-position: center;
  font-family: 'Roboto', sans-serif;
  
}

form {
  position:relative;
  margin: 50px auto;
  width: 395px;
  height: auto;
  background:rgba(189, 195, 199, 0.64);
  border-radius: 5px;
  padding: 0px 15px 15px 5px;
  margin-top: 12%;
}

input {
  padding: 16px;
  border-radius:7px;
  border:0px;
  background: rgba(255,255,255,.2);
  display: block;
  margin: 15px;
  width: 300px;  
  color:white;
  font-size:18px;
  height: 54px;
}

input:focus {
  outline-color: rgba(0,0,0,0);
  background: rgba(255,255,255,.95);
  color: #e74c3c;
}

button {
  float:right;
  height: 121px;
  width: 50px;
  border: 0px;
  background: #e74c3c;
  border-radius:7px;
  padding: 10px;
  color:white;
  font-size:22px;
}

.inputUserIcon {
  position:absolute;
  top:68px;
  right: 80px;
  color:white;
}

.inputPassIcon {
  position:absolute;
  top:136px;
  right: 80px;
  color:white;
}

input::-webkit-input-placeholder {
  color: white;
}

input:focus::-webkit-input-placeholder {
  color: #e74c3c;
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<script>

$(".user").focusin(function(){
  $(".inputUserIcon").css("color", "#e74c3c");
}).focusout(function(){
  $(".inputUserIcon").css("color", "white");
});

$(".pass").focusin(function(){
  $(".inputPassIcon").css("color", "#e74c3c");
}).focusout(function(){
  $(".inputPassIcon").css("color", "white");
});


//no-repeat center fixed; 
    // background-size: cover;
</script>
<script>
						function validateForm() {
							var x = document.forms["myForm"]["uid"].value;
							var y = document.forms["myForm"]["pass"].value;
							if (x == null || x == "") {
								alert("Name must be filled out");
								return false;
							}
							 if (x == null || x == "") {
								alert("Name must be filled out");
								return false;
							}
						}
</script>