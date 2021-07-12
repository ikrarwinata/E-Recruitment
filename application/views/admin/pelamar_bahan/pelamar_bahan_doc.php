<!doctype html>
<html>

<head>
    <title>Document File</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" />
    <style>
        .word-table {
            border: 1px solid black !important;
            border-collapse: collapse !important;
            width: 100%;
        }

        .word-table tr th,
        .word-table tr td {
            border: 1px solid black !important;
            padding: 5px 10px;
        }
    </style>
</head>

<body>
    <h2>Pelamar_bahan List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>Nik</th>
            <th>Nama</th>
            <th>Id Berkas</th>
            <th>File Path</th>

        </tr><?php
                foreach ($pelamar_bahan_data as $pelamar_bahan) {
                ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $pelamar_bahan->nik ?></td>
                <td><?php echo $pelamar_bahan->nama ?></td>
                <td><?php echo $pelamar_bahan->id_berkas ?></td>
                <td><a href="<?php echo base_url($pelamar_bahan->file_path) ?>"><?php echo ($pelamar_bahan->file_path) ?></a></td>
            </tr>
        <?php
                }
        ?>
    </table>
</body>

</html>