<?php if (isset($message) && !empty($message)) { ?>
    <section id="general_message" class="m-t-lg wrapper-md animated fadeInDownBig">    
        <div class="container aside-xxl">
            <section class="m-b-md text-left">
                <div class="message m-t-xl m-b-l"><?php echo $message; ?></div>
            </section>
        </div>
    </section>

<?php } else { ?>
    <section id="general_message" class="m-t-lg wrapper-md animated fadeInDownBig">    
        <div class="container aside-xxl">
            <section class="m-b-md text-left">
                <div class="message m-t-xl m-b-l">
                    <div id="form-content">
                        <center><div class='wait_msg'>Please wait, your order is being processed and you will be redirected to the checkout page within 5 seconds.</div></center>
                        <center><br/>
                            <div class="progress progress-sm progress-striped  active">
                                <div class="progress-bar bg-info lter" data-toggle="tooltip" style="width: 0%"></div>
                            </div>
                        </center>
                        <center>Still loading after 5 seconds?<br/><br/>
                            <a href="<?php echo site_url("/payment/$order_id"); ?>" class="btn btn-default">Try Again</a>
                        </center>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <script type="text/javascript">
        $(window).load(function () {
            var payment_url = '<?php echo site_url("/payment/$order_id"); ?>';
            window.location.href = payment_url;
        });
    </script>
<?php } ?>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("#paymentprocess_form").submit();
        // $(".progress-bar").animate({width: "100%"}, 1000);
        var width = 0;
        setInterval(function () {
            width++;
            $(".progress-bar").css("width", width + "%");

        }, 100);
    });
</script>