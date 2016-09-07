<?php 
/*
 * Main template
 *
=========================================================================================================
 *
 * Load Header
 */
echo $header;
?>
<section class="vbox b-t b-2x b-dark">
    
    <?php echo $topfixedbar; ?>

    <section>
        <section class="hbox stretch">

            <!-- .aside -->
            <?php echo $navigation; ?>
            <!-- /.aside -->

            <section id="content">
                <?php
                if(isset($errors) && !empty($errors)){
                    foreach ($errors as $error) {
                        ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="fa fa-exclamation-triangle"></i> <?php echo $error;?>
                        </div>
                        <?php
                    }
                }
                ?>
                <?php echo (isset($content)) ? $content : 'No Content';?>
            </section>
        </section>
    </section>
</section>
<?php 
/*
 * Load Footer
 */
echo $footer; 