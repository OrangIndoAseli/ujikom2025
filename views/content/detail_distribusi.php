<?php
$details = $details ?? [];
?>

<div class="container mt-5">
    <h2>Data Detail Distribusi</h2>

<!-- Distribusi Table -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="tabel-detail">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tujuan</th>
                    <th>Alamat</th>
                    <th>NomorTelepon</th>
                    <th>Tanggal Distribusi</th>
                    <th>SubTotal</th>
                    <th>keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($details)) : ?>
                    <?php $no = 1; foreach ($details as $d) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($d['nama_barang'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($d['jumlah'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($d['tujuan'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($d['alamat'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($d['nomortlp'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($d['tanggal_distribusi'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>Rp <?= number_format((float)($d['harga'] ?? 0), 0, ',', '.'); ?></td>
                            <td><?= htmlspecialchars($d['keterangan'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
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