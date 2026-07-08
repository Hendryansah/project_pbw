<?php

    session_start();

    require '../../config/koneksi.php';

    if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        
$sql = "SELECT password FROM pengguna WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);

// --- TAMBAHKAN 3 BARIS INI UNTUK CEK ERROR ASLI ---
if (!$stmt) {
    die("Bocoran Error MySQL: " . mysqli_error($conn)); 
}
// --------------------------------------------------

mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if ( $row = mysqli_fetch_assoc($result) ) {
            $_SESSION['message']['type'] = "warning";
            $_SESSION['message']['content'] = "Username sudah pernah digunakan";
        } else {
            if ( $password == $password_confirm ) {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO pengguna (username, password) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $username, $password_hash);
                if ( mysqli_stmt_execute($stmt) ) {
                    $_SESSION['message']['type'] = "success";
                    $_SESSION['message']['content'] = "Akun berhasil didaftarkan. Silakan Login!";
                } else {
                    $_SESSION['message']['type'] = "danger";
                    $_SESSION['message']['content'] = "Gagal mendaftarkan akun : " . mysqli_error($conn);
                }
            } else {
                $_SESSION['message']['type'] = "warning";
                $_SESSION['message']['content'] = "Password tidak sama dengan Konfirmasi";
            }
        }
    }

?>

<?php include '../../includes/header.php'; ?>

<?php if ( isset($_SESSION['message']) ) { ?>
    <div class="alert alert-<?=$_SESSION['message']['type']?> mt-3" role="alert">
        <?=$_SESSION['message']['content']?>
    </div>
<?php } unset($_SESSION['message']); ?>

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
            <div class="mb-3">
                <label for="inputPasswordConfirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirm" class="form-control" id="inputPasswordConfirmation" required="required">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="/modules/auth/login.php" class="btn btn-light">Login</a>
        </form>
    </main>
<?php include '../../includes/footer.php'; ?>