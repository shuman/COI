<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- Define Charset -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><!-- Responsive Meta Tag -->
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />

    <title><?php echo $this->config->item('website_name', 'tank_auth');?></title><!-- Responsive Styles and Valid Styles -->
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css' />
    <style type="text/css">
/*<![CDATA[*/


        body{
            width: 100%;
            background-color: #efefef;
            margin:0;
            padding:0;
            -webkit-font-smoothing: antialiased;
        }

        p,h1,h2,h3,h4{
            margin-top:0;
            margin-bottom:0;
            padding-top:0;
            padding-bottom:0;
        }

        span.preheader{display: none; font-size: 1px;}

        html{
            width: 100%;
        }

        table{
            font-size: 14px;
            border: 0;
            border-collapse:collapse;
            mso-table-lspace:0pt;
            mso-table-rspace:0pt;
        }

        /* ----------- responsivity ----------- */
        @media only screen and (max-width: 640px){
            /*------ top header ------ */
            .rounded-edg-bg{width: 440px !important; height: 10px !important;}
            .main-header{line-height: 28px !important; font-size: 17px !important;}
            .subheader{width: 390px !important;}
            .main-subheader{line-height: 28px !important;}

            /*----- main image -------*/
            .main-image img{width: 420px !important; height: auto !important;}

            /*-------- container --------*/
            .container600{width: 430px !important;}
            .container580{width: 410px !important;}
            .container560{width: 390px !important;}
            .main-content{width: 408px !important;}
            /*-------- divider --------*/
            .divider img{width: 430px !important; height: 1px !important;}

            /*-------- secions ----------*/
            .section-item{width: 390px !important; text-align: center !important;}
            .table-inside{width: 408px !important;}
            /*.section-img img{width: 390px !important; height: auto !important;}*/
            .table-rounded-edg-bg{width: 410px !important; height: 5px !important;}

            /*-------- envelope graphique ------------*/
            .envelope-top600{width: 448px !important;}
            .envelope-top600 img{width: 448px !important;}
            .top-envelope600{width: 448px !important;}
            .top-envelope600 img{width: 448px !important;}

            .middle-envelope600{width: 448px !important;}
            .middle-envelope600 img.left{width: 158px !important; height: 56px !important;}
            .middle-envelope600 img.right{width: 150px !important; height: 58px !important;}
            .footer-logo{width: 100px !important;}

            .bottom-envelope600{width: 448px !important;}
            .bottom-envelope600 .left{width: 92px !important;}
            .bottom-envelope600 .right{width: 85px !important;}
            .bottom-envelope600 .unsubscribe{width: 200px !important;}
            .bottom-envelope600 .unsubscribe-text{line-height: 20px !important};
        }

        @media only screen and (max-width: 479px){

            /*------ top header ------ */

            .main-header{line-height: 28px !important; font-size: 17px !important;}
            .subheader{width: 260px !important;}
            .main-subheader{line-height: 28px !important;}

            /*----- main image -------*/
            .main-image img{width: 260px !important; height: auto !important;}

            /*-------- container --------*/
            .container600{width: 270px !important;}
            .container580{width: 270px !important;}
            .container560{width: 250px !important;}
            .main-content{width: 268px !important;}
            /*-------- divider --------*/
            .divider img{width: 260px !important; height: 1px !important;}

            /*-------- secions ----------*/
            .section-item{width: 250px !important; text-align: center !important;}

            /*.section-img img{width: 250px !important; height: auto !important;}*/

            /*-------- cta ----------*/
            .icon img{width: 20px !important; height: 20px !important;}
            .cta-text{text-align: center !important; line-height: 24px !important;}

            /*-------- footer ------------*/
            /*-------- envelope graphique ------------*/
            .envelope-top600 {width: 278px !important;}
            .envelope-top600 img{width: 278px !important;}
            .top-envelope600{width: 278px !important;}
            .top-envelope600 img{width: 278px !important;}

            .middle-envelope600{width: 278px !important;}
            .middle-envelope600 img.left{width: 158px !important; height: auto !important; display: none !important;}
            .middle-envelope600 img.right{width: 150px !important; height: auto !important; display: none !important;}
            .footer-logo{width: 100px !important;}

            .bottom-envelope600{width: 278px !important;}
            .bottom-envelope600 .left{width: 92px !important; display: none !important;}
            .bottom-envelope600 .right{width: 85px !important; display: none !important;}
            .bottom-envelope600 .unsubscribe{width: 200px !important;}
            .bottom-envelope600 .unsubscribe-text{line-height: 20px !important;}

            /*-------- social ------------*/
            .social-text{display: none !important;}
        }

    /*]]>*/
    </style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="#EFEFEF">
        <!--========= logo ===========-->

        <tr>
            <td height="50"></td>
        </tr>

        <tr>
            <td align="center"><a href="" style="display: block; width: 231px; height: 33px; border-style: none !important; border: 0 !important;"><img width="254" height="45" border="0" style="display: block; width: 254px; height: 45px" src="<?php echo $asset_path;?>/logo.png" alt="Cut Out Image" /></a></td>
        </tr>

        <tr>
            <td height="40"></td>
        </tr><!--========= end logo ===========-->

        <tr>
            <td align="center">
                <table width="600" cellpadding="0" align="center" cellspacing="0" border="0" class="container600">
                    <tr>
                        <td align="center" valign="top"><img align="top" src="<?php echo $asset_path;?>/shadow-left.png" style="display: block; width: 10px; height: 294px;" width="10" height="294" border="0" alt="" /></td>

                        <td align="center">
                            <table border="0" align="center" width="500" cellpadding="0" cellspacing="0" bgcolor="#E0E0E0" class="container580">
                                <tr>
                                    <td height="1"></td>
                                </tr>

                                <tr>
                                    <td>
                                        <table border="0" align="center" width="498" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="main-content">
                                            <tr>
                                                <td height="15"></td>
                                            </tr>

                                            <tr>
                                                <td height="40"></td>
                                            </tr>

                                            <tr>
                                                <td align="center">
                                                    <!-- ========== START CONTENT ============= -->

                                                    <?php echo $content; ?>

                                                    <!-- ========== START CONTENT ============= -->
                                                </td>
                                            </tr><!--========= end main text ===========-->

                                            <tr>
                                                <td height="50"></td>
                                            </tr><!--============ divider ===========-->

                                            <tr>
                                                <td class="divider" align="center"><img src="<?php echo $asset_path;?>/divider.png" style="display: block; width: 565px; height: 1px;" width="565" height="1" border="0" alt="divider" /></td>
                                            </tr><!--============ end divider ===========-->

                                            <tr>
                                                <td height="50"></td>
                                            </tr><!--============ social ===========-->

                                            <tr>
                                                <td align="center">
                                                    <table width="510" align="center" cellpadding="0" cellspacing="0" border="0" class="container560">
                                                        <tr>
                                                            <td align="center">
                                                                <table width="150" align="left" cellpadding="0" cellspacing="0" border="0" class="container560">
                                                                    <tr>
                                                                        <td align="center" style="color: #454545; font-size: 16px; font-family: 'Noto Sans', Arial, sans-serif; line-height: 30px;">Connect with us via</td>
                                                                    </tr>
                                                                </table>

                                                                <table style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" border="0" width="20" align="left" cellpadding="0" cellspacing="0" class="container560">
                                                                    <tr>
                                                                        <td width="20" height="20">&nbsp;</td>
                                                                    </tr>
                                                                </table>

                                                                <table width="320" align="left" cellpadding="0" cellspacing="0" border="0" class="container560">
                                                                    <tr>
                                                                        <td style="color: #454545; font-size: 16px; font-family: 'Noto Sans', Arial, sans-serif;">
                                                                            <table border="0" align="center" cellpadding="0" cellspacing="0">
                                                                                <tr>
                                                                                    <td style="color: #454545; font-size: 16px; font-family: 'Noto Sans', Arial, sans-serif;" class="social-text">Twitter</td>

                                                                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                                                                    <td><a style="display: block; width: 30px; border-style: none !important; border: 0 !important;" href="https://twitter.com/cutoutimage"><img width="30" height="30" border="0" style="display: block; width: 30px; height: 30px;" src="<?php echo $asset_path;?>/twitter.png" alt="Twitter" /></a></td>

                                                                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                                                                    <td style="color: #454545; font-size: 16px; font-family: 'Noto Sans', Arial, sans-serif;" class="social-text">Facebook</td>

                                                                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                                                                    <td><a style="display: block; width: 24px; border-style: none !important; border: 0 !important;" href="https://www.facebook.com/cutoutimage"><img width="15" height="30" border="0" style="display: block; width: 15px; height: 30px;" src="<?php echo $asset_path;?>/facebook.png" alt="Facebook" /></a></td>

                                                                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                                                                    <td style="color: #454545; font-size: 16px; font-family: 'Noto Sans', Arial, sans-serif;" class="social-text">Google+</td>

                                                                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                                                                    <td><a style="display: block; width: 26px; border-style: none !important; border: 0 !important;" href="https://plus.google.com/+CutOutImage"><img width="26" height="30" border="0" style="display: block; width: 26px; height: 30px;" src="<?php echo $asset_path;?>/google.png" alt="Google+" /></a></td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr><!--============ end social ===========-->

                                            <tr>
                                                <td height="20"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td align="center" valign="top"><img align="top" src="<?php echo $asset_path;?>/shadow-right.png" style="display: block; width: 10px; height: 294px;" width="10" height="294" border="0" alt="" /></td>
                    </tr>
                </table>
            </td>
        </tr><!--============ footer ===========-->

        <tr>
            <td align="center">
                <table width="600" cellpadding="0" align="center" cellspacing="0" border="0" class="envelope-top600">
                    <tr>
                        <td align="center" style="line-height: 13px;"><img src="<?php echo $asset_path;?>/envelope-top.png" style="display: block; width: 600px; height: 13px;" width="600" height="13" border="0" alt="" /></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td align="center">
                <table width="600" cellpadding="0" align="center" cellspacing="0" border="0" bgcolor="#FFFFFF" class="top-envelope600">
                    <tr>
                        <td align="center"><img src="<?php echo $asset_path;?>/top-envelope.png" style="display: block; width: 600px; height: 78px;" width="600" height="78" border="0" alt="" /></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td align="center" valign="top">
                <table width="600" cellpadding="0" align="center" cellspacing="0" border="0" bgcolor="#F7F7F7" class="middle-envelope600">
                    <tr>
                        <td align="center" valign="top"><img src="<?php echo $asset_path;?>/middle-envelope-left.png" style="display: block; width: 218px; height: 53px;" width="218" height="53" border="0" alt="" class="left" /></td>

                        <td align="center">
                            <table width="173" cellpadding="0" align="center" cellspacing="0" border="0" bgcolor="#F7F7F7" class="footer-logo">
                                <tr>
                                    <td align="center" valign="middle"><img align="middle" src="<?php echo $asset_path;?>/footer-logo.png" style="display: block; width: 43px; height: 42px;" width="43" height="42" border="0" alt="" /></td>
                                </tr>
                            </table>
                        </td>

                        <td align="center"><img src="<?php echo $asset_path;?>/middle-envelope-right.png" style="display: block; width: 209px; height: 53px;" width="209" height="53" border="0" alt="" class="right" /></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td align="center">
                <table width="600" cellpadding="0" align="center" cellspacing="0" border="0" bgcolor="#F7F7F7" class="bottom-envelope600">
                    <tr>
                        <td align="center" valign="top"><img align="top" src="<?php echo $asset_path;?>/bottom-envelope-left.png" style="display: block; width: 128px; height: 82px;" width="130" height="82" border="0" alt="" class="left" /></td>

                        <td align="center">
                            <table width="350" cellpadding="0" align="center" cellspacing="0" border="0" bgcolor="#F7F7F7" class="unsubscribe">
                                <tr>
                                    <td align="center" style="color: #9b9b9b; font-size: 11px; font-family: 'Noto Sans', Arial, sans-serif;" class="unsubscribe-text">Address: House # 05(A5), Road # 06, Sector # 10<br />
                                    <span style="text-decoration: none; color: #2fc7d5; line-height: 30px;">Uttara Model Town, Dhaka - 1230, Bangladesh</span></td>
                                </tr>
                            </table>
                        </td>

                        <td align="center" valign="top"><img align="top" src="<?php echo $asset_path;?>/bottom-envelope-right.png" style="display: block; width: 116px; height: 82px;" width="120" height="82" border="0" alt="" class="right" /></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td height="50"></td>
        </tr>
    </table>
</body>
</html>
