<?php 

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Inventaris $waktu.xls");

?>

<table class="table" border="1">
    <thead>
        <tr align="center">
            <th scope="col">No</th>
            <th scope="col">Kode Barang</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Kondisi</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Tanggal Register</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0; foreach ($inventaris as $barang) : ?>
            <tr align="center">
                <td><?= ++$no; ?></td>
                <td><?= $barang['kode_inventaris']; ?></td>
                <td><?= $barang['nama']; ?></td>
                <td><?= $barang['kondisi']; ?></td>
                <td><?= $barang['jumlah']; ?></td>
                <td><?= date('d F Y', $barang['tanggal_register']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>