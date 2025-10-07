<?php
// Kalkulator sederhana dengan Bootstrap
// Simpan file ini sebagai kalkulator.php dan jalankan di server PHP (XAMPP, LAMP, dsb.)

$result = null;
$error = null;
$a = '';
$b = '';
$op = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // ambil input dan sanitasi sederhana
  $a = isset($_POST['a']) ? trim($_POST['a']) : '';
  $b = isset($_POST['b']) ? trim($_POST['b']) : '';
  $op = isset($_POST['operator']) ? $_POST['operator'] : '';

  // validasi numeric
  if ($a === '' || $b === '') {
    $error = 'Masukkan kedua angka.';
  } elseif (!is_numeric($a) || !is_numeric($b)) {
    $error = 'Masukkan harus berupa angka.';
  } else {
    $a = (float) $a;
    $b = (float) $b;

    switch ($op) {
      case 'tambah':
        $result = $a + $b;
        break;
      case 'kurang':
        $result = $a - $b;
        break;
      case 'kali':
        $result = $a * $b;
        break;
      case 'bagi':
        if ($b == 0) {
          $error = 'Pembagian dengan nol tidak diperbolehkan.';
        } else {
          $result = $a / $b;
        }
        break;
      default:
        $error = 'Operator tidak dikenal.';
    }
  }
}
?>

<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kalkulator Sederhana</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h3 class="card-title mb-3">Kalkulator Sederhana</h3>

            <?php if ($error): ?>
              <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <?php if ($result !== null): ?>
              <div class="alert alert-success">Hasil: <strong><?= rtrim(rtrim(number_format($result, 10, ',', '.'), '0'), ',') ?></strong></div>
            <?php endif; ?>

            <form method="post" novalidate>
              <div class="mb-3">
                <label for="a" class="form-label">Angka pertama</label>
                <input type="number" step="any" class="form-control" id="a" name="a" value="<?= htmlspecialchars($a) ?>" required>
              </div>

              <div class="mb-3">
                <label for="b" class="form-label">Angka kedua</label>
                <input type="number" step="any" class="form-control" id="b" name="b" value="<?= htmlspecialchars($b) ?>" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Operator</label>
                <div class="d-flex gap-2 flex-wrap">
                  <button type="submit" name="operator" value="tambah" class="btn btn-primary">+</button>
                  <button type="submit" name="operator" value="kurang" class="btn btn-secondary">−</button>
                  <button type="submit" name="operator" value="kali" class="btn btn-success">×</button>
                  <button type="submit" name="operator" value="bagi" class="btn btn-warning">÷</button>
                </div>
              </div>

              <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-outline-primary">Hitung (pakai operator di atas)</button>
                <a href="" class="btn btn-outline-secondary">Reset</a>
              </div>
            </form>

            <hr>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>