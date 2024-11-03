<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">PPE LIST</h4>
            <div class="page-title-right">
                <!-- <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">Velonic</a></li>
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Dashboard 3</li>
                </ol> -->
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div> <!-- end page title -->


<!-- start row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive"> 
                <h2></h2> 
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>DISTRICT: </th>
                            <th>SCHOOL ID: </th>
                            <th>SCHOOL NAME: </th>
                            <th>Article: </th>
                            <th tyle="width: 130px;">Description: </th>
                            <th>Old Property No.: </th>
                            <th>New Property No.: </th>
                            <th>Unit of Measure: </th>
                            <th>Unit Value: </th>
                            <th>Quantity (Property Card): </th>
                            <th>Quantity (Physical Count): </th>
                            <th>Total Value: </th>
                            <th>Date Acquired: </th>
                            <th>Condition: </th>
                            <th>Remarks: </th>
                            <th>Is Existing: </th>
                            <th>Person Accountable: </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $group_count = 0;
                        $school_list_count_all = 0;

                        if (!empty($rs)) {
                            foreach ($rs as $row) {
//                                
//                                if ($school_list_count_all == 0) {
//                                    echo '<tr>';
//                                    echo '<td colspan="18" style="border: none; color: blue;"><strong>' . strtoupper($row->DISTRICT) . '</strong></td>';
//                                    echo '</tr>';
//                                    echo '<tr>';
//                                    echo '<td colspan="18" style="border: none; color: green;"><strong>' . ($row->SCHOOLID) . ' - ' . strtoupper($row->SCHOOLNAME) . '</strong></td>';
//                                    echo '</tr>';
//                                }
//                                if ($row->_R2 == 1) {
//                                    echo '<tr>';
//                                    echo '<td colspan="18" style="border: none;"><strong>' . strtoupper($row->GROUP_NAME) . '</strong></td>';
//                                    echo '</tr>';
//                                }
//                                
                                echo '<tr>';
                                echo '<td>' . ($row->DISTRICT) . '</td>';
                                echo '<td>' . ($row->SCHOOLID) . '</td>';
                                echo '<td>' . ($row->SCHOOLNAME) . '</td>';
                                echo '<td>' . ($row->ARTICLE) . '</td>';
                                echo '<td text-align: left;">' . ($row->DESCRIPTION) . '</td>';
                                echo '<td>' . ($row->old_property_no_assigned) . '</td>';
                                echo '<td>' . ($row->new_property_no_assigned) . '</td>';
                                echo '<td>' . ($row->unit_of_measure) . '</td>';
                                echo '<td style="text-align: right;">' . ($row->unit_value) . '</td>';
                                echo '<td>' . ($row->quantity_per_property_card) . '</td>';
                                echo '<td>' . ($row->quantity_per_physical_count) . '</td>';
                                echo '<td style="text-align: right;">' . ($row->total_value) . '</td>';
                                echo '<td>' . ($row->date_acquired) . '</td>';
                                // echo '<td>' . ($row->localtion_whereabouts) . '</td>';
                                echo '<td>' . ($row->condition_name) . '</td>';
                                echo '<td>' . ($row->remarks) . '</td>';
                                echo '<td style="background-color:' . ($row->is_existing == 0 ? 'red' : 'transparent') . '; text-align: center;">' . $row->is_existing . '</td>';
                                echo '<td>' . ($row->PERSON_ACCOUNTABLE) . '</td>';
                                echo '</tr>';
                                $group_count++;
                                $school_list_count_all++;

//                                if ($group_count == $row->_R3) {
//                                    $group_count = 0;
//                                    echo '<tr>';
//                                    echo '<td style="border: none; "></td>';
//                                    echo '<td style="border: none; "></td>';
//                                    echo '<td style="border: none; "></td>';
//                                    echo '<td style="border: none; "></td>';
//                                    echo '<td style="border: none; "></td>';
//                                    echo '<td style="border: none; "></td>';
//                                    echo '<td style="border: none; "></td>';
//                                    echo '<td>SUB TOTAL</td>';
//                                    echo '<td style="text-align: right;">' . ($row->SUM_PER_GROUP) . '</td>';
//                                    echo '<td style="border: none; "></td>';
//                                    echo '<td style="border: none; "></td>';
//                                    echo '<td style="border: none; "></td>';
//                                    echo '<td style="border: none; "></td>';
//                                    echo '<td style="border: none; "></td>';
//                                    echo '</tr>';
//                                }
//                                if ($school_list_count_all == $row->_R4) {
//                                    $school_list_count_all = 0;
//
//                                    echo '<tr>';
//                                    echo '<td style="border: none;"></td>';
//                                    echo '<td style="border: none;"></td>';
//                                    echo '<td style="border: none;"></td>';
//                                    echo '<td style="border: none;"></td>';
//                                    echo '<td style="border: none;"></td>';
//                                    echo '<td style="border: none;"></td>';
//                                    echo '<td style="border: none;"></td>';
//                                    echo '<td><strong>GRAND TOTAL</strong></td>';
//                                    echo '<td style="text-align: right;"><strong>' . ($row->GRAND_TOTAL) . '</strong></td>';
//                                    echo '<td  style="border: none;"></td>';
//                                    echo '<td  style="border: none;"></td>';
//                                    echo '<td  style="border: none;"></td>';
//                                    echo '<td  style="border: none;"></td>';
//                                    echo '<td  style="border: none;"></td>';
//                                    echo '</tr>';
//
//                                    echo '<tr>';
//                                    echo '<td  style="border: none;"></td>';
//                                    echo '</tr>';
//                                    echo '<tr>';
//                                    echo '<td  style="border: none;"></td>';
//                                    echo '</tr>';
//                                    echo '<tr>';
//                                    echo '<td   style="border: none;"></td>';
//                                    echo '</tr>';
//                                }
                            }
                        } else {
                            echo '<tr>';
                            echo '<td colspan="18" class="text-center">No data available</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





