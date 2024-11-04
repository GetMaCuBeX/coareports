<!--FOR DROPDOWN SELECTION QUERY DATA-->
<script src="<?= base_url(); ?>assets/js/jb/jquery-3.6.0.min.js"></script>





<style>

    /*https://www.docuseal.co/blog/css-print-page-style*/
    @media print {
        @page {
            size: A4 landscape;
            margin-top: 0.4in;
            margin-bottom: 0.4in;
            margin-left: 0.15in;
            margin-right: 0.15in;
        }

        .no-outline{
            border: none;
            outline: none;
        }

        .signature-area, .grand-total{
            page-break-inside: avoid;
        }

        .table-title table {
            page-break-before: avoid;
            page-break-after: avoid;
            page-break-inside: avoid;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .no-print {
            display: none;
        }


        table {
            width: 100%;
            border: 1px solid gray;
            border-collapse: collapse;

            thead, th, td {
                font-size: 9px;
            }
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



    }  /*end of @media print*/

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
        transition: background-color 0.3s ease; /* Smooth transition */
    }

    .hover-red:hover {
        background-color: gray; /* Change to red on hover */
        color: white; /* Optional: Change text color on hover */
    }




</style>



<body>
    <div>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <?php foreach ($school_details as $row) { ?>
                        <h4 class="page-title"><?= $row->schidnumber; ?> - <?= $row->schname; ?></h4>
                    <?php } ?>
                    <div class="page-title-right">
                        <ol class="breadcrumb p-0 m-0"> 
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg">Add Data</button>
                            <!--<li class="breadcrumb-item active">Dashboard 3</li>-->
                        </ol> 
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div> <!-- end page title -->



        <?php $row_count = 1; ?>
        <?php $group_count = 0; ?>
        <?php $school_list_count_all = 0; ?>
        <?php if (!empty($rs)): ?>
            <table>
                <!--START FOREACH-->


                <!--HEADERS-->
                <?php if ($school_list_count_all == 0) { ?>
                    <thead>
                        <tr>
                            <td colspan="9" style="font-size: 24px; text-align: center;"><strong>DEPARTMENT OF EDUCATION</strong></td>
                        </tr>
                        <tr style="text-align: center;">
                            <th class=" " style="text-align: center;">View</th>
                            <th class="maxwidth-article">Group / Article</th>
                            <th class="maxwidth-description">Description</th>
                            <!--<th>Old Prty. No.</th>-->
                            <!--<th>New Prty. No.</th>-->
                            <th>Unit of Measure</th>
                            <th>Unit Value</th>
                            <!--<th>QTY (Property Card)</th>-->
                            <th>QTY (Physical Count)</th>
                            <th>Total Value</th>
                            <th>Date Acquired</th>
                            <th>Condition</th>
                        </tr>
                    </thead>
                <?php } ?>
                <?php foreach ($rs as $row): ?>
                    <!--GROUP NAME-->
                    <?php if ($row->_R2 == 1) { ?>
                        <tr>
                            <td colspan="9" style="color: red; padding-left: 6px; padding-right: 6px;" class="no-outline"><strong><?= strtoupper($row->GROUP_NAME) ?></strong></td>
                        </tr>
                    <?php } ?>

                    <!--TABLE BODY-->
                    <tbody>
                        <!--VALUES-->
                        <tr>  
                            <td class="hover-red  " style="text-align: center; vertical-align: middle;">
                                <form method="post" class="form-horizontal" action="<?= base_url('jb_coa/school_ppe') ?>" style="display: inline;">
                                    <input type="hidden" name="ppe_list_id" value="<?= htmlspecialchars($row->id); ?>">
                                    <input type="hidden" name="article_id" value="<?= htmlspecialchars($row->ARTICLE_ID); ?>">

                                                                                                                                                                                                                                                                                                                                                                                <!-- <p> element with onclick event to submit the form -->
                                    <p class="submit-link" style="cursor: pointer; color: blue; margin: 0;" onclick="this.parentNode.submit();">
                                        <?= str_pad($row->id, 5, '0', STR_PAD_LEFT); ?>
                                    </p>
                                </form>
                            </td>
                            <td class="maxwidth-article"><?= ($row->ARTICLE) ?></td>
                            <td class="maxwidth-description"<?= ($row->is_existing == 0) ? ' style="color: red;"' : ''; ?>><?= ($row->DESCRIPTION) ?></td>
                            <!--<td><?= ($row->old_property_no_assigned) ?></td>-->
                            <!--<td><?= ($row->new_property_no_assigned) ?></td>-->
                            <td style="text-align: center;"><?= ($row->unit_of_measure) ?></td>
                            <td style="text-align: right;"><?= ($row->unit_value) ?></td>
                            <!--<td style="text-align: center;"><?= ($row->quantity_per_property_card) ?></td>-->
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
                                <td colspan="5" class="no-outline"></td>
                                <td colspan="1" style="text-align: left;">SUB TOTAL: </td>
                                <td style="text-align: right;"><?= ($row->SUM_PER_GROUP) ?></td>
                                <td colspan="2" class="no-outline"></td>
                            </tr>
                        <?php } ?>


                        <!--GRAND TOTAL-->
                        <?php if ($school_list_count_all == $row->_R4) { ?>
                            <?php $school_list_count_all = 0; ?>
                            <tr class="grand-total">
                                <td colspan="5" class="no-outline"></td>
                                <td colspan="1" style="text-align: left;"><strong>GRAND TOTAL: </strong></td>
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

                <form id="myForm" method="post" action="<?= base_url('jb_coa/school_ppe'); ?>">



                    <div class="row">
                        <div class="col-12"> 

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
                                    <label for="article" class="col-form-label">Article</label>
                                    <select id="article" name="article" required class="form-control">
                                        <option value="">Select</option> 
                                    </select>
                                </div>
                            </div>
                            <!--2--> 
                            <div class="form-row"> 
                                <!--2.1-->
                                <div class="form-group col-md-12">
                                    <label for="_des" class="col-form-label">Description</label>
                                    <input  id="_des" name="_des" type="text" class="form-control"  maxlength="255">
                                </div>
                            </div>
                            <!--3-->
                            <div class="form-row"> 
                                <!--3.1-->
                                <div class="form-group col-md-3">
                                    <label for="_opn" class="col-form-label">Old Property No.</label>
                                    <input  id="_opn" name="_opn" type="text" class="form-control" maxlength="255">
                                </div>
                                <!--3.2-->
                                <div class="form-group col-md-3">
                                    <label for="_npn" class="col-form-label">New Property No.</label>
                                    <input  id="_npn" name="_npn" type="text" class="form-control" maxlength="255">
                                </div>
                                <!--3.3-->
                                <div class="form-group col-md-3">
                                    <label for="_uom" class="col-form-label">Unit of Measure</label>
                                    <input  id="_uom" name="_uom" type="text" class="form-control" maxlength="255">
                                </div>
                                <!--3.4-->
                                <div class="form-group col-md-3">
                                    <label for="_uv" class="col-form-label">Unit Value</label>
                                    <input id="_uv" name="_uv" type="number" class="form-control" maxlength="16">
                                </div>
                            </div>
                            <!--4-->
                            <div class="form-row"> 
                                <!--4.1-->
                                <div class="form-group col-md-3">
                                    <label for="_qpproc" class="col-form-label">Quantity/Property Card</label>
                                    <input id="_qpproc" name="_qpproc" type="number" class="form-control" maxlength="16">
                                </div>
                                <!--4.2-->
                                <div class="form-group col-md-3">
                                    <label for="_qpphyc" class="col-form-label">Quantity/Physical Count</label>
                                    <input id="_qpphyc" name="_qpphyc" type="number" class="form-control" maxlength="16">
                                </div>
                                <!--4.3-->
                                <div class="form-group col-md-3">
                                    <label for="_tv" class="col-form-label">Total Value</label>
                                    <input id="_tv" name="_tv" type="number" class="form-control" maxlength="16">
                                </div>
                                <!--4.4-->
                                <div class="form-group">
                                    <label>Auto Close</label>
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



                            <button type="submit" name="action" value="save" id="submitBtn" class="btn btn-primary waves-effect width-md waves-light">Save Selection</button>

                        </div>
                    </div>


                </form>

                <!--END FORM-->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




<!--DROPDOWN GET ARTICLE BASE ON SELECTED GROUP-->
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

<!--SUBMIT FOR FOR UPDATE-->
<script>
    document.querySelectorAll('.submit-link').forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default action if needed
            this.closest('form').submit(); // Submit the closest form
        });
    });
</script>
