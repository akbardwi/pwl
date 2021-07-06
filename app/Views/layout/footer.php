<!--==========================
        Footer
        ============================-->
        <footer id="footer">
            <div class="container">
                <div class="copyright">
                    Dibuat Oleh: Akbar Dwi Syahputra - A11.2019.12217
                </div>

            </div>
        </footer><!-- #footer -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- JavaScript Libraries -->
        <script src="<?= base_url(); ?>/lib/jquery/jquery.min.js"></script>
        <script src="<?= base_url(); ?>/lib/jquery/jquery-migrate.min.js"></script>
        <script src="<?= base_url(); ?>/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url(); ?>/lib/easing/easing.min.js"></script>
        <script src="<?= base_url(); ?>/lib/superfish/hoverIntent.js"></script>
        <script src="<?= base_url(); ?>/lib/superfish/superfish.min.js"></script>
        <script src="<?= base_url(); ?>/lib/wow/wow.min.js"></script>
        <script src="<?= base_url(); ?>/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="<?= base_url(); ?>/lib/magnific-popup/magnific-popup.min.js"></script>
        <script src="<?= base_url(); ?>/lib/sticky/sticky.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>
        
        <!-- DataTables -->
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#tabelUser').DataTable();
            } );

            $('.btn-detail').on('click',function(){
                const data = "<img src='<?php echo base_url("img/loading.gif"); ?>'/> Silahkan Tunggu";
                $('#dataMember').html(data);
                // get data from button edit
                const id = $(this).data('id');
                // Set data to Form Edit
                loadData(id);
                // Call Modal Detail Pendaftar
                $('#detailMember').modal('show');
            });

            //Lihat Data
            function loadData(id) {
                $.ajax({
                    url: '<?php echo base_url('admin/getData'); ?>',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        // Show Data
                        $('#dataMember').html(data);
                    }
                });
            }
        </script>

        <!-- Contact Form JavaScript File -->
        <script src="<?= base_url(); ?>/contactform/contactform.js"></script>

        <!-- Template Main Javascript File -->
        <script src="<?= base_url(); ?>/js/main.js"></script>

</body>
</html>