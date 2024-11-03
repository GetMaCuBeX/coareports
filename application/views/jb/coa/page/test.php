<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">TEST</h4>
            <div class="page-title-right"> 
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div> <!-- end page title -->


<!-- start row -->
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="col-lg-4">
                <select name="concern" class="form-control"> 
                    <?php foreach ($rs as $row) { ?>
                        <option><?= htmlspecialchars($row->name); ?></option> 
                    <?php } ?>
                </select>
            </div>

        </div> 
    </div> 
</div> 


