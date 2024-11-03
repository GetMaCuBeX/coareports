<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"><?php echo $data->mis_emp_table_id; ?> - <?php echo $data->last_name . ", " . $data->first_name; ?></h4>
            <div class="page-title-right">
                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><?php echo date('F d, Y h:i A', strtotime($data->created_at)); ?></li> 
                </ol> 

            </div>
            <div class=" clearfix">
            </div>
        </div>
    </div>
</div> <!-- end page title -->




<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="header-title mb-4">Input Types</h4> -->

                <div class="row">
                    <div class="col-12">
                        <div class="">

                            <form method="post" class="form-horizontal"
                                  action="<?= base_url('c_emailrequest/save_updaterequest_emp') ?>">


                                <div class=" form-group row">
                                    <label class="col-lg-2 col-form-label">Concern:</label>
                                    <div class="col-lg-4">
                                        <input name="concern" type="text" id="concern"
                                               class="form-control" readonly value="<?php echo $data->concern; ?>">
                                    </div>
                                    <label class="col-lg-2 col-form-label">Plantilla:</label>
                                    <div class="col-lg-4">
                                        <input name="plantilla" type="text" class="form-control"   readonly=""  value="<?php echo $data->plantilla; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="example-textarea">Personal
                                        Message:</label>
                                    <div class="col-lg-10">
                                        <textarea name="concern_message" class="form-control" rows="5"
                                                  id="example-textarea"
                                                  readonly><?php echo $data->concern_message; ?></textarea>
                                    </div>
                                </div>
<!--                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="example-email">Email:</label>
                                    <div class="col-lg-4">
                                        <input name="personal_email" type="email" id="example-email"
                                               class="form-control" placeholder="" readonly
                                               value="<?php echo $data->personal_email; ?>">
                                    </div>
                                    <label class="col-lg-2 col-form-label" for="contact-number">Contact Number:</label>
                                    <div class="col-lg-4">
                                        <input name="contact_number" type="text" id="contact-number"
                                               class="form-control" readonly value="<?php echo $data->contact_number; ?>">
                                    </div>
                                </div>-->
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="example-email">DepEd Email:</label>
                                    <div class="col-lg-10">
                                        <input name="deped_email" type="email" id="example-email" class="form-control"
                                               placeholder="" readonly
                                               value="<?php echo $data->deped_email; ?>">
                                    </div>
                                </div>



                                <div class="form-group row">

                                    <label class="col-lg-2 col-form-label">Status:</label> 
                                    <div class="col-lg-4">
                                        <input name="status" type="text" id="status"
                                               class="form-control" readonly value="<?php echo $data->status; ?>">
                                    </div>



                                    <label class="col-lg-2 col-form-label" for="example-date">Response Date:</label>
                                    <div class="col-lg-4">
                                        <input name="response_date" class="form-control" id="example-date" type="date" readonly
                                               value="<?php
                                               // echo date('Y-m-d', strtotime($data->response_date)); 

                                               if (empty($data->response_date)) {
                                                   //echo date('Y-m-d');
                                               } else {
                                                   echo date('Y-m-d', strtotime($data->response_date));
                                               }
                                               ?>">
                                    </div>
                                </div>

                        </div>
<!--                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Process By:</label>
                            <div class="col-lg-10">
                                <input name="process_by" type="text" class="form-control" disabled="" value="Admin">
                            </div>
                        </div>-->
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="example-textarea">Response Message:</label>
                            <div class="col-lg-10">
                                <textarea name="response_message" class="form-control" rows="10" readonly
                                          id="example-textarea"><?php echo $data->response_message; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group text-right mb-0">
                            <!-- <input name="send_email" class="btn btn-pink waves-effect waves-light mr-1" type="submit" value="Send Email"> -->
                            <!-- <input name="update" class="btn btn-primary waves-effect waves-light mr-1" type="submit"
                                                                value="Update">
                                                        </input> -->

                            <input type="hidden" name="id" value="<?php echo $data->id; ?>">

                            <!-- Other form fields go here -->

                            <!-- <input type="submit" name="save_updaterequest" class="btn btn-primary">Save</input> -->
                            <!-- <input name="save_updaterequest" class="btn btn-success waves-effect width-md waves-light"
                                type="submit" value="Save">
                            </input> -->

                            <!-- <input name="cancel_updaterequest" type="submit"
                                class="btn btn-danger waves-effect width-md waves-light" value="Cancel">
                            </input> -->
                            <!--                            <button name="save_updaterequest" type="submit"
                                                                class="btn btn-success waves-effect width-md waves-light btn-md">
                                                            <i class="fas fa-save"></i>
                                                            <span>Save</span>
                                                        </button>-->

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
            <!-- end row -->

        </div>  <!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->


<script>
function autoExpand(textarea) {
    textarea.style.height = 'auto'; // Reset the height
    textarea.style.height = textarea.scrollHeight + 'px'; // Set to scrollHeight
}

// Call autoExpand on page load to set initial height based on content
window.onload = function() {
    const textarea = document.getElementById('example-textarea');
    autoExpand(textarea);
};
</script>