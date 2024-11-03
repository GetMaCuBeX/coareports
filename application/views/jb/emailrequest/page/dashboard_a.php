<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">REQUEST DASHBOARD</h4>
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


<div class="row">
    <div class="col-xl-3 col-sm-6">
        <div class="card bg-primary">
            <div class="card-body widget-style-2">
                <div class="text-white media">
                    <div class="media-body align-self-center">
                        <h2 class="my-0 text-white"><span data-plugin="counterup"><?php echo isset($data['DAILY_REQUEST']) ? $data['DAILY_REQUEST'] : 0; ?></span></h2>
                        <p class="mb-0">DAILY</p>
                    </div>
                    <i class="ion-md-eye"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card bg-purple">
            <div class="card-body widget-style-2">
                <div class="text-white media">
                    <div class="media-body align-self-center">
                        <h2 class="my-0 text-white"><span data-plugin="counterup"><?php echo isset($data['MONTHLY_REQUEST']) ? $data['MONTHLY_REQUEST'] : 0; ?></span></h2>
                        <p class="mb-0">MONTHLY</p>
                    </div>
                    <i class="ion-md-paper-plane"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card bg-info">
            <div class="card-body widget-style-2">
                <div class="text-white media">
                    <div class="media-body align-self-center">
                        <h2 class="my-0 text-white"><span data-plugin="counterup"><?php echo isset($data['YEARLY_REQUEST']) ? $data['YEARLY_REQUEST'] : 0; ?></span></h2>
                        <p class="mb-0">YEARLY</p>
                    </div>
                    <i class="ion-ios-pricetag"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card bg-success">
            <div class="card-body widget-style-2">
                <div class="text-white media">
                    <div class="media-body align-self-center">
                        <h2 class="my-0 text-white"><span data-plugin="counterup"><?php echo isset($data['TOTAL_REQUEST']) ? $data['TOTAL_REQUEST'] : 0; ?></span></h2>
                        <p class="mb-0">TOTAL</p>
                    </div>
                    <i class="mdi mdi-comment-multiple"></i>
                </div>
            </div>
        </div>
    </div>
</div>