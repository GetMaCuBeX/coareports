 
<form id="myForm" method="post" action="<?= site_url('jb_coa/update_selection/' . $existing_data->id); ?>">
    <input type="hidden" name="ppe_list_id" value="

           <?php foreach ($ppe_list_selected as $row) { ?>
               <?= htmlspecialchars($row->id); ?>
           <?php } ?>

           ">
    <div>
        <label for="group">Select Group:</label>
        <select id="group" name="group" required>
            <option value="">Select</option>
            <?php foreach ($groups as $row) { ?>
                <option value="<?= htmlspecialchars($row->id); ?>" <?= ($row->id == $existing_data->group_id) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($row->name); ?>
                </option> 
            <?php } ?>
        </select>
    </div>

    <div>
        <label for="article">Select Article:</label>
        <select id="article" name="article" required>
            <option value="">Select</option>
            <?php foreach ($articles as $row) { ?>
                <option value="<?= htmlspecialchars($row->id); ?>" <?= ($row->id == $existing_data->id) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($row->name); ?>
                </option> 
            <?php } ?>
        </select>
    </div>
    <!--<button type="submit" name="action" value="update" id="submitBtn">Save Selection</button>--> 
    <button type="submit">Update Selection</button>
</form>


<div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">EDIT</h4>

                <div class="clearfix"></div>
            </div>
        </div>
    </div> <!-- end page title -->



    <!--ROW-->
    <div class="row">
        <div class="col-12">     
            <div class="card">
                <div class="card-body">

                    <!--1--> 
                    <div class="form-row"> 
                        <!--1.1-->
                        <div class="form-group col-md-6">
                            <label for="group" class="col-form-label">Group:</label>
                            <select id="group" name="group" value="" placeholder="" class="form-control" required>
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
                            <label for="article" class="col-form-label">Article</label>
                            <select id="article" name="article" value="" placeholder="" class="form-control" required>
                                <option value="">Select</option> 
                            </select>
                        </div> 
                    </div>
                    <!--2--> 
                    <div class="form-row"> 
                        <!--2.1-->
                        <div class="form-group col-md-9">
                            <label for="_des" class="col-form-label">Description</label>
                            <input  id="_des" name="_des" type="text" value="" placeholder="" class="form-control"  maxlength="255">
                        </div>
                        <!--4.4-->
                        <div class="form-group col-md-3">
                            <label for="_dc" class="col-form-label">Date Acquired</label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" data-provide="datepicker" data-date-autoclose="true">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!--3-->
                    <div class="form-row"> 
                        <!--3.1-->
                        <div class="form-group col-md-3">
                            <label for="_opn" class="col-form-label">Old Property No.</label>
                            <input  id="_opn" name="_opn" type="text" placeholder="" class="form-control" maxlength="255">
                        </div>
                        <!--3.2-->
                        <div class="form-group col-md-3">
                            <label for="_npn" class="col-form-label">New Property No.</label>
                            <input  id="_npn" name="_npn" type="text" placeholder="" class="form-control" maxlength="255">
                        </div>
                        <!--3.3-->
                        <div class="form-group col-md-3">
                            <label for="_uom" class="col-form-label">Unit of Measure</label>
                            <input id="_uom" name="_uom" type="text" placeholder="Ex. sqm, ha" class="form-control" maxlength="255">
                        </div>
                        <!--3.4-->
                        <div class="form-group col-md-3">
                            <label for="_uv" class="col-form-label">Unit Value</label>
                            <input id="_uv" name="_uv" type="number" placeholder="" class="form-control" min="0" max="9999999999999">
                        </div>
                    </div>
                    <!--4-->
                    <div class="form-row"> 
                        <!--4.1-->
                        <div class="form-group col-md-3">
                            <label for="_qpproc" class="col-form-label">QTY / Property Card</label>
                            <input id="_qpproc" name="_qpproc" type="number"  placeholder="" class="form-control" min="0" max="9999999999999">
                        </div>
                        <!--4.2-->
                        <div class="form-group col-md-3">
                            <label for="_qpphyc" class="col-form-label">QTY / Physical Count</label>
                            <input id="_qpphyc" name="_qpphyc" type="number" placeholder="" class="form-control" min="0" max="9999999999999">
                        </div>
                        <!--4.3-->
                        <div class="form-group col-md-3">
                            <label for="_tv" class="col-form-label">Total Value</label>
                            <input id="_tv" name="_tv" type="number" placeholder="" class="form-control" min="0" max="9999999999999">
                        </div>
                        <!--4.4-->
                        <div class="form-group col-md-3">
                            <label for="_con" class="col-form-label">Condition</label>
                            <select id="_con" name="_con" value="" placeholder="" class="form-control" required>
                                <option value="">Select</option> 
                                <option value="Good Condition">Good Condition</option> 
                                <option value="Needs Repair">Needs Repair</option> 
                                <option value="Unserviceable">Unserviceable</option> 
                            </select>
                        </div>
                    </div>                                    
                    <!--5-->
                    <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <label for="_lw" class="col-form-label">Location Whereabouts</label> 
                            <textarea id="_lw" name="_lw" placeholder="" class="form-control" rows="6"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="_rem" class="col-form-label">Remarks</label> 
                            <textarea id="_rem" name="_lw" placeholder="" class="form-control" rows="6"></textarea>
                        </div>
                    </div>

                    <!--6-->
                    <div class="form-row"> 
                        <!--6.1-->
                        <div class="form-group col-md-6">
                            <label for="_pa" class="col-form-label">Person Accountable</label>
                            <input  id="_pa" name="_pa" type="text" placeholder="" class="form-control" maxlength="255">

                        </div>   
                        <!--6.2-->
                        <div class="form-group col-md-3">
                            <!--6.2.1-->
                            <div class="form-row col-md-6"> 
                                <label for="_ie" class="col-form-label">Existing?</label>
                            </div>
                            <div class="form-row col-md-6"> 
                                <input id="_ie"  name="_ie"  type="checkbox" checked data-plugin="switchery" data-color="#039cfd" />
                            </div>
                        </div>
                        <!--6.3-->
                        <div class="form-group col-md-3">
                            <!--6.3.1-->
                            <div class="form-row col-md-6"> 
                                <label for="_ie" class="col-form-label">Verified?</label>
                            </div>
                            <div class="form-row col-md-6"> 
                                <input id="_ie"  name="_ie"  type="checkbox" data-plugin="switchery" data-color="#039cfd" />
                            </div>
                        </div>
                    </div>




                    <input id="_sin" name="_sin" type="hidden" value="">

                    <!--<button type="submit" name="action" value="save" id="submitBtn" class="btn btn-primary waves-effect width-md waves-light">Save Selection</button>-->
                    <button type="submit" class="btn btn-primary waves-effect width-md waves-light">Update Selection</button>
                </div>  
            </div> 
        </div> <!--COL END-->
    </div> <!--ROW END-->
</div>




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
    });
</script>