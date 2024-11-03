<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">COMPLETE REQUEST</h4>
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
                <div class="form-group text-right mb-0">
                    <form method="post">
                        <!-- <a href="<?= base_url(); ?>c_emailrequest/create"
                            class="btn btn-primary waves-effect waves-light mr-1">Add</a> -->
                        <!-- <button type="button" class="btn btn-primary waves-effect waves-light "
                            onclick="window.location.href='<?= base_url('c_emailrequest/create') ?>'">
                            <i class='fas fa-plus'></i>
                            <span>Create</span>
                        </button> -->
                    </form>
                </div>

                <h2></h2>
                <!--<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">-->
                   <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    
                    <thead>
                        <tr>
                            <th style="width: 80px;">𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞:</th>
                            <th style="width: 80px;">𝐄𝐦𝐩𝐥𝐨𝐲𝐞𝐞 𝐈𝐃:</th>
                            <!-- <th>𝐌𝐞𝐬𝐬𝐚𝐠𝐞:</th> -->
                            <th>𝐂𝐨𝐧𝐜𝐞𝐫𝐧:</th>
                            <th style="width: 100px;">𝐒𝐭𝐚𝐭𝐮𝐬:</th>
                            <th style="width: 100px;">𝐑𝐞𝐪𝐮𝐞𝐬𝐭 𝐃𝐚𝐭𝐞:</th>
                            <!-- <th>Reply Message</th> -->
                            <!-- <th style="width: 80px;">𝐑𝐞𝐩𝐨𝐧𝐬𝐞 𝐃𝐚𝐭𝐞:</th> -->
                            <th style="width: 80px;">𝐋𝐚𝐬𝐭 𝐔𝐩𝐝𝐚𝐭𝐞:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $row) {
                            echo "<tr>";
                            echo "<td style='text-align: center;'>
								<form action='" . base_url('jb_emailrequest/updaterequest_c') . "' method='POST' style='display:inline;'>
									<input type='hidden' name='update_id' value='" . $row->id . "'>
									<button type='submit' class='btn btn-warning waves-effect waves-light'>
										<i class='fas fa-edit'></i>
										<span></span>
									</button>
								</form>	
								<form action='" . base_url('jb_emailrequest/deleterequest_c') . "' method='POST' style='display:inline;' class='delete-form' >
									<input type='hidden' name='delete_id' value='" . $row->id . "'>
									<button type='button' class='btn btn-danger waves-effect waves-light delete-button'>
										<i class='fas fa-trash'></i>
										<span></span>
									</button>
								</form>		
								<form action='" . base_url('jb_emailrequest/setisdonefalse') . "' method='POST' style='display:inline;' class='markundonerequest-form' >
									<input type='hidden' name='update_id' value='" . $row->id . "'>
									<button type='button' class='btn btn-secondary waves-effect waves-light markundonerequest-button'>
										<i class='fas fa-backspace'></i>
										<span></span>
									</button>
								</form>														
							</td>";
                            echo "<td style='text-align: right; vertical-align: middle;'>" . ($row->mis_emp_table_id) . "</td>";
                            // echo "<td style='text-align: left; vertical-align: middle; '>" . ($row->concern_message) . "</td>";
                            echo "<td style='text-align: left; vertical-align: middle;'>" . ($row->concern) . "</td>";
                            echo "<td style='text-align: left; vertical-align: middle;'>" . ($row->status) . "</td>";
                            echo "<td style='text-align: right; vertical-align: middle;'>" . (date('M. d, Y h:i A', strtotime($row->created_at))) . "</td>";

                            // echo "<td style='text-align: center;'>
                            // 	<button type='button' class='btn btn-info waves-effect waves-light' 
                            // 		onclick='window.location.href=\"" . base_url('jab_email/update?id=' . urlencode($row->id)) . "\"'>
                            // 		<i class='ion ion-md-create'></i>
                            // 		<span>Update</span>
                            // 	</button>
                            // </td>";
                            // echo "<td style='text-align: center;'>
                            // 	<form action='" . base_url('jab_email/delete') . "' method='POST' style='display:inline;'>
                            // 		<input type='hidden' name='delete_id' value='" . $row->id . "'>
                            // 		<button type='submit' class='btn btn-info waves-effect waves-light'>
                            // 			<i class='ion ion-md-create'></i>
                            // 			<span>Update</span>
                            // 		</button>
                            // 	</form>
                            // </td>";
                            // echo "<td>" . ($row->response_message) . "</td>";
                            // echo "<td style='text-align: right; vertical-align: middle;'>" . (empty($row->response_date) ? "" : date('M. d, Y', strtotime($row->response_date))) . "</td>";
                            echo "<td style='text-align: right; vertical-align: middle;'>" . (empty($row->updated_at) ? "" : date('M. d, Y h:i A', strtotime($row->updated_at))) . "</td>";
                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div> <!-- start row -->
