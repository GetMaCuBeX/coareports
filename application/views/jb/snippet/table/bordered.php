<?php if (!empty($data_key)): ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Bordered table</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                </tr>
                            </thead>
                            <tbody> 
                               
                                <?php foreach ($data_key as $row): ?> <!--FOREACH START-->
                                    <tr>
                                        <th scope="row">4</th>
                                        <td colspan="2">Larry the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                <?php endforeach; ?> <!--FOREACH END-->
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>No records found.</p>
<?php endif; ?> 