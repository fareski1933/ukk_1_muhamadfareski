<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login</title>

<style>
body {
    margin: 0;
    height: 100vh;
    background: linear-gradient(135deg,#1e3c72,#2a5298);
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
}

/* BOX LOGIN */
.box {
    background: #ffffff;
    padding: 35px 30px;
    width: 340px;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    text-align: center;
    animation: fadeIn 0.6s ease-in-out;
}

/* LOGO */
.logo {
    width: 70px;
    margin-bottom: 10px;
}

.title {
    font-size: 14px;
    color: #777;
    margin-bottom: 15px;
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

/* INPUT */
input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: 14px;
    transition: 0.3s;
}

input:focus {
    outline: none;
    border-color: #2a5298;
    box-shadow: 0 0 5px rgba(42,82,152,0.3);
}

/* BUTTON */
button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(90deg,#ff9800,#ffb74d);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 10px;
    transition: 0.3s;
}

button:hover {
    background: linear-gradient(90deg,#fb8c00,#ffa726);
    transform: scale(1.03);
}

/* LINK */
.link {
    margin-top: 15px;
    font-size: 14px;
}

.link a {
    color: #2a5298;
    text-decoration: none;
    font-weight: bold;
}

/* ANIMATION */
@keyframes fadeIn{
    from{opacity:0; transform:translateY(20px);}
    to{opacity:1; transform:translateY(0);}
}
</style>
</head>

<body>

<div class="box">

    <!-- LOGO ALAT -->
    <img src="https://cdn-icons-png.flaticon.com/512/3079/3079165.png" class="logo">

    <div class="title">Sistem Peminjaman Alat</div>

    <h2>Login</h2>

    <form method="POST" action="../controllers/c_reglog.php?aksi=login">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <div class="link">
        Tidak memiliki akun?
        <a href="registrasi.php">Daftar</a>
    </div>

</div>

</body>
</html>
