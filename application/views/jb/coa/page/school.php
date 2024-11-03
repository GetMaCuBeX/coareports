<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">SCHOOLS</h4>
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
                <form id="schoolForm" action="<?php echo base_url('Jb_coa/school_ppe_annex_a'); ?>" method="post" target="_blank">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">   
                        <thead>
<!--                            <tr>
                                <th colspan="3" style="text-align: center;">SCHOOL INFORMATION</th>
                                <th colspan="4" style="text-align: center;">CONTACT DETAILS</th>
                            </tr>-->
                            <tr>
                                <th>DISTRICT:</th> 
                                <th>SCHOOL ID:</th>
                                <th>SCHOOL NAME:</th>
                                <th>SCHOOL ADMINISTRATOR:</th>
                                <th>MOBILE:</th>
                                <th>DEPED EMAIL:</th>
                                <th>PPE:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($rs)) {
                                foreach ($rs as $row) {
                                    echo '<tr>';
                                    echo '<td>' . ($row->DISTRICT) . '</td>';
                                    echo '<td>' . ($row->SCHOOLID) . '</td>';
                                    echo '<td>' . ($row->SCHOOLNAME) . '</td>';
                                    echo '<td>' . ($row->ADMINISTRATOR) . '</td>';
                                    echo '<td>' . ($row->CN) . '</td>';
                                    echo '<td>' . ($row->DEMAIL) . '</td>';

                                    // The View link calls the submit function
                                    echo '<td style="text-align: center;"><a href="#" class="hover-link" onclick="submitForm(' . ($row->SCHOOLID) . ')">View</a></td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr>';
                                echo '<td colspan="7" class="text-center">No data available</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="school_id" value="">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function submitForm(schoolId) {
        // Set the value of the hidden input to the clicked school's ID
        const hiddenInput = document.querySelector('input[name="school_id"]');
        if (hiddenInput) {
            hiddenInput.value = schoolId;
        }

        // Submit the form
        document.getElementById('schoolForm').submit();
    }
</script>

<style>
    .hover-link {
        color: blue; /* Default color */
        text-decoration: none; /* Remove underline */
    }

    .hover-link:hover {
        color: red; /* Change color on hover */
    }
</style>