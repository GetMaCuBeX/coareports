</div> <!-- end container-fluid -->
</div> <!-- end content --> 
<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                2024 - 2025 © Velonic theme</a>
            </div>
        </div>
    </div>
</footer> <!-- end Footer -->
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

</div> <!-- END wrapper -->

<!--1. VENDOR JS-->
<script src="<?= base_url(); ?>assets/js/vendor.min.js"></script>


<!--2 PLUGINS JS-->
<script src="<?= base_url(); ?>assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/switchery/switchery.min.js"></script> 

<script src="<?= base_url(); ?>assets/libs/select2/select2.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script> 
<script src="<?= base_url(); ?>assets/libs/switchery/switchery.min.js"></script>

<script src="<?= base_url(); ?>assets/js/pages/dashboard.init.js"></script> 

<!-- Sparkline charts -->
<script src="<?= base_url(); ?>assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/jquery-scrollto/jquery.scrollTo.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="<?= base_url(); ?>assets/js/pages/sweet-alerts.init.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url(); ?>assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Buttons examples -->
<script src="<?= base_url(); ?>assets/libs/datatables/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>assets/libs/datatables/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/datatables/buttons.print.min.js"></script>

<!-- Responsive examples -->
<script src="<?= base_url(); ?>assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/datatables/dataTables.keyTable.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/datatables/dataTables.select.min.js"></script>

<!-- Datatables init -->
<script src="<?= base_url(); ?>assets/js/pages/datatables.init.js"></script>

<!-- Chat app -->
<script src="<?= base_url(); ?>assets/js/pages/jquery.chat.js"></script>

<!-- Todo app -->
<script src="<?= base_url(); ?>assets/js/pages/jquery.todo.js"></script>

<!--Morris Chart-->
<script src="<?= base_url(); ?>assets/libs/morris-js/morris.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/raphael/raphael.min.js"></script>

<!-- Dashboard init JS -->
<script src="<?= base_url(); ?>assets/js/pages/dashboard3.init.js"></script> 

<!-- SweetAlert2 script -->
<script src="<?= base_url(); ?>assets/js/pages/sweetalert2@11.js"></script>

<!-- Responsive Table js -->
<script src="<?= base_url(); ?>assets/libs/rwd-table/rwd-table.min.js"></script>

<!-- Init js -->
<script src="<?= base_url(); ?>assets/js/pages/responsive-table.init.js"></script>



<!--INIT JS-->
<script src="<?= base_url(); ?>assets/js/pages/form-advanced.init.js"></script>

<!--APP JS--> 
<script src="<?= base_url(); ?>assets/js/app.min.js"></script>

































<!--FOR DEPED EMAIL REQUEST-->

<!-- BUTTON ONLY -->
<script>
// Add event listener to the delete button
    document.getElementById('delete-depedemailrequest').addEventListener('click', function () {
        const form = document.getElementById('deleteForm'); // Get the form element

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#348cd4',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show success message and submit the form
                Swal.fire('Deleted!', 'Your request has been deleted.', 'success').then(() => {
                    form.submit(); // Submit the form
                });
            }
        });
    });
</script>

<!-- TABLE BUTTON DELETE EACH SELECTED ROW -->
<script>
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.delete-form'); // Get the closest form element

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#348cd4',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the associated form if confirmed
                }
            });
        });
    });
</script>
<script>
    document.querySelectorAll('.markdonerequest-button').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.markdonerequest-form'); // Get the closest form element

            Swal.fire({
                title: 'Mark this as Complete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#348cd4',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '&nbsp;&nbsp;Yes&nbsp;&nbsp;'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the associated form if confirmed
                }
            });
        });
    });
</script>
<script>
    document.querySelectorAll('.markundonerequest-button').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.markundonerequest-form'); // Get the closest form element

            Swal.fire({
                title: 'Mark this as Undone?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#348cd4',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '&nbsp;&nbsp;Yes&nbsp;&nbsp;'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the associated form if confirmed
                }
            });
        });
    });
</script>



</body>


</html>

