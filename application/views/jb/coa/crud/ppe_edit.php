<!-- Plugins css --> 
<link href="<?= base_url(); ?>assets/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" /> 



<?php foreach ($ppe_list_selected as $row_ppe) { ?>
    <div>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?= $row_ppe->SCHOOL_ID; ?> - <?= $row_ppe->SCHOOL_NAME; ?></h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb p-0 m-0">
                            <!--<li class="breadcrumb-item"><a href="<?php //echo base_url();                                                   ?>jb_coa/school_ppe_annex_a_all_division" target="_blank">Print All</a></li>-->
                            <!--<li class="breadcrumb-item"><a href="#">Dashboard</a></li>-->
                            <!--<li class="breadcrumb-item active">Dashboard 3</li>-->
                        </ol> 
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div> <!-- end page title -->



        <!--ROW-->
        <div class="row">
            <div class="col-12">     
                <div class="card">
                    <div class="card-body">

                        <form id="myForm" method="post" action="<?= site_url('jb_coa/update_selection/' . $existing_data->id); ?>">
                            <!--1--> 
                            <div class="form-row"> 
                                <!--1.1-->
                                <div class="form-group col-md-6">
                                    <label for="group" class="col-form-label">Group:</label>
                                    <select id="group" name="group" value="" placeholder="" class="form-control" required>
                                        <option value="">Select</option>
                                        <?php foreach ($groups as $row) { ?>
                                            <option value="<?= htmlspecialchars($row->id); ?>" <?= ($row->id == $existing_data->group_id) ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($row->name); ?>
                                            </option> 
                                        <?php } ?>
                                    </select>
                                </div>
                                <!--1.2-->
                                <div class="form-group col-md-6">
                                    <label for="article" class="col-form-label">Article</label>
                                    <select id="article" name="article" value="" placeholder="" class="form-control" required>
                                        <option value="">Select</option>
                                        <?php foreach ($articles as $row) { ?>
                                            <option value="<?= htmlspecialchars($row->id); ?>" <?= ($row->id == $existing_data->id) ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($row->name); ?>
                                            </option> 
                                        <?php } ?>
                                    </select>
                                </div> 
                            </div>
                            <!--2--> 
                            <div class="form-row"> 
                                <!--2.1-->
                                <div class="form-group col-md-9">
                                    <label for="_des" class="col-form-label">Description</label>
                                    <input  id="_des" name="_des" type="text" value="<?= htmlspecialchars($row_ppe->description ?? ''); ?>" placeholder="" class="form-control"  maxlength="255">
                                </div>
                                <!--4.4-->
                                <div class="form-group col-md-3">
                                    <label for="_con" class="col-form-label">Condition</label>
                                    <select id="_con" name="_con" value="" placeholder="" class="form-control" required>
                                        <option value="">Select</option> 
                                        <option value="Good Condition" <?= ($row_ppe->condition_name === 'Good Condition') ? 'selected' : ''; ?>>Good Condition</option>
                                        <option value="Needs Repair" <?= ($row_ppe->condition_name === 'Needs Repair') ? 'selected' : ''; ?>>Needs Repair</option>
                                        <option value="Unserviceable" <?= ($row_ppe->condition_name === 'Unserviceable') ? 'selected' : ''; ?>>Unserviceable</option>                                
                                        <option value="Condemnable" <?= ($row_ppe->condition_name === 'Condemnable') ? 'selected' : ''; ?>>Condemnable</option>                                      
                                        <option value="Damaged" <?= ($row_ppe->condition_name === 'Damaged') ? 'selected' : ''; ?>>Damaged</option>                 
                                    </select>
                                </div>
                            </div>
                            <!--3-->
                            <div class="form-row"> 
                                <!--3.1-->
                                <div class="form-group col-md-3">
                                    <label for="_opn" class="col-form-label">Old Property No.</label>
                                    <input  id="_opn" name="_opn" type="text" value="<?= htmlspecialchars($row_ppe->old_property_no_assigned ?? ''); ?>" placeholder="" class="form-control" maxlength="255">
                                </div>
                                <!--3.2-->
                                <div class="form-group col-md-3">
                                    <label for="_npn" class="col-form-label">New Property No.</label>
                                    <input  id="_npn" name="_npn" type="text" value="<?= htmlspecialchars($row_ppe->new_property_no_assigned ?? ''); ?>"  placeholder="" class="form-control" maxlength="255">
                                </div>
                                <!--3.3-->
                                <div class="form-group col-md-3">
                                    <label for="_uom" class="col-form-label">Unit of Measure</label>
                                    <input id="_uom" name="_uom" type="text" value="<?= htmlspecialchars($row_ppe->unit_of_measure ?? ''); ?>"  placeholder="Ex. sqm, ha" class="form-control" maxlength="255">
                                </div>
                                <!--3.4-->
                                <div class="form-group col-md-3">
                                    <label for="_uv" class="col-form-label">Unit Value</label>
                                    <input id="_uv" name="_uv" type="number" value="<?= htmlspecialchars($row_ppe->unit_value ?? ''); ?>"  placeholder="" class="form-control" pattern="^\d+(\.\d{1,2})?$" step="0.01"  min="0" max="9999999999999">
                                </div>
                            </div>
                            <!--4-->
                            <div class="form-row"> 
                                <!--4.1-->
                                <div class="form-group col-md-3">
                                    <label for="_qpproc" class="col-form-label">QTY / Property Card</label>
                                    <input id="_qpproc" name="_qpproc" type="number" value="<?= htmlspecialchars($row_ppe->quantity_per_property_card ?? ''); ?>"   placeholder="" class="form-control" min="0" max="9999999999999">
                                </div>
                                <!--4.2-->
                                <div class="form-group col-md-3">
                                    <label for="_qpphyc" class="col-form-label">QTY / Physical Count</label>
                                    <input id="_qpphyc" name="_qpphyc" type="number" value="<?= htmlspecialchars($row_ppe->quantity_per_physical_count ?? ''); ?>"  placeholder="" class="form-control" min="0" max="9999999999999">
                                </div>
                                <!--4.3-->
                                <div class="form-group col-md-3">
                                    <label for="_tv" class="col-form-label">Total Value</label>
                                    <input id="_tv" name="_tv" type="number" value="<?= htmlspecialchars($row_ppe->total_value ?? ''); ?>" placeholder="" class="form-control" pattern="^\d+(\.\d{1,2})?$" step="0.01"  min="0" max="9999999999999">
                                </div>
                                <!--4.4-->
                                <div class="form-group col-md-3">
                                    <label for="_dc" class="col-form-label">Date Acquired</label>
                                    <div>
                                        <div class="input-group">
                                            <?php
// Format the date to 'm/d/Y' if it exists; otherwise, use an empty string
                                            $date_acquired = !empty($row_ppe->date_acquired) ? date('m/d/Y', strtotime($row_ppe->date_acquired)) : '';
                                            ?>

                                            <input type="text" class="form-control" value="<?= htmlspecialchars($date_acquired); ?>" 
                                                   placeholder="mm/dd/yyyy" data-provide="datepicker" data-date-autoclose="true">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>                                    
                            <!--5-->
                            <div class="form-row"> 
                                <div class="form-group col-md-6">
                                    <label for="_lw" class="col-form-label">Location Whereabouts</label> 
                                    <textarea id="_lw" name="_lw" placeholder="" class="form-control" rows="5"><?= htmlspecialchars($row_ppe->location_whereabouts ?? ''); ?></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="_rem" class="col-form-label">Remarks</label> 
                                    <textarea id="_rem" name="_rem" placeholder="" class="form-control" rows="5"><?= htmlspecialchars($row_ppe->remarks ?? ''); ?></textarea>
                                </div>
                            </div>

                            <!--6-->
                            <div class="form-row"> 
                                <!--6.1-->
                                <div class="form-group col-md-12">
                                    <label for="_pa" class="col-form-label">Person Accountable</label>
                                    <input  id="_pa" name="_pa" type="text" value="<?= htmlspecialchars($row_ppe->person_accountable ?? ''); ?>"  placeholder="" class="form-control" maxlength="255">

                                </div>    
                            </div>

                            <!--7-->
                            <div class="form-row "> 
                                <!--7.2-->
                                <div class="form-group col-md-6"> 
                                    <input id="_ie" name="_ie" type="checkbox" checked data-plugin="switchery" data-color="#039cfd" />
                                    <label for="_ie" id="label_ie" class="col-form-label">(ON) Existing / Found at Station</label>

                                </div>
                                <!--7.3-->   
                                <?php if ($_SESSION['position'] === 'ADMIN') { ?>
                                    <div class="form-group col-md-6">
                                        <input 
                                            id="_iv" 
                                            name="_iv" 
                                            type="checkbox" 
                                            data-plugin="switchery" 
                                            data-color="#039cfd" 
                                            <?= !empty($row_ppe->is_verified) ? 'checked' : ''; ?>  
                                            /> 
                                        <label for="_iv" id="label_iv" class="col-form-label">
                                            <?= !empty($row_ppe->is_verified) ? '(ON) Verified' : '(OFF) Not Verified'; ?>
                                        </label>
                                    </div>
                                <?php } ?>
                            </div>



                            <input type="hidden" name="ppe_list_id" value="
                            <?php foreach ($ppe_list_selected as $row) { ?>
                                <?= htmlspecialchars($row->id); ?>
                                   <?php } ?>">  <!--TABLE ID-->
                            <input id="_sin" name="_sin" type="hidden" value=""> <!--SCHOOL ID NO-->     

                            <!--8-->
                            <div class="form-row">
                                <!--8.2-->

                                <div class="form-group text-left mb-0  col-md-6">     
                                    <?php if (($row->is_verified == 0) || ($_SESSION['position'] === 'ADMIN')) { ?>  
                                        <button type="button" class="btn btn-danger waves-effect width-md waves-light" onclick="confirmDelete()">Delete</button> 
                                    <?php } ?>
                                </div>

                                <!--8.2-->
                                <div class="form-group text-right mb-0  col-md-6">
                                    <!--<button type="submit" name="action" value="save" id="submitBtn" class="btn btn-primary waves-effect width-md waves-light">Save Selection</button>-->

                                    <?php if (($row->is_verified == 0) || ($_SESSION['position'] === 'ADMIN')) { ?> 
                                        <button type="submit" class="btn btn-primary waves-effect width-md waves-light">Update Record</button>
                                    <?php } ?>
                                    <button type="button" class="btn btn-secondary waves-effect width-md waves-light" onclick="window.history.back()">Back</button>
                                </div>
                            </div>
                        </form>
                    </div> <!--CARD BODY END-->
                </div> <!--CARD END-->
            </div> <!--COL END-->
        </div> <!--ROW END-->
    </div>
    <?php
    break;
}
?> 



<!--DROPDOWN GET ARTICLE BASE ON SELECTED GROUP-->
<script src="<?= base_url(); ?>assets/js/jb/jquery-3.6.0.min.js"></script>
<script>
                                        $(document).ready(function () {
                                            // When a group is selected
                                            $('#group').change(function () {
                                                var groupId = $(this).val();
                                                $('#article').empty().append('<option value="">Select</option>');
                                                if (groupId) {
                                                    $.ajax({
                                                        url: '<?= base_url('jb_coa/get_articles'); ?>', // Endpoint for fetching articles
                                                        type: 'GET',
                                                        data: {id: groupId},
                                                        success: function (data) {
                                                            var articles = JSON.parse(data);
                                                            articles.forEach(function (item) {
                                                                $('#article').append('<option value="' + item.id + '">' + item.name + '</option>');
                                                            });
                                                        }
                                                    });
                                                }
                                            });
                                        });</script>

<!--CHECKBOX IS EXISTING-->
<script>
    // Get references to the checkbox and label elements
    const checkbox_ie = document.getElementById('_ie');
    const label_ie = document.getElementById('label_ie');

    // Function to update the label based on the checkbox state
    function updateLabel() {
        label_ie.textContent = checkbox_ie.checked ? '(ON) Existing / Found at Station' : '(OFF) Not Found at Station';
    }

    // Call updateLabel on page load to set the initial label text
    window.addEventListener('load', updateLabel);

    // Update the label whenever the checkbox state changes
    checkbox_ie.addEventListener('change', updateLabel);
</script>
<!--CHECKBOX IS VERIFIED-->
<script>
    // Select the checkbox and label elements
    const checkbox_iv = document.getElementById('_iv');
    const label_iv = document.getElementById('label_iv');

    // Function to update the label based on the checkbox state
    function updateLabel() {
        label_iv.textContent = checkbox_iv.checked ? '(ON) Verified' : '(OFF) Not Verified';
    }

    // Update the label on page load based on the initial checkbox state
    window.addEventListener('load', updateLabel);

    // Update the label dynamically whenever the checkbox state changes
    checkbox_iv.addEventListener('change', updateLabel);
</script>
<!--CONFIRM DELETE-->
<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.history.back(); // Go back if confirmed
            }
        });
    }
</script>

<script src="<?= base_url(); ?>assets/libs/switchery/switchery.min.js"></script> 
<script src="<?= base_url(); ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script> 
<script src="<?= base_url(); ?>assets/js/pages/form-advanced.init.js"></script>