<!--DROPDOWN SCRIPT BASE ON SELECTED GROUP-->
<script src="<?= base_url(); ?>assets/js/jb/jquery-3.6.0.min.js"></script>

<h2>Cascading Dropdown with Submit</h2>
<form method="POST" action="<?= site_url('jb_coa/get_form_data_location') ?>">
    <div>
        <label for="region">Region:</label>
        <select id="region" name="region">
            <option value="">Select Region</option>
            <?php foreach ($regions as $region): ?>
                <option value="<?= $region->region_id ?>"><?= $region->name ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="province">Province:</label>
        <select id="province" name="province" disabled>
            <option value="">Select Province</option>
        </select>
    </div>

    <div>
        <label for="municipality">Municipality:</label>
        <select id="municipality" name="municipality" disabled>
            <option value="">Select Municipality</option>
        </select>
    </div>

    <div>
        <label for="barangay">Barangay:</label>
        <select id="barangay" name="barangay" disabled>
            <option value="">Select Barangay</option>
        </select>
    </div>
    <div>
        <button type="submit">Submit</button>
    </div>
</form>
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