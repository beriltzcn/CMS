<?php
include 'func.php';
checkSession();
beginPage('Dersler');

$c = getDB();



?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/sl-1.3.4/datatables.min.css"/>
 

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/sl-1.3.4/datatables.min.js"></script>

<table clasS="table table-bordered table-hover table-striped w-100" id="t">
    <thead class="bg-secondary text-light">
        <tr>
            <th></th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
        $rDays = qWMR("select * from days", null, $c);
        $rPeriods = qWMR("select * from periods", null, $c);
        
        foreach($rPeriods as $p)
        {
            
           ?>
        <tr>
            <td><?=$p['p_ad'];?></td>
            <?php
            foreach($rDays as $day)
            {
                $gunId = $day['id'];
                $periodId = $p['id'];
                $dersInfo = qW1R("select count(*) as 'cnt', id, ad, hoca, sinif  from dersler where gun= $gunId and period = $periodId", null, $c);
            
                $data = "";
                if ($dersInfo['cnt'] != 0)
                {
                    $sinifAd = qW1R("select ad from siniflar where id = ".$dersInfo['sinif'], null, $c)['ad'];
                    $data = "<b>".$dersInfo['ad']."</b><br>".$dersInfo['hoca']."<br>".$sinifAd;
                }
                ?>
            <td><?=$data;?></td>
            
                <?php
            }
            
           ?> 
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php
endPage();
?>
<style>
    td, tr { vertical-align: middle !important; text-align: center !important}
</style>

<script>
var t = $("#t").DataTable();
</script>