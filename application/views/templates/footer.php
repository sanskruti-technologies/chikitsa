</div>

      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © 2021 Chikitsa.net. Developed by Sanskruti Technologies.</span>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('ready_to_leave');?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-align">
            <?php echo $this->lang->line('logout_message');?>
          </div>
        </div>
        <div class="modal-footer">
          <div class="right">
          <button class="btn square-btn-adjust btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel');?></button>
          <a class="btn square-btn-adjust btn-primary" href="<?= site_url("login/logout"); ?>"><?php echo $this->lang->line('logout');?></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Multicolumn autocomplete -->
  <link href="<?= base_url() ?>assets/autocomplete/autocomplete.css" rel="stylesheet" type="text/css"/>
  <script type='text/javascript' src='<?= base_url() ?>assets/autocomplete/jquery.mcautocomplete.js'></script>

 </body>

</html>