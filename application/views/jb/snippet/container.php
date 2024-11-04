<body>
    <div>

        <!--PAGE TITLE-->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <?php foreach ($school_details as $row) { ?>
                        <h4 class="page-title"><?= $row->schidnumber; ?> - <?= $row->schname; ?></h4>
                    <?php } ?> 
                    <div class="clearfix"></div>
                </div>
            </div>
        </div> <!--PAGE TITLE END-->


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
                                        <option value="<?= htmlspecialchars($row->id); ?>">
                                            <?= htmlspecialchars($row->name); ?>
                                        </option> 
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


                    </div><!--card-body-->
                </div>
            </div>
        </div>



    </div>
</div>