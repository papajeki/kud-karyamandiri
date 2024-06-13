<?php 
if (!empty($result)) {
    // Sort the $result array by 'tanggal_berlaku' in descending order
    usort($result, function($a, $b) {
        return strtotime($b['tanggal_berlaku']) - strtotime($a['tanggal_berlaku']);
    });
    foreach ($result as $index => $row) {
?>
        <tr>
            <td style="text-align: center;"><?= $row['tanggal_berlaku'];?></td>
            <td style="text-align: center;"><?= $row['tanggal_berakhir'];?></td>
            <td style="text-align: center;"><?= $row['harga'];?></td>
        </tr>
<?php 
    }
}
?>
