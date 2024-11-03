<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>&nbsp;</title> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.ico">
        <style>
            /*https://www.docuseal.co/blog/css-print-page-style*/
            @media print {
                @page {
                    /*                    size: A4 landscape;*/
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

        </style>
    </head>


    <body>
        <div class="page-container">
            <div style="text-align: right;">
                <!-- Print Button -->
                <button onclick="window.print()" class="no-print">Print this page</button>

            </div>

            <?php $group_count = 0; ?>

            <?php $school_list_count_all = 0; ?>

            <?php if (!empty($rs)): ?>

                <p class="table-title" style="margin-bottom: 5px; margin-left: 1px; font-size: 10px; text-align: left; vertical-align: middle; ">PPE - ANNEX C</p>
                <table>

                    <!--START FOREACH-->
                    <?php foreach ($rs as $row): ?>

                        <!--HEADERS-->
                        <?php if ($school_list_count_all == 0) { ?>
                            <thead>
                                <tr>
                                    <td colspan="12" style="font-size: 18px; text-align: center; vertical-align: middle; border: none;">
                                        <a><strong>DEPARTMENT OF EDUCATION</strong></a>
                                    </td> 

                                </tr> 


                                <tr style="text-align: center;">
                                    <th class="maxwidth-article">Group / Article</th>
                                    <th class="maxwidth-description">Description</th>
                                    <th>Old Prty. No.</th>
                                    <th>Person Accountable</th>
                                    <th>Unit Value</th>
                                    <th>Total Value</th>
                                    <th>Date Acquired</th>
                                    <th>Condition</th>
                                    <th class="maxwidth-remarks">Remarks</th> 
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
                                <td colspan="9" style="color: red; " class="no-outline"><strong><?= strtoupper($row->GROUP_NAME) ?></strong></td>
                            </tr>
                        <?php } ?>


                        <!--TABLE BODY-->
                        <tbody>
                            <!--VALUES-->
                            <tr>
                                <td class="maxwidth-article"><?= ($row->ARTICLE) ?></td>
                                <td class="maxwidth-description"<?= ($row->is_existing == 0) ? ' style="color: red;"' : ''; ?>><?= ($row->DESCRIPTION) ?></td>
                                <td><?= ($row->old_property_no_assigned) ?></td>
                                <td><?= ($row->PERSON_ACCOUNTABLE) ?></td>
                                <td style="text-align: right;"><?= ($row->unit_value) ?></td> 
                                <td style="text-align: right; <?= ($row->is_existing == 0) ? ' color: red;' : ''; ?>"><?= ($row->total_value) ?></td>
                                <td style="text-align: center;"><?= ($row->date_acquired) ?></td>
                                <td><?= ($row->condition_name) ?></td>
                                <td><?= ($row->remarks) ?></td> 
                            </tr>

                            <?php $group_count++; ?>
                            <?php $school_list_count_all++; ?>


                            <!--SUB TOTAL-->
                            <?php if ($group_count == $row->_R3) { ?>
                                <?php $group_count = 0; ?>
                                <tr>
                                    <td colspan="4" class="no-outline"></td>
                                    <td colspan="1" style="text-align: left;">SUB TOTAL: </td>
                                    <td style="text-align: right;"><?= ($row->SUM_PER_GROUP) ?></td>
                                    <td colspan="3" class="no-outline"></td>
                                </tr>
                            <?php } ?>


                            <!--GRAND TOTAL-->
                            <?php if ($school_list_count_all == $row->_R4) { ?>
                                <?php $school_list_count_all = 0; ?>
                                <tr class="grand-total">
                                    <td colspan="4" class="no-outline"></td>
                                    <td colspan="1" style="text-align: left;"><strong>GRAND TOTAL: </strong></td>
                                    <td style="text-align: right; color: red;"><strong><?= ($row->GRAND_TOTAL) ?></strong></td>
                                    <td colspan="3" class="no-outline"></td>
                                </tr>


                                <!--EXTRA COLUMN-->
                                <tr class="grand-total">
                                    <td colspan="9" >&nbsp;</td>
                                </tr>
                            <?php } ?> 
                        </tbody>
                    <?php endforeach; ?>   <!--END FOREACH-->
                </table>
            <?php else: ?>
                <p>No records found.</p>
            <?php endif; ?> 



            <footer>
                <table class="signature-area">
                    <thead class="no-outline"> 
                        <tr class="no-outline">
                            <th colspan="9" class="no-outline">&nbsp;</th> 
                        </tr> 
                    </thead>
                    <tbody class="no-outline">
                        <tr>
                            <td colspan="9" class="no-outline">&nbsp;PREPARED BY:</td> 
                        </tr> 

                        <tr>
                            <!--LEFT--> 
                            <td colspan="2" class="no-outline"> 
                                <div contenteditable="true" 
                                     style="border: none; outline: none; width: 100%; text-align: center; font-weight: bold;
                                     padding: 5px; background-color: transparent;" 
                                     placeholder="NAME">
                                    FULL NAME
                                </div>
                            </td> 


                            <!--MIDDLE--> 
                            <td colspan="2" class="no-outline"> 
                                <div contenteditable="true" 
                                     style="border: none; outline: none; width: 100%; text-align: center; font-weight: bold;
                                     padding: 5px; background-color: transparent;" 
                                     placeholder="">

                                </div>
                            </td> 

                            <!--RIGHT--> 
                            <td colspan="2" class="no-outline">
                                <div contenteditable="true" 
                                     style="border: none; outline: none; width: 100%; text-align: center; font-weight: bold;
                                     padding: 5px; background-color: transparent;" 
                                     placeholder="NAME">
                                    FULL NAME
                                </div>
                            </td> 
                        </tr> 

                        <tr>
                            <!--LEFT-->
                            <td colspan="2" class="no-outline">
                                <div contenteditable="true" 
                                     style="border: none; outline: none; width: 100%; text-align: center;
                                     padding: 5px; background-color: transparent;" 
                                     placeholder="Enter text here">
                                    Concerned Inventory Committee Member
                                </div>
                            </td> 


                            <td colspan="2" class="no-outline">
                                <div contenteditable="true" 
                                     style="border: none; outline: none; width: 100%; text-align: center;
                                     padding: 5px; background-color: transparent;" 
                                     placeholder="">
                                </div>
                            </td> 

                            <!--RIGHT--> 
                            <td colspan="2" class="no-outline">
                                <div contenteditable="true" 
                                     style="border: none; outline: none; width: 100%; text-align: center;
                                     padding: 5px; background-color: transparent;" 
                                     placeholder="Enter text here">
                                    Chairman, Inventory Committee
                                </div>
                            </td> 
                        </tr> 
                    </tbody>
                </table> 
            </footer>  
        </div> 
    </body>
</html>

