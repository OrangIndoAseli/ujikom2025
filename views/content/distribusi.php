<?php
$distribusi_list = $distribusi_list ?? [];
$barang = $barang ?? [];
?>

<div class="container mt-5">
    <h2>Data Distribusi Barang</h2>

    <!-- Notification -->
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-info"><?= $_SESSION['message']; ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        Tambah Distribusi
    </button>

    <!-- Distribusi Table -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="tabel-distribusi">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tujuan</th>
                    <th>Alamat</th>
                    <th>Nomor Telepon</th>
                    <th>Tanggal Distribusi</th>
                    <th>SubTotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($distribusi_list)) : ?>
                    <?php $no = 1; foreach ($distribusi_list as $d) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($d['nama_barang'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($d['jumlah'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($d['tujuan'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($d['alamat'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($d['nomortlp'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($d['tanggal_distribusi'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>Rp <?= number_format((float)($d['total_harga'] ?? 0), 0, ',', '.'); ?></td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#konfirmasi<?= $d['id_distribusi']; ?>">
                                    konfirmasi
                                </button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $d['id_distribusi']; ?>">
                                    kembalikan
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">Data distribusi tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Distribusi Modal -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Distribusi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?page=distribusi&action=store" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Barang</label>
                        <select name="barang_id" class="form-control" required>
                            <option value="">Pilih Barang</option>
                            <?php foreach ($barang as $b) : ?>
                                <?php if (!isset($b['id_barang'], $b['nama'], $b['stok'])) continue; ?>
                                <option value="<?= $b['id_barang']; ?>" data-stok="<?= $b['stok']; ?>">
                                    <?= htmlspecialchars($b['nama'], ENT_QUOTES, 'UTF-8'); ?> (Stok: <?= $b['stok']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1" required>
                        <div id="stok-warning" class="text-danger mt-1" style="display: none;">
                            Jumlah melebihi stok yang tersedia!
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tujuan</label>
                        <input type="text" name="tujuan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="nomortlp" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Distribusi</label>
                        <input type="date" name="tanggal_distribusi" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga Total</label>
                        <input type="text" id="harga_total" class="form-control" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- konfirmasi & kembalikan Modals -->
<?php foreach ($distribusi_list as $d) : ?>
    <!-- konfirmasi Distribusi Modal -->
    <div class="modal fade" id="konfirmasi<?= $d['id_distribusi']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi distribusi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>konfirmasi distribusi <strong><?= htmlspecialchars($d['nama_barang'] ?? '', ENT_QUOTES, 'UTF-8'); ?></strong> ke <strong><?= htmlspecialchars($d['tujuan'] ?? '', ENT_QUOTES, 'UTF-8'); ?></strong>?</p>
                    <p class="text-warning">Stok barang akan dikirim <?= htmlspecialchars($d['jumlah'] ?? '', ENT_QUOTES, 'UTF-8'); ?> unit.</p>
                </div>
                <div class="modal-footer">
                <form action="index.php?page=distribusi&action=konfirmasi" method="POST">
                    <input type="hidden" name="id_distribusi" value="<?= $d['id_distribusi']; ?>">
                    <button type="submit" class="btn btn-success btn-sm">Konfirmasi</button>
                     </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Distribusi Modal -->
    <div class="modal fade" id="modalHapus<?= $d['id_distribusi']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi pengembalian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin mengembalikan distribusi <strong><?= htmlspecialchars($d['nama_barang'] ?? '', ENT_QUOTES, 'UTF-8'); ?></strong> ke <strong><?= htmlspecialchars($d['tujuan'] ?? '', ENT_QUOTES, 'UTF-8'); ?></strong>?</p>
                    <p class="text-warning">Stok barang akan dikembalikan sebanyak <?= htmlspecialchars($d['jumlah'] ?? '', ENT_QUOTES, 'UTF-8'); ?> unit.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="index.php?page=distribusi&action=destroy" method="POST">
                        <input type="hidden" name="id_distribusi" value="<?= $d['id_distribusi']; ?>">
                        <button type="submit" class="btn btn-danger">kembalikan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>