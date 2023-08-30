<?php
require 'auth.php';
?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="css/login.css" />
	<title>E-Learning</title>
</head>

<body>
	<div class="container">
		<div class="forms-container">
			<div class="signin-signup">
				<form action="" method="post" class="sign-in-form">
					<h2 class="title">Masuk</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" name="username" placeholder="Username" required />
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" name="password" placeholder="Kata Sandi" required />
					</div>
					<button type="submit" name="signIn" class="btn">Masuk</button>
				</form>
				<form action="" method="post" class="sign-up-form">
					<h2 class="title">Daftar</h2>
					<div class="form-check form-check-inline text-white">
						<input class="form-check-input" type="radio" name="user" id="guru" value="Guru" required>
						<label for="guru" style="color: white; margin-right: 20px;">Guru</label>
						<input class="form-check-input" type="radio" name="user" id="siswa" value="Siswa" required>
						<label for="siswa" style="color: white;">Siswa</label>
					</div>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" name="id" placeholder="NIS/NIP" required />
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" name="password" placeholder="Password" required />
					</div>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" name="nama" placeholder="Nama Lengkap" required />
					</div>
					<div class="input-field">
						<i class="fa fa-venus-mars"></i>
						<input type="text" name="jk" placeholder="Jenis Kelamin (L/P)" required />
					</div>
					<div class="input-field">
						<i class="fab fa-whatsapp"></i>
						<input type="text" name="wa" placeholder="Whatsapp" required />
					</div>
					<div class="input-field">
						<i class="fas fa-map-marker"></i>
						<input type="text" name="alamat" placeholder="Alamat" required />
					</div>
					<button type="submit" name="signUp" class="btn">Daftar</button>
				</form>
			</div>
		</div>
		<div class="panels-container">
			<div class="panel left-panel">
				<div class="d-flex flex-column justify-content-center align-items-center" style="height: 100%; width: 100%;">
					<img src="img/logo.png" class="image" alt="" width="100%" height="200px" style="object-fit: contain;" />
					<p class="text-left">E-Learning SDN paulan colomadu Berbasis Web</p>
				</div>
				<!-- <h3>Belum Punya Akun ?</h3>
				<button class="btn transparent" id="sign-up-btn">Daftar</button> -->

				<img src="img/log.svg" class="image" alt="" />
			</div>
			<div class="panel right-panel">
				<div class="content">
					<h3>Have Account ?</h3>
					<p>E-Learning SD N paulan colomadu Berbasis Web</p>
					<button class="btn transparent" id="sign-in-btn">Masuk</button>
				</div>
				<img src="img/logo.png" class="image" alt="" width="100%" height="250px" />
			</div>
		</div>
	</div>
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
	<script src="js/login.js"></script>
</body>

</html>