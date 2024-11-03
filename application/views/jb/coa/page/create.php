<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Dependent Dropdowns</title> 
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>

        <form id="myForm" method="post" action="<?= base_url('jb_coa/save_ppe_list'); ?>">
            <div>
                <label for="group">Select Group:</label>
                <select id="group" name="group" required>
                    <option value="">Select</option>
                    <?php foreach ($groups as $row) { ?>
                        <option value="<?= htmlspecialchars($row->id); ?>">
                            <?= htmlspecialchars($row->name); ?>
                        </option> 
                    <?php } ?>
                </select>
            </div>

            <div>
                <label for="article">Select Article:</label>
                <select id="article" name="article" required>
                    <option value="">Select</option>
                    <!-- This will be populated based on the first dropdown -->
                </select>
            </div>

            <button type="submit">Save Selection</button>
        </form>

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


    </body>
</html>
