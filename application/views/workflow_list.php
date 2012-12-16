<?php
print_r($active);
?>

<p>
    <a href="<?php echo site_url('/workflowTest/run'); ?>">create</a>
</p>
<table>
    <tr>
        <th>wkf id</th>
        <th>node id</th>
        <th>start date</th>
        <th>end date</th>
        <th>parameters</th>
        <th>action</th>
    </tr>
    
    <?php foreach($active as $v): ?>
    <tr>
        <td><?php echo $v['KODE_WKF']; ?></td>
        <td><?php echo $v['KODE_AKTIFITAS']; ?></td>
        <td><?php echo $v['TANGGAL_MULAI']; ?></td>
        <td><?php echo $v['TANGGAL_SELESAI']; ?></td>
        <td><?php echo $v['PARAMETER']; ?></td>
        <td><a href='<?php echo site_url('/workflowTest/run?instance_id='.$v['KODE_PROSES']); ?>'>run</a></td>
    </tr>
    <?php endforeach; ?>
</table>

<table>
    <tr>
        <th>wkf id</th>
        <th>node id</th>
        <th>start date</th>
        <th>end date</th>
        <th>parameters</th>
        <th>action</th>
    </tr>
    
    <?php foreach($finish as $v): ?>
    <tr>
        <td><?php echo $v['KODE_WKF']; ?></td>
        <td><?php echo $v['KODE_AKTIFITAS']; ?></td>
        <td><?php echo $v['TANGGAL_MULAI']; ?></td>
        <td><?php echo $v['TANGGAL_SELESAI']; ?></td>
        <td><?php echo $v['PARAMETER']; ?></td>
        <td><a href='<?php echo site_url('/workflowTest/view?instance_id='.$v['KODE_PROSES']); ?>'>view</a></td>
    </tr>
    <?php endforeach; ?>
</table>