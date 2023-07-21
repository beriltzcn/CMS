<?php
include 'func.php';
checkSession();
beginPage("User Profile");
?>
<div class="row justify-content-center">
    <div class="col-6">
        <form id="f">
            <input type="hidden" name="op" value="change_pw" />
        <div class="card shadow">
            <div class="card-header bg-primary text-light">Change Your Password</div>
            <div class="card-body">
                <label>Enter Your New Password</label>
                <input type="text" class="form-control" required id="npw" name="npw" />
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">Update Password</button>
            </div>
        </div>
        </form>
    </div>
<?php
endPage();
?>

    <script>
    $("#f").submit(function(e)
    {
        e.preventDefault();
        
        var v = $(this).serializeArray();
        $.post("op.php", v, function(d)
        {
            alert("Password Updated");
            location.reload();
        });
        
        return false;
    });
    </script>