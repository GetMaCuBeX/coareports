<form id="myForm" method="post" action="<?= site_url('jb_coa/update_selection/' . $existing_data->id); ?>">
    <div>
        <label for="group">Select Group:</label>
        <select id="group" name="group" required>
            <option value="">Select</option>
            <?php foreach ($groups as $row) { ?>
                <option value="<?= htmlspecialchars($row->id); ?>" <?= ($row->id == $existing_data->group_id) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($row->name); ?>
                </option> 
            <?php } ?>
        </select>
    </div>

    <div>
        <label for="article">Select Article:</label>
        <select id="article" name="article" required>
            <option value="">Select</option>
            <?php foreach ($articles as $row) { ?>
                <option value="<?= htmlspecialchars($row->id); ?>" <?= ($row->id == $existing_data->id) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($row->name); ?>
                </option> 
            <?php } ?>
        </select>
    </div>
    <button type="submit">Update Selection</button>
</form>

<!--DROPDOWN GET ARTICLE BASE ON SELECTED GROUP-->
<script src="<?= base_url(); ?>assets/js/jb/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // When a group is selected
        $('#group').change(function () {
            var groupId = $(this).val();
            $('#article').empty().append('<option value="">Select</option>');

            if (groupId) {
                $.ajax({
                    url: '<?= base_url('jb_coa/get_articles'); ?>', // Endpoint for fetching articles
                    type: 'GET',
                    data: {id: groupId},
                    success: function (data) {
                        var articles = JSON.parse(data);
                        articles.forEach(function (item) {
                            $('#article').append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>