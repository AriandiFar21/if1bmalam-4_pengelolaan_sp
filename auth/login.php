<?php
session_start();
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE nim='$username'");

    if (mysqli_num_rows($query) === 1) {
        $user = mysqli_fetch_assoc($query);

        if ($role !== $user["role"]) {
            $error = "Role tidak sesuai dengan akun!";
        } else if ($password === $user["password"]) {

            $_SESSION["login"]    = true;
            $_SESSION["nim"]      = $user["nim"];
            $_SESSION["nama"]     = $user["nama"];
            $_SESSION["role"]     = $user["role"];
            $_SESSION["kelas"]     = $user["kelas"];

            if ($user['role'] == "staff_akademik") {
                echo "<script>alert('Berhasil Login Sebagai Staff Akademik'); window.location.href = '../admin/index.php';</script>";
                exit;
            } else if ($user['role'] == "mahasiswa") {
                echo "<script>alert('Berhasil Login Sebagai Mahasiswa'); window.location.href = '../mahasiswa/index.php';</script>";
                exit;
            } else if ($user['role'] == "dosen") {
                echo "<script>alert('Berhasil Login Sebagai Dosen'); window.location.href = '../dosen/index.php';</script>";
                exit;
            }
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Akun tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../auth/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
        body {
            overflow: hidden;
        }

        .baan {
            margin-left: 60px;
            width: auto;
        }

        .container {
            width: 79%;
        }

        .btn {
            background-color: #010825;
            color: white;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .container {
                width: 100%;
            }

            .baan {
                margin-left: 0px;
                width: auto;
            }
        }
    </style>
</head>

<body>

    <section class="p-2 p-md-4 mt-xl-3">
        <div class="container">
            <div class="card border-light-subtle shadow-sm">
                <div class="row g-0">
                    <div class="col-12 col-md-6">
                        <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="../FOTO/Rectangle.png" alt="BootstrapBrain Logo">
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <?php if (isset($error)) { ?>
                                <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">
                                        <h3 class="text-center fw-bold">Selamat Datang</h3>
                                        <p class="text-center fw-medium fs-5">Silahkan Masukkan Akun Anda</p>
                                    </div>
                                    <hr style="position: relative; top: -20px;">
                                </div>
                            </div>
                            <form action="" method="POST">
                                <div class="row gy-3 gy-md-4 overflow-hidden">
                                    <div class="col-12">
                                        <label for="password" class="form-label">Role<span class="text-danger">*</span></label>
                                        <select class="form-select" name="role" required>
                                            <option value="" selected disabled>Pilih Role Kamu</option>
                                            <option value="staff_akademik">Staff Akademik</option>
                                            <option value="dosen">Dosen</option>
                                            <option value="mahasiswa">Mahasiswa</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                        <input type="username" class="form-control" name="username" id="username" placeholder="Masukkan Username Anda" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password Anda" value="" required>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-dark w-100 py-2 fw-bold" style="background-color:#010825;">
                                                Masuk
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>