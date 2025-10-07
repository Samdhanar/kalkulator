<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator Sederhana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Kalkulator Sederhana dengan PHP & Bootstrap</h2>
    <div class="card shadow">
        <div class="card-body">
            <form method="post">
                <div class="row mb-3">
                    <div class="col-md-5">
                        <input type="number" name="angka1" class="form-control" placeholder="Angka pertama" required value="<?= isset($_POST['reset']) ? '' : ($_POST['angka1'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <select name="operator" class="form-select" required>
                            <option value="+" <?= (isset($_POST['operator']) && $_POST['operator'] == '+') ? 'selected' : '' ?>>+</option>
                            <option value="-" <?= (isset($_POST['operator']) && $_POST['operator'] == '-') ? 'selected' : '' ?>>-</option>
                            <option value="" <?= (isset($_POST['operator']) && $_POST['operator'] == '') ? 'selected' : '' ?>>×</option>
                            <option value="/" <?= (isset($_POST['operator']) && $_POST['operator'] == '/') ? 'selected' : '' ?>>÷</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <input type="number" name="angka2" class="form-control" placeholder="Angka kedua" required value="<?= isset($_POST['reset']) ? '' : ($_POST['angka2'] ?? '') ?>">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <button type="submit" name="hitung" class="btn btn-primary">Hitung</button>
                        <button type="submit" name="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </form>

            <?php
            $hasil = '';
            if (isset($_POST['hitung'])) {
                $angka1 = $_POST['angka1'];
                $angka2 = $_POST['angka2'];
                $operator = $_POST['operator'];

                switch ($operator) {
                    case '+':
                        $hasil = $angka1 + $angka2;
                        break;
                    case '-':
                        $hasil = $angka1 - $angka2;
                        break;
                    case '*':
                        $hasil = $angka1 * $angka2;
                        break;
                    case '/':
                        if ($angka2 == 0) {
                            $hasil = "Tidak bisa dibagi dengan nol";
                        } else {
                            $hasil = $angka1 / $angka2;
                        }
                        break;
                    default:
                        $hasil = "Operator tidak valid";
                }

                echo '<div class="alert alert-success mt-4">Hasil: <strong>' . $hasil . '</strong></div>';
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>