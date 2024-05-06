<?php
include 'koneksi.php';
session_start();
 
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = ($_POST['password']); // Hash the input password using SHA-256
 
    $sql = "SELECT * FROM petugas WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
 
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Update last_login field in the database with current timestamp
        $update_sql = "UPDATE petugas SET last_login=NOW() WHERE username='$username'";
        mysqli_query($conn, $update_sql);
        
        $_SESSION['username'] = $row['username'];
        header("Location: dashboard.php"); // Redirect to dashboard.php
        exit();
    } else {
        echo "<script>alert('username atau password Anda salah. Silakan coba lagi!')</script>";
    }
}
?>
<!DOCTYPE html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    width: 100%;
    min-height: 100vh;
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(img/dark.jpg);
    background-position: center;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Poppins', sans-serif;
    color: #111;
}

.container {
    width: 400px;
    min-height: 400px;
    background: transparent; /* Mengatur latar belakang transparan */
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    padding: 40px 30px;
}

.container-logout {
    width: 500px;
    min-height: 200px;
    background: rgba(255, 255, 255, 0.8); /* Mengatur opasitas warna latar belakang */
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    padding: 40px 30px;
}


h1 {
    font-weight: 500;
    font-size: 1.1rem;
    text-align: center;
    margin-bottom: 20px;
    display: block;
    text-transform: capitalize;
}

.input-group {
    width: 100%;
    margin-bottom: 25px;
}

.input-group input {
    width: 100%;
    height: 50px;
    border: 2px solid #e7e7e7;
    padding: 15px 20px;
    font-size: 1rem;
    border-radius: 30px;
    background: transparent;
    outline: none;
    transition: 0.3s;
}

.input-group input:focus, .input-group input:valid {
    border-color: #a29bfe;
}

.input-group .btn {
    display: block;
    width: 100%;
    padding: 15px 20px;
    text-align: center;
    border: none;
    background: #56caff;
    outline: none;
    border-radius: 30px;
    font-size: 1.2rem;
    color: #5a6de6;
    cursor: pointer;
    transition: 0.3s;
}

.input-group .btn:hover {
    transform: translateY(-5px);
    background: #20c9a6;
}

.login-register-text,
.login-register-text a {
    color: #20c9a6;
    font-weight: 600;
    text-decoration: #36b9cc;
}

.login-register-text a {
    color: #20c9a6;
}

@media (max-width: 430px) {
    .container {
        width: 300px;
    }
}

</style>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="img/j.png">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-username">
        <center>
    <img src="img/TJ.png">
    <p class="login-text" style="font-size: 2rem; font-weight: 800; color: purple;">Login</p>
</center>
            <div class="input-group">
                <input type="username" placeholder="username" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
        </form>
    </div>
</body>
</html>