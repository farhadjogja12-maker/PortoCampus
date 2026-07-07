<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <title>Register | PortoCampus</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Poppins, sans-serif;
        }

        body {

            height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            background: linear-gradient(135deg, #2563eb, #4f46e5, #7c3aed);

        }

        .register-card {

            width: 100%;

            max-width: 520px;

            background: white;

            padding: 40px;

            border-radius: 25px;

            box-shadow: 0 25px 60px rgba(0, 0, 0, .25);

            animation: fade .7s;

        }

        @keyframes fade {

            from {

                opacity: 0;

                transform: translateY(40px);

            }

            to {

                opacity: 1;

                transform: translateY(0);

            }

        }

        .logo {

            width: 90px;

            height: 90px;

            background: linear-gradient(135deg, #2563eb, #4f46e5);

            border-radius: 50%;

            display: flex;

            justify-content: center;

            align-items: center;

            margin: auto;

            color: white;

            font-size: 40px;

            margin-bottom: 20px;

        }

        .form-control {

            border-radius: 12px;

            height: 50px;

        }

        .btn-register {

            height: 50px;

            border-radius: 12px;

            background: linear-gradient(135deg, #2563eb, #4f46e5);

            border: none;

            font-weight: bold;

        }
    </style>

</head>

<body>

    <div class="register-card">

        <div class="logo">

            <i class="bi bi-person-plus-fill"></i>

        </div>

        <h2 class="text-center">

            Daftar PortoCampus

        </h2>

        <p class="text-center text-muted mb-4">

            Buat akun mahasiswa

        </p>

        <form
            method="POST"
            action="../controllers/RegisterController.php">

            <div class="mb-3">

                <label>Nama Lengkap</label>

                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label>NIM</label>

                <input
                    type="text"
                    name="nim"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>

            </div>
            <button
                type="submit"
                class="btn btn-primary btn-register w-100">

                <i class="bi bi-person-plus-fill"></i>

                Daftar

            </button>

        </form>

        <div class="text-center mt-4">

            Sudah punya akun?

            <a
                href="login.php"
                class="text-decoration-none fw-bold">

                Login

            </a>

        </div>

        <div class="text-center mt-3">

            <a
                href="../index.php"
                class="text-decoration-none">

                <i class="bi bi-arrow-left"></i>

                Kembali ke Beranda

            </a>

        </div>

    </div>

</body>

</html>