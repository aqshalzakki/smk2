<?php 

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Peminjaman $waktu.xls");

?>

<table class="table" border="1">
    <thead>
        <tr align="center">
            <th scope="col">No</th>
            <th scope="col">Nama Pegawai</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Jumlah Barang</th>
            <th scope="col">Tanggal Pinjam</th>
            <th scope="col">Tanggal Kembali</th>
            <th scope="col">Status Peminjaman</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0; foreach ($peminjaman as $peminjam) : ?>
            <tr align="center">
                <td><?= ++$no; ?></td>
                <td><?= $peminjam['nama_pegawai']; ?></td>
                <td><?= $peminjam['nama']; ?></td>
                <td><?= $peminjam['jumlah']; ?></td>
                <td><?= date('d F Y', $peminjam['tanggal_pinjam']); ?></td>
                
                <?php if ($peminjam['tanggal_kembali'] == 0) : ?>
                   
                    <td> - </td>

                <?php else : ?>

                    <td> <?= $peminjam['tanggal_kembali']; ?> </td>

                <?php endif; ?>
                <td><?= $peminjam['status_peminjaman']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>