<?php
include 'func.php';
checkSession();
beginPage('Ders Kayit');

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
                $dersInfo = qW1R("select count(*) as 'cnt', id, ad, hoca, hoca_id, sinif  from dersler where gun= $gunId and period = $periodId", null, $c);
            
                $data = "";
                if ($dersInfo['cnt'] != 0)
                {
                    $myId = $_SESSION['id'];
                    $sinifAd = qW1R("select ad from siniflar where id = ".$dersInfo['sinif'], null, $c)['ad'];
                    $data = "<b>".$dersInfo['ad']."</b><br>".$dersInfo['hoca']."<br>".$sinifAd; 
                    if ($myId == $dersInfo['hoca_id'])
                    $data .= "<br><button rec_id='".$dersInfo['id']."' class='btn btn-danger btnDelAssignment'>Remove</button>";
                    
                }
                ?>
            <td>
                <?php if ($data == "") { ?>
                <button period_id="<?=$periodId;?>" day_id="<?=$gunId;?>" class="btnDersEkle btn btn-success shadow">Click To Assign</button>
                <?php } else { ?>
                <?=$data;?>
                <?php } ?>
            </td>
            
                <?php
            }
            
           ?> 
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>

    

<form id="fEkle">
    <input type="hidden" name="op" value="ders_ekle" />
    <input type="hidden" name="kisi_id" value="<?=$_SESSION['id'];?>" />
    <input type="hidden" name="kisi_ad" value="<?=$_SESSION['ad'];?>" />
    <input type="hidden" name="period" id="period" value="" />
    <input type="hidden" name="day"  id="day" value="" />
<div class="modal fade" id="mDersEkle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Lecture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <label>Enter Course Name</label>
          <input type="text" class="form-control shadow mt-1 mb-3" name="ders_adi" id="ders_adi" required />
          <label>Select Class</label>
          <select clasS="form-control shadow mt-1 mb-3" name="sinif" id="sinif" required>
              <?php
              $rsSiniflar = qWMR("select * from siniflar", null, $c);
              foreach($rsSiniflar as $sinif)
              {
                  $sinifId = $sinif['id'];
                  $sinifAd = $sinif['ad'];
                  echo "<option value='$sinifId'>$sinifAd</option>";
              }
                  ?>
          </select>
             
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Assign</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</form>
<?php
endPage();
?>
<style>
    td, tr { vertical-align: middle !important; text-align: center !important}
</style>

<script>
    
    $(".btnDelAssignment").click(function()
    {
        var o = confirm("Are You Sure To Delete Selected Assignment ?");
        if (o)
        {
            var selId = $(this).attr('rec_id');
            $.post("op.php", { op : "del_assignment", id : selId}, function(d)
            {
                location.reload();
            })
        }
    })

$("#fEkle").submit(function(e)
    {
        e.preventDefault();
        
        var v = $(this).serializeArray();
        console.log(v);
        
        $.post("op.php", v, function(d)
        {
            location.reload();
        })
        return false;
    })
    
$(".btnDersEkle").click(function()
{
    $("#day").val($(this).attr('day_id'));
    $("#period").val($(this).attr('period_id'));
    $("#mDersEkle").modal('show');
});
</script>