
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?php echo  $this->session->nama_website ?> <?php echo  date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
    </div>
</div>
</div>

<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/leaflet.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>

<!-- Sweet Alert -->
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.masknumber.js"></script>
<!-- Page level custom scripts -->
<!-- <script src="<?php echo base_url() ?>assets/js/demo/chart-area-demo.js"></script> -->
<!-- <script src="<?php echo base_url() ?>assets/js/demo/chart-pie-demo.js"></script> -->
<script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modules-datatables.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


<script type="text/javascript">
    $('#jenis_laporan').on('change',function(){
        let jenis = $(this).val();
        let level = '<?php echo $this->session->level ?>';
        if (level=="Admin" || level=="PIC" || level=="Supervisor") {
            if (jenis=="Marketing") {
              $('.marketing_laporan').removeClass('d-none');
          }else{
              $('.marketing_laporan').addClass('d-none');
          }
          
          if (jenis=="Cabang" && level!="Supervisor") {
              $('.cabang_laporan').removeClass('d-none');
          }else{
              $('.cabang_laporan').addClass('d-none');
          }
      }
  });


    $(document).on('click','.item_tarik_laporan',function(e){
        e.preventDefault();
        let level = '<?php echo $this->session->level ?>';
        if (level=="Admin" || level=="PIC" || level=="Supervisor") {
            $.ajax({
              type : "GET",
              url  : "<?php echo base_url('dashboard/get_option_laporan')?>",
              dataType : "JSON",
              success: function(data){
                  $('#ModalLaporan').modal('show');

                  $('.cabang_laporan').addClass('d-none');
                  $('.marketing_laporan').addClass('d-none');
                  let marketing ='<option value="All">All</option>';
                  for (var i = 0; i <data.marketing.length; i++) {
                    marketing+='<option value="'+data.marketing[i].id_user+'">'+data.marketing[i].nama+'</option>';
                }
                $('#nama_marketing_laporan').html(marketing);

                let cabang ='<option value="All">All</option>';
                for (var i = 0; i <data.cabang.length; i++) {
                    cabang+='<option value="'+data.cabang[i].id_cabang+'">'+data.cabang[i].nama_cabang+'</option>';
                }
                $('#cabang_laporan').html(cabang);


            }
        });


        }else{
            $('#ModalLaporan').modal('show');
            $('.cabang_laporan').addClass('d-none');
            $('.marketing_laporan').addClass('d-none');
        }
    });

    function show_password_user(id) {
        if ($('#' + id).attr('type') == "password") {
            $('#' + id).attr('type', 'text');
            $('.' + id).html('<i class="fa fa-eye-slash"></i>');
        } else {
            $('#' + id).attr('type', 'password');
            $('.' + id).html('<i class="fa fa-eye"></i>');

        }
    }


    $('#btn_ubah_password_user').on('click', function() {
        let cek = 0;

        let password = $('#password_baru_user').val();
        let confirm = $('#confirm_password_baru_user').val();
        if (password == "") {
            cek++;
            $('#password_baru_user').focus();
            $('.error-password_baru_user').html('Silahkan Masukkan Password Baru');
        } else {
            $('.error-password_baru_user').html('');
        }
        if (password !== confirm) {
            cek++;
            $('#confirm_password_baru_user').focus();
            $('#confirm_password_baru_user').val();
            $('.error-confirm_password_baru_user').html('Konfirmasi Password Tidak Valid');
        } else {
            $('.error-confirm_password_baru_user').html('');
        }
        if (cek > 0) {
            return false;
        } else {
            $('#form_ubah_password_user').submit();

        }

    });

    function previewFile(id) {
      let file = $('#'+id)[0].files[0];
      let reader = new FileReader();
      reader.addEventListener("load", function () {
        $('#preview_'+id).attr('src',reader.result);
    }, false);
      if (file) {
        reader.readAsDataURL(file);
    }
}

$('#btn_tarik_laporan').on('click',function(){
    let jenis = $('#jenis_laporan').val();
    if (jenis==null) {
        $('#jenis_laporan').focus();
        Swal.fire({
            title:'Error',
            text:'Silahkan Pilih Jenis Laporan!',
            icon:'error'
        }).then((result) => {
            if (result.isConfirmed) {
              Swal.close();
          }
      });
        return false;
    }

    let tanggal_awal_laporan = $('#tanggal_awal_laporan').val();
    if (tanggal_awal_laporan=='') {
        $('#tanggal_awal_laporan').focus();
        Swal.fire({
            title:'Error',
            text:'Silahkan Masukkan Tanggal Awal!',
            icon:'error'
        }).then((result) => {
            if (result.isConfirmed) {
              Swal.close();
          }
      });
        return false;
    }

    let tanggal_akhir_laporan = $('#tanggal_akhir_laporan').val();
    if (tanggal_akhir_laporan=='') {
        $('#tanggal_akhir_laporan').focus();
        Swal.fire({
            title:'Error',
            text:'Silahkan Masukkan Tanggal Akhir!',
            icon:'error'
        }).then((result) => {
            if (result.isConfirmed) {
              Swal.close();
          }
      });
        return false;
    }
    if (tanggal_akhir_laporan < tanggal_awal_laporan) {
        $('#tanggal_akhir_laporan').focus();
        Swal.fire({
            title:'Error',
            text:'Rentang Tanggal Tidak Valid!',
            icon:'error'
        }).then((result) => {
            if (result.isConfirmed) {
              Swal.close();
          }
      });
        return false;
    }

    $('#form_tarik_laporan').submit();

});

</script>
</body>

</html>