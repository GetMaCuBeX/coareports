<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">CREATE REQUEST</h4>
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

<style>
    div.error{
        color:red;
    }
</style>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="header-title mb-4">Input Types</h4> -->
                <div class="row">
                    <d class="col-12">
                        <div class="">
                            <form method="post" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Employee ID:</label>
                                    <div class="col-lg-3">
                                        <input name="mis_emp_table_id" type="text" class="form-control" readonly=""
                                               placeholder="Employee ID" value="<?php echo $data->IDNumber; ?>">
                                    </div>
                                    <label class="col-lg-1 col-form-label" for="example-date"></label>
                                    <div class="col-lg-2">
                                        <!-- <input name="request_date" class="form-control" readonly="" id="example-date" type="date" value="<?php echo date('Y-m-d'); ?>"> -->
                                    </div>
                                    <label class="col-lg-2 col-form-label">School ID:</label>
                                    <div class="col-lg-2">
                                        <input name="school_id" type="text" class="form-control" readonly=""
                                               placeholder="School ID" value="<?php echo $data->schoolID; ?>">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Firstname:</label>
                                    <div class="col-lg-4">
                                        <input name="first_name" type="text" class="form-control" readonly=""  value="<?php echo $data->FirstName; ?>">
                                    </div>
                                    <label class="col-lg-2 col-form-label">Lastname:</label>
                                    <div class="col-lg-4">
                                        <input name="last_name" type="text" class="form-control" readonly="" value="<?php echo $data->LastName; ?>">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Concern:</label>
                                    <div class="col-lg-4">
                                        <select name="concern" class="form-control"> 
                                            <option>CREATE</option>
                                            <option>RESET - GMAIL DEPED ACCOUNT</option>
                                            <option>RESET - MSO365 DEPED ACCOUNT</option>
                                            <option>RESET - BOTH</option>
                                            <option>OTHER</option> 
                                        </select>
                                    </div>

                                    <label class="col-lg-2 col-form-label">Plantilla:</label>
                                    <div class="col-lg-4">
                                        <input name="plantilla" type="text" class="form-control" readonly=""  value="<?php echo $data->empPosition; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="example-textarea">Personal
                                        Message:</label>
                                    <div class="col-lg-10">
                                        <textarea name="concern_message" class="form-control" rows="5"
                                                  id="example-textarea"
                                                  placeholder="Enter your personal message here..." maxlength="6000"></textarea> 
                                                  <?php echo form_error("concern_message", "<div class='error'>", "</div>"); ?>
                                    </div>
                                </div>
                                <!--                                <div class="form-group row">
                                                                    <label class="col-lg-2 col-form-label" for="example-email">Email:</label>
                                                                    <div class="col-lg-6">
                                                                        <input name="personal_email" type="email" id="example-email"
                                                                               class="form-control" placeholder="Personal Email" maxlength="250">
                                <?php echo form_error("personal_email", "<div class='error'>", "</div>"); ?>
                                                                    </div>
                                                                    <label class="col-lg-2 col-form-label" for="contact-number">Contact Number:</label>
                                                                    <div class="col-lg-2">
                                                                        <input name="contact_number" maxlength="11" type="text" id="contact-number" class="form-control" placeholder="Contact #" value="<?php echo $data->empMobile; ?>">
                                
                                                                    </div>
                                                                </div>-->
                                <div class="form-group row">
                                    <!--echo $data->empEmail-->
                                    <label class="col-lg-2 col-form-label " for="example-email">DepEd Email:</label>
                                    <div class="col-lg-10">
                                        <input name="deped_email" maxlength="250" type="email" id="example-email" class="form-control" placeholder="DepEd Email (Reset Request)" value="">
                                        <?php echo form_error("deped_email", "<div class='error'>", "</div>"); ?>
                                    </div>
                                </div>





                                <div class="form-group text-right mb-0">
                                    <!-- <input name="save" class="btn btn-primary waves-effect waves-light mr-1"
                                        type="submit" value="Submit Request"> </input>
                                    <input name="cancel" type="submit" class="btn btn-danger waves-effect waves-light"
                                        value="Cancel"> </input> -->
                                    <button name="save" type="submit"
                                            class="btn btn-success waves-effect width-md waves-light btn-md">
                                        <!--<i class="fas fa-save"></i>-->
                                        <span>Save</span>
                                    </button>

<!--                                    <button name="cancel" type="submit"
                                            class="btn btn-danger waves-effect width-md waves-light btn-md">
                                        <i class="fas fa-times"></i>
                                        <span>Cancel</span>
                                    </button> -->
                  
                                    <button name="cancel_updaterequest" type="button" onclick="window.history.back();"
                                            class="btn btn-danger waves-effect width-md waves-light btn-md">
                                        <!--<i class="fas fa-times"></i>-->
                                        <span>Back</span>
                                    </button>


                                </div>
                            </form>

                        </div>

                </div>
            </div>
        </div>
        <!-- end row -->

    </div>

    <!-- end card -->

    <!-- end col -->
</div> <!-- end row -->