<?php
require_once "Film.php";
session_start();

$pesan = "";

// Buat folder uploads jika belum ada
if (!is_dir(__DIR__ . '/uploads')) {
    mkdir(__DIR__ . '/uploads', 0777, true);
}

// Inisialisasi data dummy dengan path gambar lokal yang sesuai
if (!isset($_SESSION['daftarfilm'])) {
    $_SESSION['daftarfilm'] = [
        new Film("F001", "What is Wrong with Secretary Teddy", "Londo Ireng", "Romance", 2026, "uploads/tedianjeng.jpg"),
        new Film("F002", "Charlie Kirk Adalah Kita", "Kirk", "Biography", 2025, "uploads/kirkified.jpg")
    ];
}

// Tambah Data (Create)
if (isset($_POST['aksi']) && $_POST['aksi'] === 'add') {
    $kode = strtoupper(trim($_POST['kode']));
    $judul = trim($_POST['judul']);
    $director = trim($_POST['director']);
    $genre = trim($_POST['genre']);
    $tahun_raw = trim($_POST['tahun']);

    // biar kode gaada sama
    foreach ($_SESSION['daftarfilm'] as $film) {
        if ($film->getcode() === $kode) {
            $pesan = "Error: Kode film sudah terdaftar!";
            break;
        }
    }

    // error handling biar tahun sesuai format intejer
    if (empty($pesan) && !is_numeric($tahun_raw)) {
        $pesan = "Error: Tahunnya angka mas";
    }

    if (empty($pesan)) {
        $path_gambar = "";
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $nama_file = time() . "_" . basename($_FILES['gambar']['name']);
            $target_file = __DIR__ . "/uploads/" . $nama_file;
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                $path_gambar = "uploads/" . $nama_file;
            }
        }

        // tambah ke array
        $_SESSION['daftarfilm'][] = new Film($kode, $judul, $director, $genre, (int)$tahun_raw, $path_gambar);
        $pesan = "!! Homre. Film udah ditambah yah !!";
    }
}

// Hapus Data (Delete)
if (isset($_POST['aksi']) && $_POST['aksi'] === 'delete') {
    $kode = strtoupper(trim($_POST['kode']));
    $ketemu = false;

    foreach ($_SESSION['daftarfilm'] as $index => $film) {
        if ($film->getcode() === $kode) {
            if ($film->getGambar() && file_exists(__DIR__ . "/" . $film->getGambar())) {
                @unlink(__DIR__ . "/" . $film->getGambar());
            }
            array_splice($_SESSION['daftarfilm'], $index, 1);
            $pesan = "!! Oke, Film dengan kode {$kode} udah dihapus !!";
            $ketemu = true;
            break;
        }
    }

    if (!$ketemu) {
        $pesan = "gaada mas";
    }
}

// Update Data
if (isset($_POST['aksi']) && $_POST['aksi'] === 'update') {
    $kode = strtoupper(trim($_POST['kode']));
    $ketemu = false;

    foreach ($_SESSION['daftarfilm'] as $film) {
        if ($film->getcode() === $kode) {
            if (!empty(trim($_POST['judul']))) {
                $film->setJew(trim($_POST['judul']));
            }
            if (!empty(trim($_POST['director']))) {
                $film->setDir(trim($_POST['director']));
            }
            if (!empty(trim($_POST['genre']))) {
                $film->setGenre(trim($_POST['genre']));
            }
            if (!empty(trim($_POST['tahun']))) {
                $film->setYr((int)$_POST['tahun']);
            }

            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                if ($film->getGambar() && file_exists(__DIR__ . "/" . $film->getGambar())) {
                    @unlink(__DIR__ . "/" . $film->getGambar());
                }
                $nama_file = time() . "_" . basename($_FILES['gambar']['name']);
                $target_file = __DIR__ . "/uploads/" . $nama_file;
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                    $film->setGambar("uploads/" . $nama_file);
                }
            }

            $pesan = "!! Homre. Data film berhasil diupdate !!";
            $ketemu = true;
            break;
        }
    }

    if (!$ketemu) {
        $pesan = "gaada mas";
    }
}

// Pencarian Data (Search)
$hasil_tampil = $_SESSION['daftarfilm'];
if (isset($_GET['search_type']) && !empty($_GET['keyword'])) {
    $type = strtolower(trim($_GET['search_type']));
    $keyword = trim($_GET['keyword']);
    $hasil_tampil = [];

    if ($type === 'code') {
        $code = strtoupper($keyword);
        for ($i = 0; $i < count($_SESSION['daftarfilm']); $i++) {
            if ($_SESSION['daftarfilm'][$i]->getcode() === $code) {
                $hasil_tampil[] = $_SESSION['daftarfilm'][$i];
                break;
            }
        }
    } elseif ($type === 'film') {
        for ($i = 0; $i < count($_SESSION['daftarfilm']); $i++) {
            if (strcasecmp($_SESSION['daftarfilm'][$i]->getJewdul(), $keyword) === 0) {
                $hasil_tampil[] = $_SESSION['daftarfilm'][$i];
            }
        }
    } else {
        $pesan = "??? gaada pilihan begitu";
    }

    if (empty($hasil_tampil) && empty($pesan)) {
        $pesan = "gaada mas";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Film Bioskop Anti-JewGoy</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; vertical-align: middle; }
        th { background-color: #f2f2f2; }
        img { width: 90px; height: auto; display: block; border-radius: 4px; }
        .section { margin-bottom: 25px; padding: 15px; border: 1px solid #ddd; border-radius: 4px; }
        .alert { padding: 10px; background-color: #eef; border-left: 4px solid #33a; margin-bottom: 15px; }
        input[type="text"] { padding: 6px; margin-right: 5px; margin-bottom: 5px; }
        button { padding: 6px 12px; cursor: pointer; }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Daftar Film Bioskop Anti-JewGoy</h2>

    <?php if (!empty($pesan)): ?>
        <div class="alert"><strong>Pemberitahuan:</strong> <?= htmlspecialchars($pesan) ?></div>
    <?php endif; ?>

    <!-- 1. SEARCH PALING ATAS -->
    <div class="section">
        <h3>--- Search Bar ---</h3>
        <form method="GET">
            <select name="search_type" style="padding: 6px;">
                <option value="code">code</option>
                <option value="film">film</option>
            </select>
            <input type="text" name="keyword" placeholder="Cari kode film(ex -> F001) / judul film" required>
            <button type="submit">Cari</button>
            <a href="index.php"><button type="button">Reset Search</button></a>
        </form>
    </div>

    <!-- 2. TABEL -->
    <div class="section">
        <h3>Daftar Film</h3>
        <?php if (empty($hasil_tampil)): ?>
            <p>Daftar film kosong.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Poster</th>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th>Sutradara</th>
                        <th>Genre</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hasil_tampil as $film): ?>
                        <tr>
                            <td>
                                <?php if ($film->getGambar() && file_exists(__DIR__ . "/" . $film->getGambar())): ?>
                                    <img src="<?= htmlspecialchars($film->getGambar()) ?>" alt="Cover">
                                <?php else: ?>
                                    <em>Tidak ada poster</em>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($film->getcode()) ?></td>
                            <td><?= htmlspecialchars($film->getJewdul()) ?></td>
                            <td><?= htmlspecialchars($film->getDirector()) ?></td>
                            <td><?= htmlspecialchars($film->getGenre()) ?></td>
                            <td><?= htmlspecialchars((string)$film->getYear()) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- 3. ADD -->
    <div class="section">
        <h3>--- Tambah Film Baru ---</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="add">
            <input type="text" name="kode" placeholder="Masukkan Kode (ex: F001)" required>
            <input type="text" name="judul" placeholder="Masukkan Judul Film" required>
            <input type="text" name="director" placeholder="Masukkan Sutradara" required>
            <input type="text" name="genre" placeholder="Masukkan Genre" required>
            <input type="text" name="tahun" placeholder="Masukkan Tahun Rilis" required>
            <br><br>
            <label>Poster Lokal: <input type="file" name="gambar" accept="image/*"></label>
            <button type="submit">Tambah Film</button>
        </form>
    </div>

    <!-- 4. DELETE -->
    <div class="section">
        <h3>--- Hapus Film ---</h3>
        <form method="POST">
            <input type="hidden" name="aksi" value="delete">
            <input type="text" name="kode" placeholder="Masukkan Kode film yang ingin dihapus" required>
            <button type="submit">Hapus Film</button>
        </form>
    </div>

    <!-- 5. UPDATE -->
    <div class="section">
        <h3>--- Update Data Film ---</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="update">
            <input type="text" name="kode" placeholder="Masukkan Kode film yang ingin diupdate" required><br><br>
            <input type="text" name="judul" placeholder="Judul baru (kosongkan jika tidak diubah)">
            <input type="text" name="director" placeholder="Sutradara baru (kosongkan jika tidak diubah)">
            <input type="text" name="genre" placeholder="Genre baru (kosongkan jika tidak diubah)">
            <input type="text" name="tahun" placeholder="Tahun baru (kosongkan jika tidak diubah)">
            <br><br>
            <label>Poster Baru: <input type="file" name="gambar" accept="image/*"></label>
            <button type="submit">Update Film</button>
        </form>
    </div>

</body>
</html>