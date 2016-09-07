    <script id="alert_box" type="text/html">
        <div class="modal-dialog">
            <div class="modal-content">
                {{#if title}}
                    <div class="modal-header">
                        <h4 class="modal-title text-info m-l-xs">{{title}}</h4>
                    </div>
                {{else}}
                    <div class="modal-header">
                        <h4 class="modal-title text-info m-l-xs">Cut Out Image Says</h4>
                    </div>
                {{/if}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table width="100%;">
                                <tr>
                                    <td id="alert_content" valign="middle" style="min-height:100px;" class="text-{{type}} ar-text-justify">{{{text}}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{#if confirm}}
                        <a href="{{href}}" class="btn btn-sm btn-danger pull-left">Leave This Page</a>
                        <button class="btn btn-sm btn-info pull-right" data-dismiss="modal">Stay on This Page</button>
                    {{else}}
                        {{#if refresh}}
                            <button class="btn btn-sm btn-default pull-right" onclick="javascript:window.location.reload()" data-dismiss="modal">Reload Page</button>
                        {{else}}
                            <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">Close</button>
                        {{/if}}
                    {{/if}}
                </div>
            </div>
        </div>
    </script>

    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-colorpicker.js"></script>
    <!-- App -->
    <script src="<?php echo base_url();?>assets/js/app.js"></script>  
    <script src="<?php echo base_url();?>assets/js/jquery.minicolors.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo base_url();?>assets/js/charts/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/charts/flot/jquery.flot.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/charts/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/charts/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo base_url();?>assets/js/charts/flot/jquery.flot.pie.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/charts/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url();?>assets/js/charts/flot/jquery.flot.grow.js"></script>
    <script src="<?php echo base_url();?>assets/js/charts/flot/demo.js"></script>

    <script src="<?php echo base_url();?>assets/js/tinymce/tinymce.min.js"></script>
    
    <script src="<?php echo base_url();?>assets/js/calendar/bootstrap_calendar.js"></script>
    <!--script src="<?php echo base_url();?>assets/js/calendar/demo.js"></script-->

    <script src="<?php echo base_url();?>assets/js/sortable/jquery.sortable.js"></script>
    <script src="<?php echo base_url();?>assets/js/app.plugin.js"></script>

    <script src="<?php echo base_url();?>assets/js/jquery.timeago.js"></script>
    <script src="<?php echo base_url();?>assets/js/countdown.js"></script>
    <script src="<?php echo base_url();?>assets/js/handlebars-v1.3.0.js"></script>
    <!--<script src="<?php echo base_url();?>assets/js/handlebars-paginate.js"></script>  -->
    <script src="<?php echo base_url();?>assets/js/dropzone-my.js"></script>
    <script src="<?php echo base_url();?>assets/js/tinymce/tinymce.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/chosen/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/custom.js?<?php echo time();?>"></script>
    <script src="<?php echo base_url();?>assets/js/ng-app.js?<?php echo time();?>"></script>
    <?php if(isset($admin) && $admin == true): ?>
    <script src="<?php echo base_url();?>assets/js/admin.js?<?php echo time();?>"></script>
    <?php endif; ?>
    <?php
    if ($this->tank_auth->is_logged_in()) {
        $chat_name = $this->user_profile->fullname;
        $chat_email = $this->user_profile->email;
        $signup_timestamp = strtotime($this->user_profile->created);
        echo '<script>
                  window.intercomSettings = {
                    app_id: "gxwdxei2",
                    name: "'.$chat_name.'",
                    email: "'.$chat_email.'",
                    created_at: '.$signup_timestamp.'
                  };
                </script>';
    }else{
        echo '<script>window.intercomSettings = {app_id: "gxwdxei2"};</script>';
    }
    ?>
   
</body>
</html>