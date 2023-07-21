<?php

include 'func.php';
checkSession();
$isAc = "";
$isProjektor = "";
$isInternet = "";
$isLectern = "";
$isSpeaker = "";
$isDesk = "";
$isPc = "";
$isSmartboard = "";
$maxCnt = 0;

if (isset($_GET['ac'])) $isAc  = $_GET['ac'];
if (isset($_GET['projector'])) $isProjektor  = $_GET['projector'];
if (isset($_GET['internet'])) $isInternet  = $_GET['internet'];
if (isset($_GET['lectern'])) $isLectern  = $_GET['lectern'];
if (isset($_GET['speaker'])) $isSpeaker  = $_GET['speaker'];
if (isset($_GET['desk'])) $isDesk  = $_GET['desk'];
if (isset($_GET['pc'])) $isPc  = $_GET['pc'];
if (isset($_GET['smartboard'])) $isSmartboard  = $_GET['smartboard'];
if (isset($_GET['max'])) $maxCnt  = $_GET['max'];



beginPage("Filter");
$c = getDB();
$rs = [];
if ($isAc == "" && $isProjektor == "" && $isInternet == "" && $isLectern == "" && $isSpeaker == "" && $isDesk == "" && $isPc == "" && $isSmartboard == "" && $maxCnt== 0)
{
    $rs = qWMR("select * from xclasses", null, $c);    
}
else
{
    $kosullar = [];
    $q = "select * from xclasses where ";
    if ($isAc != "")        $kosullar[] = " ac_varmi = $isAc ";
    if ($isProjektor != "")       $kosullar[] = " projektor_varmi = $isProjektor ";
    if ($isInternet != "")        $kosullar[] = " internet_varmi = $isInternet ";
    if ($isLectern != "")        $kosullar[] = " lectern_varmi = $isLectern ";
    if ($isSpeaker != "")        $kosullar[] = " speaker_varmi = $isSpeaker ";
    if ($isDesk != "")        $kosullar[] = " desk_varmi = $isDesk ";
    if ($isPc != "")        $kosullar[] = " pc_varmi = $isPc ";
    if ($isSmartboard != "")        $kosullar[] = " smartboard_varmi  = $isSmartboard ";
    if ($maxCnt != "")            $kosullar[] = " max_kisi >=  $maxCnt";
    $kosulStr = implode(" and ", $kosullar);
    $rs = qWMR("select * from xclasses where ".$kosulStr, null, $c);    
    //echo "select * from xclasses where ".$kosulStr;
}

?>

<div class="row">
    <div class="col-12">
       
        <div class="row mb-3">
            <div class="col-4">
                <b>Air Conditioner</b>
                <select class="form-control shadow" id="fAc">
                    <option <?=$isAc == "" ? "selected='selected'" : "" ;?> value="">Choose</option>
                    <option <?=$isAc == "1" ? "selected='selected'" : "" ;?> value="1">Yes</option>
                    <option <?=$isAc == "0" ? "selected='selected'" : "" ;?> value="0">No</option>
                </select>
            </div>
            <div class="col-4">
                <b>Projector</b>
                <select class="form-control shadow" id="fProjector">
                    <option <?=$isProjektor== "" ? "selected='selected'" : "" ;?> value="">Choose</option>
                    <option <?=$isProjektor == "1" ? "selected='selected'" : "" ;?> value="1">Yes</option>
                    <option <?=$isProjektor== "0" ? "selected='selected'" : "" ;?> value="0">No</option>
                </select>
            </div>
            <div class="col-4">
                <b>Internet</b>
                <select class="form-control shadow" id="fInternet">
                   <option <?=$isInternet == "" ? "selected='selected'" : "" ;?> value="">Choose</option>
                    <option <?=$isInternet == "1" ? "selected='selected'" : "" ;?> value="1">Yes</option>
                    <option <?=$isInternet == "0" ? "selected='selected'" : "" ;?> value="0">No</option>
                </select>
            </div>
            <div class="col-4">
                <b>Speaker</b>
                <select class="form-control shadow" id="fSpeaker">
                    <option <?=$isSpeaker == "" ? "selected='selected'" : "" ;?> value="">Choose</option>
                    <option <?=$isSpeaker == "1" ? "selected='selected'" : "" ;?> value="1">Yes</option>
                    <option <?=$isSpeaker == "0" ? "selected='selected'" : "" ;?> value="0">No</option>
                </select>
            </div>
            <div class="col-4">
                <b>Desk</b>
                <select class="form-control shadow" id="fDesk">
                    <option <?=$isDesk == "" ? "selected='selected'" : "" ;?> value="">Choose</option>
                    <option <?=$isDesk == "1" ? "selected='selected'" : "" ;?> value="1">Yes</option>
                    <option <?=$isDesk == "0" ? "selected='selected'" : "" ;?> value="0">No</option>
                </select>
            </div>
            <div class="col-4">
                <b>Smart Board</b>
                <select class="form-control shadow" id="fSmartboard">
                    <option <?=$isSmartboard == "" ? "selected='selected'" : "" ;?> value="">Choose</option>
                    <option <?=$isSmartboard == "1" ? "selected='selected'" : "" ;?> value="1">Yes</option>
                    <option <?=$isSmartboard == "0" ? "selected='selected'" : "" ;?> value="0">No</option>
                </select>
            </div>
            <div class="col-4">
                <b>Lectern</b>
                <select class="form-control shadow" id="fLectern">
                    <option <?=$isLectern == "" ? "selected='selected'" : "" ;?> value="">Choose</option>
                    <option <?=$isLectern == "1" ? "selected='selected'" : "" ;?> value="1">Yes</option>
                    <option <?=$isLectern == "0" ? "selected='selected'" : "" ;?> value="0">No</option>
                </select>
            </div>
            <div class="col-4">
                <b>PC</b>
                <select class="form-control shadow" id="fPc">
                    <option <?=$isPc == "" ? "selected='selected'" : "" ;?> value="">Choose</option>
                    <option <?=$isPc == "1" ? "selected='selected'" : "" ;?> value="1">Yes</option>
                    <option <?=$isPc == "0" ? "selected='selected'" : "" ;?> value="0">No</option>
                </select>
                </div>
            
            
           
            
            <div class="col-4">
                <b>Max Capacity</b>
                <input type="number" class="form-control shadow" id="fMax">
            </div>
            
            <div class="col-4">
                &nbsp;&nbsp;
                <button class="btn btn-primary shadow btnFilter btn-block">Filter</button>
            </div>
        </div>
        
       
        
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover table-striped w-100" id="t">
            <thead class="bg-secondary text-light">
                <tr>
                    <th>ID</th>
                    <th>AD</th>
                    <th>Air Conditioner</th>
                    <th>Projector</th>
                    <th>Internet</th>
                    <th>Lectern</th>
                    <th>Speaker</th>
                    <th>Desk</th>
                    
                    <th>Smart Board</th>
                    <th>PC</th>
                    <th>Capacity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($rs as $r)
                {
                    ?>
                <tr>
                    <td><?=$r['id'];?></td>
                    <td><?=$r['ad'];?></td>
                    <td><?=$r['ac_varmi'] == "1" ? "Yes" : "No";?></td>
                    <td><?=$r['projektor_varmi'] == "1" ? "Yes" : "No";?></td>
                    <td><?=$r['internet_varmi'] == "1" ? "Yes" : "No";?></td>
                    <td><?=$r['lectern_varmi'] == "1" ? "Yes" : "No";?></td>
                    <td><?=$r['speaker_varmi'] == "1" ? "Yes" : "No";?></td>
                    <td><?=$r['desk_varmi'] == "1" ? "Yes" : "No";?></td>
                    <td><?=$r['smartboard_varmi'] == "1" ? "Yes" : "No";?></td>
                    <td><?=$r['pc_varmi'] == "1" ? "Yes" : "No";?></td>
                    <td><?=$r['max_kisi'];?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<?php
endPage();
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/r-2.2.9/sc-2.0.5/sl-1.3.4/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/r-2.2.9/sc-2.0.5/sl-1.3.4/datatables.min.js"></script>



 <script>
     
     var t = $("#t").DataTable(
             {
                 dom: 'Bfrtip',
        buttons: [
            'colvis',
            'copyHtml5',
            'excelHtml5',
            'print'
        ]
             });
     
$(".btnFilter").click(function(){
    var n = $("#fMax").val();
    var ac = $("#fAc").val();
    var projector = $ ("#fProjector").val();
    var internet = $("#fInternet").val();
    var lectern = $("#fLectern").val();
    var speaker = $ ("#fSpeaker").val();
    var desk = $("#fDesk").val();
    var pc = $("#fPc").val();
    var sb = $("#fSmartboard").val();

    var link = "filter.php?";
    if (ac != "") link += "ac="+ac;
    if (n != "") link += "&max="+n;
    if (projector != "") link += "&projector="+projector;
    if (internet != "") link += "&internet="+internet;
    if (lectern != "") link += "&lectern="+lectern;
    if (speaker != "") link += "&speaker="+speaker;
    if (desk != "") link += "&desk="+desk;
    if (pc != "") link += "&pc="+pc;
    if (sb != "") link += "&smartboard="+sb;
    

    location.href=link;
});
</script>