<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">ANNEX A</h4>
            <div class="page-title-right">
                <ol class="breadcrumb p-0 m-0">
                    <!--<li class="breadcrumb-item"><a href="<?php //echo base_url();    ?>jb_coa/school_ppe_annex_a_all_division" target="_blank">Print All</a></li>-->
                    <!--<li class="breadcrumb-item"><a href="#">Dashboard</a></li>-->
                    <!--<li class="breadcrumb-item active">Dashboard 3</li>-->
                </ol> 
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
                <!--FORM 1-->
                <form id="schoolForm" action="<?php echo base_url('Jb_coa/school_ppe_annex_a'); ?>" method="post">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">   
                        <thead>
                            <tr>
                                <th>DISTRICT:</th> 
                                <th>SCHOOL ID:</th>
                                <th>SCHOOL NAME:</th>
                                <th>SCHOOL ADMINISTRATOR:</th> 
                                <th>TOTAL VALUE</th>
                                <th>PPE:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($rs)) { ?>
                                <?php foreach ($rs as $row) { ?>
                                    <tr>
                                        <td><?= ($row->DISTRICT) ?></td>
                                        <td><?= ($row->SCHOOLID) ?></td>
                                        <td><?= ($row->SCHOOLNAME) ?></td>
                                        <td><?= ($row->ADMINISTRATOR) ?></td> 
                                        <td style="text-align: right"><?= ($row->_R4) ?></td>
                                        <td style="text-align: center;">
                                            <a href="#" class="hover-link" onclick="submitSchoolForm('<?= htmlspecialchars($row->SCHOOLID) ?>'); return false;">View</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="6" class="text-center">No data available</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="school_id" value="">
                </form>
            </div>
        </div>
    </div>
</div>




<!-- FORM 2 -->
<form id="districtForm" action="<?php echo base_url('Jb_coa/school_ppe_annex_a_district'); ?>" method="post" style="display:none;">
    <input type="hidden" name="district_id" value="">
</form>


<?php if (!empty($rs)) { ?>
    <div class="row">


        <?php $school_counts = 0; ?>


        <!--START FOREACH-->
        <?php foreach ($rs as $row): ?> 
            <?php if ($row->_R5 == 1) { ?>

                <?php $school_counts += $row->_DISTRICT_SCHOOLCOUNT; ?>
                <div class="col-md-4"> 
                    <div class="card <?= ($row->CONG_DISTRICT == 1) ? 'bg-primary' : 'bg-purple' ?>">
                        <div class="card-body widget-style-1">
                            <div class="text-white media">
                                <div class="media-body align-self-center">
                                    <h2 class="my-0 text-white" style="text-align: right"><span data-plugin="counterup"><?= $row->_R3 ?></span></h2>
                                    <p class="mb-0" style="text-align: right"><strong><a href="#" class="hover-link" onclick="submitDistrictForm('<?= htmlspecialchars($row->DISTRICT_ID) ?>'); return false;"><?= htmlspecialchars($row->DISTRICT) ?></a> - <?= $row->_DISTRICT_SCHOOLCOUNT ?></strong></p>

                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php endforeach; ?>   <!--END FOREACH-->

        <div class="col-md-12 ">
            <div class="card bg-success">
                <div class="card-body widget-style-2">
                    <div class="text-white media">
                        <div class="media-body align-self-center">
                            <h2 class="my-0 text-white" style="text-align: right"><span data-plugin="counterup"><?= $row->_R2 ?></span></h2>
                            <p class="mb-0" style="text-align: right"><strong><?= $row->DIVISION_NAME ?> - <?= $school_counts ?></strong></p> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <?php
} else {
    echo "No data available"; // Handle case when there is no data
}
?>





<!-- JavaScript for AJAX form submission -->
<script>


    function submitDistrictForm(districtId) {
        const form = document.getElementById('districtForm'); // Ensure you have the correct form ID
        const hiddenInput = form.querySelector('input[name="district_id"]');
        hiddenInput.value = districtId;

        // Create a new FormData object from the form
        const formData = new FormData(form);

        // AJAX call
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
                .then(response => {
                    if (response.ok) {
                        return response.text(); // Get the response as text
                    } else {
                        throw new Error('Network response was not ok.');
                    }
                })
                .then(data => {
                    // Open the data in a new tab
                    const newTab = window.open();
                    newTab.document.write(data); // Write the response data to the new tab
                    newTab.document.close(); // Close the document to finish loading
                })
                .catch(error => console.error('Error:', error));
    }

    function submitSchoolForm(schoolId) {
        const form = document.getElementById('schoolForm');
        const hiddenInput = form.querySelector('input[name="school_id"]');
        hiddenInput.value = schoolId;

        // Perform AJAX request
        fetch(form.action, {
            method: 'POST',
            body: new FormData(form)
        })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    // Open the response in a new tab
                    const newTab = window.open();
                    newTab.document.write(data);
                    newTab.document.title = "&nbsp;".replace(/&nbsp;/g, "\u00A0");
                    newTab.document.close();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An error occurred: " + error.message);
                });
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