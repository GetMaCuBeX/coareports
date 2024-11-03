<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">UPDATE REQUEST</h4>
            <div class="page-title-right">
                <!-- <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">Velonic</a></li>
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Dashboard 3</li>
                </ol> -->

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
                                action="<?= base_url('jb_emailrequest/save_updaterequest') ?>">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Employee ID:</label>
                                    <div class="col-lg-4">
                                        <input name="employee_id" type="text" class="form-control" readonly=""
                                            value="<?php echo $data->mis_emp_table_id; ?>">
                                    </div>
                                    <label class="col-lg-2 col-form-label" for="example-date">Request Date:</label>
                                    <div class="col-lg-4">
                                        <input name="created_at" type="text" class="form-control"
                                            style="text-align: right;" readonly=""
                                            value="<?php echo date('M. d, Y h:i A', strtotime($data->created_at)); ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">School ID:</label>
                                    <div class="col-lg-4">
                                        <input name="school_id" type="text" class="form-control" readonly=""
                                            value="<?php echo $data->school_id; ?>">
                                    </div>
                                    <label class="col-lg-2 col-form-label">Plantilla:</label>
                                    <div class="col-lg-4">
                                        <input name="plantilla" type="text" class="form-control" readonly=""
                                            value="<?php echo $data->plantilla; ?>">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Firstname:</label>
                                    <div class="col-lg-4">
                                        <input name="first_name" type="text" class="form-control" readonly=""
                                            value="<?php echo $data->first_name; ?>">
                                    </div>
                                    <label class="col-lg-2 col-form-label">Lastname:</label>
                                    <div class="col-lg-4">
                                        <input name="last_name" type="text" class="form-control" readonly=""
                                            value="<?php echo $data->last_name; ?>">
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label class="col-lg-2 col-form-label">Concern:</label>
                                    <div class="col-lg-4">
                                        <select name="request_type" class="form-control" disabled="">
                                            <option>CREATE</option>
                                            <option>RESET - GMAIL DEPED ACCOUNT</option>
                                            <option>RESET - MSO365 DEPED ACCOUNT</option>
                                            <option>RESET - BOTH</option>
                                            <option>OTHER</option>
                                        </select>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Plantilla:</label>
                                    <div class="col-lg-4">
                                        <input name="plantilla" type="text" class="form-control" readonly=""
                                            value="<?php echo $data->plantilla; ?>">
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
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="example-email">Email:</label>
                                    <div class="col-lg-4">
                                        <input name="personal_email" type="email" id="example-email"
                                            class="form-control" placeholder="Personal Email" readonly
                                            value="<?php echo $data->personal_email; ?>">
                                    </div>
                                    <label class="col-lg-2 col-form-label" for="contact-number">Contact Number:</label>
                                    <div class="col-lg-4">
                                        <input name="contact_number" type="text" id="contact-number"
                                            class="form-control" readonly value="<?php echo $data->contact_number; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="example-email">DepEd Email:</label>
                                    <div class="col-lg-10">
                                        <input name="deped_email" type="email" id="example-email" class="form-control"
                                            placeholder="DepEd Email (Optional)" readonly
                                            value="<?php echo $data->deped_email; ?>">
                                    </div>
                                </div>



                                <div class="form-group row">

                                    <label class="col-lg-2 col-form-label">Status:</label>
                                    <div class="col-lg-4">
                                        <select name="status" class="form-control">
                                            <option>COMPLETED</option>
                                            <option>ON PROCESS</option>
                                            <option>INVALID REQUEST</option>
                                        </select>
                                    </div>
                                    <label class="col-lg-2 col-form-label" for="example-date">Response Date:</label>
                                    <div class="col-lg-4">
                                        <input name="response_date" class="form-control" id="example-date" type="date"
                                            value="<?php
                                               // echo date('Y-m-d', strtotime($data->response_date)); 

                                               if (empty($data->response_date)) {
                                                   echo date('Y-m-d');
                                               } else {
                                                   echo date('Y-m-d', strtotime($data->response_date));
                                               }
                                               ?>">
                                    </div>
                                </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Process By:</label>
                            <div class="col-lg-10">
                                <input name="process_by" type="text" class="form-control" disabled="" value="Admin">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="example-textarea">Response Message:</label>
                            <div class="col-lg-10">
                                <textarea name="response_message" class="form-control" rows="5"
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
                            <button name="save_updaterequest" type="submit"
                                class="btn btn-success waves-effect width-md waves-light btn-md">
                                <!--<i class="fas fa-save"></i>-->
                                <span>Save</span>
                            </button>

                            <!--                            <button name="cancel_updaterequest" type="submit"
                                    class="btn btn-danger waves-effect width-md waves-light btn-md">
                                <i class="fas fa-times"></i>
                                <span>Cancel</span>
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


        </div> <!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->
