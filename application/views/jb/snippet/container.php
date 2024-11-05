<body>
    <div>

        <!--PAGE TITLE-->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <?php foreach ($school_details as $row) { ?>
                        <h4 class="page-title"><?= $row->schidnumber; ?> - <?= $row->schname; ?></h4>
                    <?php } ?> 
                    <div class="page-title-right">
                        <ol class="breadcrumb p-0 m-0">
                            <!--<li class="breadcrumb-item"><a href="<?php //echo base_url();          ?>jb_coa/school_ppe_annex_a_all_division" target="_blank">Print All</a></li>-->
                            <!--<li class="breadcrumb-item"><a href="#">Dashboard</a></li>-->
                            <!--<li class="breadcrumb-item active">Dashboard 3</li>-->
                        </ol> 
                    </div>
                    <div class="clearfix"></div> 
                </div>
            </div>
        </div> <!--PAGE TITLE END-->

        <?php if (!empty($rs)): ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <!--1--> 
                            <div class="form-row"> 
                                <!--1.1-->
                                <div class="form-group col-md-6">
                                    <label for="group" class="col-form-label">Group:</label>
                                    <select id="group" name="group" required class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach ($groups as $row) { ?>
                                            <?php foreach ($groups as $row): ?>
                                                <option value="<?= htmlspecialchars($row->id); ?>">
                                                    <?= htmlspecialchars($row->name); ?>
                                                </option> 
                                            <?php endforeach; ?> <!--END FOREACH-->
                                        <?php } ?>
                                    </select>
                                </div>
                                <!--1.2-->
                                <div class="form-group col-md-6">
                                    <label for="article" class="col-form-label">Article:</label>
                                    <select id="article" name="article" required class="form-control">
                                        <option value="">Select</option> 
                                    </select>
                                </div>
                            </div>


                        </div> <!--CARD BODY END-->
                    </div> <!--CARD END-->
                </div> <!--COL END-->
            </div> <!--ROW END-->
        <?php else: ?>
            <p>No records found.</p>
        <?php endif; ?> 


    </div>
</div>