<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">DEPED EMAIL REQUEST</h4>
            <div class="page-title-right">

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div> <!-- end page title -->

<?php
echo form_open('jb_emailrequest/request', array(
    "method" => "POST",
    "class" => "form-class",
    "id" => "daterange-id",
    "enctype" => "multipart/form-data"
));
?>
<!--<form action="" method="post" class="" id="" enctype="multipart/form-data">-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <div class="form-group row mb-0">
                        <label class="col-lg-2 col-form-label" for="date_from">Start From:</label>
                        <div class="col-lg-3">
                            <input name="date_from" class="form-control" id="date_from" type="date"
                                   value="<?php echo isset($DATE_FROM) ? $DATE_FROM : ''; ?>"> 
                        </div>

                        <label class="col-lg-2 col-form-label" for="date_to">End To:</label>
                        <div class="col-lg-3 mb-3">
                            <input name="date_to" class="form-control" id="date_to" type="date"
                                   value="<?php echo isset($DATE_TO) ? $DATE_TO : ''; ?>">
                        </div>    

                        <div class="col-lg-2 text-right mb-0">
                            <button name="date_range" type="submit" class="btn btn-success waves-effect width-md waves-light btn-md" onclick="return validateDates()">
                                <i class="fas fa-search"></i>
                                <span>Submit</span>
                            </button>
                        </div>   
                    </div>     
                </div>   
            </div>   
        </div>   
    </div>    
<!--</form>-->
<?php echo form_close(); ?> <!-- END FORM -->

<script>
    function validateDates() {
        var dateFromInput = document.getElementById('date_from');
        var dateToInput = document.getElementById('date_to');

        var dateFrom = new Date(dateFromInput.value);
        var dateTo = new Date(dateToInput.value);

        // Check if both fields are filled
        if (!dateFromInput.value || !dateToInput.value) {
            Swal.fire({
                title: 'Error!',
                text: 'Please fill in both date fields.',
                icon: 'error',
                confirmButtonText: 'Okay'
            });
            return false; // Prevent form submission
        }

        // Check if date_from is greater than date_to
        if (dateFrom > dateTo) {
            Swal.fire({
                title: 'Error!',
                text: 'The start date cannot be greater than the end date.',
                icon: 'error',
                confirmButtonText: 'Okay'
            });
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>