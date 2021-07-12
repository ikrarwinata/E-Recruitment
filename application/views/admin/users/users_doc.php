<!doctype html>
<html>
    <head>
        <title>Document File</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Users List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
		
            </tr><?php
            foreach ($users_data as $users)
            {
            ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $users->username ?></td>
                <td><?php echo $users->password ?></td>
                <td><?php echo $users->nama ?></td>
                <td><?php echo $users->jenis_kelamin ?></td>
                <td><?php echo $users->jabatan ?></td>	
            </tr>
            <?php
            }
            ?>
        </table>
    </body>
</html>