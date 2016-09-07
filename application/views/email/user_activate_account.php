        <tr>
          <td class="highlight pdTp32" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 32px;padding-bottom: 0;padding-left: 16px;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;width: 512px;text-align: center;background-color: #fafafa;border-bottom: 1px solid #ebebeb;"><h1 style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 5px;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;font-size: 24px;line-height: 36px;font-weight: bold;color: #242424;"><span style="color: #242424;">Welcome To Cut Out Image</span></h1>
            <table border="0" align="center" cellpadding="0" cellspacing="0" class="profilePicture" style="margin-top: 0;margin-left: auto;margin-right: auto;margin-bottom: 0;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-collapse: collapse;border-spacing: 0;text-align: center;width: 64px;height: 64px;">
              <tr>
                <td style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 10px;padding-bottom: 6px;padding-left: 0;padding-right: 0;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;"><img src="<?php echo $this->config->item('email_asset');?>/user_icon.png" width="64" height="64" alt="Your Profile Picture" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;height: auto;width: auto;line-height: 100%;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></td>
              </tr>
            </table>
            <p class="profileName" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 24px;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;font-size: 14px;line-height: 22px;color: #898989;"><span style="font-weight: bold;color: #666666;"><?php echo $fullname;?></span><br>
              <?php echo date("F d, Y");?></p></td>
          <!-- end .highlight--> 
        </tr>
        <tr>
          <td class="eBody alignCenter pdTp32" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 32px;padding-bottom: 0;padding-left: 16px;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;text-align: center;width: 512px;color: #242424;background-color: #ffffff;"><p style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 24px;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;text-align: center;font-size: 14px;line-height: 22px;">Thanks for joining <strong><?php echo $site_name; ?></strong>. We listed your sign in details below, make sure you keep them safe.<br />To verify your email address, please follow this link:</p>
            <br />
            <br /> 
            <strong><a href="<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;">Finish your registration...</a></strong>
            <br />
            Link doesn't work? Copy the following link to your browser address bar:
            <br />
            <nobr><a href="<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?></a></nobr><br>
            <br />
            Please verify your email within <?php echo $activation_period; ?> hours, otherwise your registration will become invalid and you will have to register again.
            <br />
            <br />
            <?php if (strlen($username) > 0) { ?>Your Username: <?php echo $username; ?><br /><?php } ?>
            Your Email Address: <?php echo $email; ?><br />
            <?php if (isset($password)) { /* ?>Your password: <?php echo $password; ?><br /><?php */ } ?>
            <br />
            <br />
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="subtleBtn" style="margin-top: 0;margin-left: auto;margin-right: auto;margin-bottom: 0;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-collapse: collapse;border-spacing: 0;">
              <tr>
                <td style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 16px;padding-bottom: 32px;padding-left: 0;padding-right: 0;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;font-size: 14px;color: #898989;"><a href="https://www.cutoutimage.com/contact-us" style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;color: #898989;"><span style="text-decoration: none;color: #898989;">If you need help please feel free to contact us by replying to this email.</span></a></td>
              </tr>
            </table></td>
          <!-- end .eBody--> 
        </tr>