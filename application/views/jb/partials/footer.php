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

<!--UI-SWEET-ALERT-->
<!--<script src="assets/js/pages/sweetalert2@11.js"></script>-->


























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

