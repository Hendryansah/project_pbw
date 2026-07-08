<?php

    session_start();

    require '../../config/koneksi.php';

    if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT password FROM pengguna WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if ( $row = mysqli_fetch_assoc($result) ) {
            if ( password_verify($password, $row['password']) ) {
                $_SESSION['login'] = true;
                $_SESSION['username'] = $username;
                header('Location: ../../index.php');
                exit;
            } else {
                echo "Password tidak sesuai";
            }
        } else {
            echo "Username tidak ditemukan.";
        }
    }

?>

<?php include '../../includes/header.php'; ?>
    
    <main class="position-fixed top-50 start-50 translate-middle">
        <h1 class="h3 mb-3 fw-normal">Sistem Data Mahasiswa</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="inputUsername" class="form-label">Username</label>
                <input type="username" name="username" class="form-control" id="inputUsername" required="required">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword" required="required">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="/modules/auth/register.php" class="btn btn-light">Register</a>
        </form>
    </main>
<?php include '../../includes/footer.php'; ?>
