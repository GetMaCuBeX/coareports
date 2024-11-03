<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">SCHOOL DETAILS</h4>
            <div class="page-title-right">
                <ol class="breadcrumb p-0 m-0">
                    <!--<li class="breadcrumb-item"><a href="<?php //echo base_url();                      ?>jb_coa/school_ppe_annex_a_all_division" target="_blank">Print All</a></li>--> 
                    <!--<li class="btn btn-primary waves-effect waves-light"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">Add Data</a></li>-->
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg">Add Data</button>
                    <!--<li class="breadcrumb-item active">Dashboard 3</li>-->
                </ol> 
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div> <!-- end page title -->



<style>
    table {
        width: 100%;
        border: 1px solid gray;
        border-collapse: collapse;
        background-color: white;
        .maxwidth-description{
            max-width: 400px;
        }
        .maxwidth-remarks{
            max-width: 400px;
        }
        .maxwidth-article {
            max-width: 150px;
        }

    }

    thead, th, td {
        border: 1px solid gray;
        padding: 3px;
        font-size: 14px;
    }

    .table-title {
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .no-outline{
        border: none;
        outline: none;
    }

    .hover-red {
        transition: background-color 0.3s; /* Optional: smooth transition */
    }

    .hover-red:hover {
        background-color: red; /* Change background to red on hover */
    }

</style>



<body>
    <div>


        <?php $row_count = 1; ?>
        <?php $group_count = 0; ?>
        <?php $school_list_count_all = 0; ?>
        <?php if (!empty($rs)): ?>

            <table>


                <!--START FOREACH-->
                <?php foreach ($rs as $row): ?>


                    <!--HEADERS-->
                    <?php if ($school_list_count_all == 0) { ?>
                        <thead> 


                            <tr style="text-align: center;">
                                <th style="text-align: center;">&nbsp;&nbsp;#&nbsp;&nbsp;</th>
                                <th class="maxwidth-article">Group / Article</th>
                                <th class="maxwidth-description">Description</th>
                                <th>Old Prty. No.</th>
                                <th>New Prty. No.</th>
                                <th>Unit of Measure</th>
                                <th>Unit Value</th>
                                <th>QTY (Property Card)</th> 
                                <th>QTY (Physical Count)</th>
                                <th>Total Value</th>
                                <th>Date Acquired</th>
                                <th>Condition</th>
                                <!--<th class="maxwidth-remarks">Remarks</th>--> 
                            </tr>  
                        </thead>
                    <?php } ?>


                    <!--SCHOOL ID - SCHOOL NAME-->    
                    <?php if ($school_list_count_all == 0) { ?>
                        <tr>
                            <td colspan="6" style="text-align: left; color: green; border-right: 0;"><strong><?= ($row->SCHOOLID) . ' - ' . strtoupper($row->SCHOOLNAME) ?></strong></td>
                            <td colspan="6" style="text-align: right; color: blue; border-left: 0;"><strong><?= strtoupper($row->DISTRICT) ?></strong></td>
                        </tr>
                    <?php } ?>


                    <!--GROUP NAME-->
                    <?php if ($row->_R2 == 1) { ?>
                        <tr>
                            <td colspan="12" style="color: red;" class="no-outline"><strong><?= strtoupper($row->GROUP_NAME) ?></strong></td>
                        </tr>
                    <?php } ?>


                    <!--TABLE BODY-->
                    <tbody>
                        <!--VALUES-->
                        <tr> 
                            <td class="hover-red" style="text-align: center;">
                                <a href="#">
                                    <strong>&nbsp;<?= str_pad($row_count++, 2, '0', STR_PAD_LEFT) ?>&nbsp;</strong>
                                </a>
                            </td>
                            <td class="maxwidth-article"><?= ($row->ARTICLE) ?></td>
                            <td class="maxwidth-description"<?= ($row->is_existing == 0) ? ' style="color: red;"' : ''; ?>><?= ($row->DESCRIPTION) ?></td>
                            <td><?= ($row->old_property_no_assigned) ?></td>
                            <td><?= ($row->new_property_no_assigned) ?></td>
                            <td style="text-align: center;"><?= ($row->unit_of_measure) ?></td>
                            <td style="text-align: right;"><?= ($row->unit_value) ?></td>
                            <td style="text-align: center;"><?= ($row->quantity_per_property_card) ?></td>
                            <td style="text-align: center;"><?= ($row->quantity_per_physical_count) ?></td>
                            <td style="text-align: right; <?= ($row->is_existing == 0) ? ' color: red;' : ''; ?>"><?= ($row->total_value) ?></td>
                            <td style="text-align: center;">
                                <?php
                                $dateAcquired = $row->date_acquired; // Assuming this is coming from your data source
                                // Check if date is null
                                if (!is_null($dateAcquired)) {
                                    $date = new DateTime($dateAcquired);

                                    // Check if the month is January and the day is 1
                                    if ($date->format('m') === '01' && $date->format('d') === '01') {
                                        echo $date->format('Y'); // Display year only
                                    } else {
                                        echo $date->format('Y-m-d'); // Display full date or any other format you prefer
                                    }
                                }
                                ?>
                            </td>
                            <td><?= ($row->condition_name) ?></td>
                            <!--<td class="maxwidth-remarks"><?= ($row->remarks) ?></td>--> 
                        </tr>

                        <?php $group_count++; ?>
                        <?php $school_list_count_all++; ?>


                        <!--SUB TOTAL-->
                        <?php if ($group_count == $row->_R3) { ?>
                            <?php $group_count = 0; ?>
                            <tr>
                                <td colspan="7" class="no-outline"></td>
                                <td colspan="2" style="text-align: left;">SUB TOTAL: </td>
                                <td style="text-align: right;"><?= ($row->SUM_PER_GROUP) ?></td>
                                <td colspan="2" class="no-outline"></td>
                            </tr>
                        <?php } ?>


                        <!--GRAND TOTAL-->
                        <?php if ($school_list_count_all == $row->_R4) { ?>
                            <?php $school_list_count_all = 0; ?>
                            <tr class="grand-total">
                                <td colspan="7" class="no-outline"></td>
                                <td colspan="2" style="text-align: left;"><strong>GRAND TOTAL: </strong></td>
                                <td style="text-align: right; color: red;"><strong><?= ($row->GRAND_TOTAL) ?></strong></td>
                                <td colspan="2" class="no-outline"></td>
                            </tr>

                            <!--EXTRA COLUMN-->
                            <tr class="grand-total">
                                <td class="no-outline" colspan="12" >&nbsp;</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php endforeach; ?> <!--END FOREACH-->
            </table>
        <?php else: ?>
            <p>No records found.</p>
        <?php endif; ?>
    </div>

</body>



<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">PPE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <!--START FORM-->

                <form id="myForm" method="post" action="<?= base_url('jb_coa/save_ppe_list'); ?>">
                    <div>
                        <label for="group">Select Group:</label>
                        <select id="group" name="group" required>
                            <option value="">Select</option>
                            <?php foreach ($groups as $row) { ?>
                                <option value="<?= htmlspecialchars($row->id); ?>">
                                    <?= htmlspecialchars($row->name); ?>
                                </option> 
                            <?php } ?>
                        </select>
                    </div>

                    <div>
                        <label for="article">Select Article:</label>
                        <select id="article" name="article" required>
                            <option value="">Select</option>
                            <!-- This will be populated based on the first dropdown -->
                        </select>
                    </div>

                    <button type="submit">Save Selection</button>
                </form>

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

                <!--END FORM-->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

