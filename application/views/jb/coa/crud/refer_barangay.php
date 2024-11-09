<!--DROPDOWN SCRIPT BASE ON SELECTED GROUP-->
<script src="<?= base_url(); ?>assets/js/jb/jquery-3.6.0.min.js"></script>
<!--PAGE TITLE START-->
<div class="row">
    <div class="col-12">
        <div class="page-title-box"> 
            <h4 class="page-title">DROPDOWN WITH SUBMIT</h4>
            <div class="clearfix"></div> 
        </div>
    </div>
</div> <!--PAGE TITLE END-->

<div class="row"> <!--ROW START-->
    <div class="col-12"> <!--COL START-->
        <div class="card"> <!--CARD BODY START-->
            <div class="card-body"> <!--CARD BODY START-->


                <form method="POST" action="<?= site_url('jb_coa/get_form_data_location') ?>">
                    <div>
                        <label for="region" class="col-form-label">Region:</label>
                        <select id="region" name="region" class="form-control" required>
                            <option value="">Select Region</option>
                            <?php foreach ($regions as $region): ?>
                                <option value="<?= $region->region_id ?>"><?= $region->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="province" class="col-form-label">Province:</label>
                        <select id="province" name="province" disabled class="form-control" required>
                            <option value="">Select Province</option>
                        </select>
                    </div>

                    <div>
                        <label for="municipality" class="col-form-label">Municipality:</label>
                        <select id="municipality" name="municipality" disabled class="form-control" required>
                            <option value="">Select Municipality</option>
                        </select>
                    </div>

                    <div>
                        <label for="barangay" class="col-form-label">Barangay:</label>
                        <select id="barangay" name="barangay" disabled class="form-control" required>
                            <option value="">Select Barangay</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <button type="submit" class="btn btn-primary waves-effect width-md waves-light">Submit</button>
                    </div>
                </form>


            </div> <!--CARD BODY END-->
        </div> <!--CARD END-->
    </div> <!--COL END-->
</div> <!--ROW END-->


<script type="text/javascript">
    $(document).ready(function () {
        // When Region changes
        $('#region').change(function () {
            var regionId = $(this).val();
            if (regionId) {
                $.ajax({
                    url: "<?= site_url('jb_coa/get_provinces/') ?>" + regionId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var provinceDropdown = $('#province');
                        provinceDropdown.empty().append('<option value="">Select Province</option>');  // Clear existing options
                        $.each(data, function (i, province) {
                            provinceDropdown.append('<option value="' + province.province_id + '">' + province.name + '</option>');
                        });
                        provinceDropdown.prop('disabled', false);  // Enable the Province dropdown
                    }
                });
            } else {
                $('#province').prop('disabled', true).empty().append('<option value="">Select Province</option>');
                $('#municipality').prop('disabled', true).empty().append('<option value="">Select Municipality</option>');
                $('#barangay').prop('disabled', true).empty().append('<option value="">Select Barangay</option>');
            }
        });

        // When Province changes
        $('#province').change(function () {
            var provinceId = $(this).val();
            if (provinceId) {
                $.ajax({
                    url: "<?= site_url('jb_coa/get_municipalities/') ?>" + provinceId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var municipalityDropdown = $('#municipality');
                        municipalityDropdown.empty().append('<option value="">Select Municipality</option>');
                        $.each(data, function (i, municipality) {
                            municipalityDropdown.append('<option value="' + municipality.city_municipality_id + '">' + municipality.name + '</option>');
                        });
                        municipalityDropdown.prop('disabled', false);  // Enable the Municipality dropdown
                    }
                });
            } else {
                $('#municipality').prop('disabled', true).empty().append('<option value="">Select Municipality</option>');
                $('#barangay').prop('disabled', true).empty().append('<option value="">Select Barangay</option>');
            }
        });

        // When Municipality changes
        $('#municipality').change(function () {
            var cityMunicipalityId = $(this).val();
            if (cityMunicipalityId) {
                $.ajax({
                    url: "<?= site_url('jb_coa/get_barangays/') ?>" + cityMunicipalityId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var barangayDropdown = $('#barangay');
                        barangayDropdown.empty().append('<option value="">Select Barangay</option>');
                        $.each(data, function (i, barangay) {
                            barangayDropdown.append('<option value="' + barangay.barangay_id + '">' + barangay.name + '</option>');
                        });
                        barangayDropdown.prop('disabled', false);  // Enable the Barangay dropdown
                    }
                });
            } else {
                $('#barangay').prop('disabled', true).empty().append('<option value="">Select Barangay</option>');
            }
        });
    });
</script>