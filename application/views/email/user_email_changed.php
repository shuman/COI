
        <tr>
          <td class="eBody pdTp32" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 32px;padding-bottom: 0;padding-left: 16px;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;width: 512px;color: #242424;background-color: #ffffff;"><p style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 24px;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;font-size: 14px;line-height: 22px;text-align: left;">Dear <?php echo $fullname;?>,<br><br />
              You have changed your email address to <span style="text-decoration: none;color: #0dc0c0;font-weight: bold;"><?php echo $new_email;?></span>.</p></td>
          <!-- end .eBody--> 
        </tr>
        <tr>
          <td class="highlight" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 16px;padding-bottom: 0;padding-left: 16px;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;width: 512px;text-align: center;background-color: #fafafa;border-bottom: 1px solid #ebebeb;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="invoiceTable" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-collapse: collapse;border-spacing: 0;">
              <tr>
                <td class="width458 pdRg16" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 0;padding-bottom: 16px;padding-left: 0;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;text-align: left;vertical-align: top;width: 246px;font-size: 12px;line-height: 19px;color: #242424;">
                  <a href="<?php echo site_url('/auth/reset_email/'.$user_id.'/'.$new_email_key); ?>" style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;color: #666666;"><span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>Click link below to confirm your new email.</strong></span></a><br>

                  <span><span style="text-decoration: none;color: #0dc0c0;font-weight: bold;">Link:</span> <nobr><a href="<?php echo site_url('/auth/reset_email/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/reset_email/'.$user_id.'/'.$new_email_key); ?></a></nobr></span>
                </td>
                
              </tr>
            </table></td>
          <!-- end .highlight--> 
        </tr>
        <tr>
          <td class="eBody" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 16px;padding-bottom: 0;padding-left: 16px;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;width: 512px;color: #242424;background-color: #ffffff;"><p style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 24px;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;font-size: 14px;line-height: 22px;text-align: justify;"><span style="font-style: oblique; color: #999999;">If clicking the link above does not work, copy and paste the URL in a new browser window.</span> <br /><br />You have received this email, because it was requested by you. If you have received this by mistake, please DO NOT click the confirmation link, and simply ignore the email. After a short time, the request will be removed from the system.</p>
            <p style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 24px;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;font-size: 14px;line-height: 22px;text-align: left;">Best Regards,<br>
              <strong>Cut Out Image Team</strong></p></td>
          <!-- end .eBody--> 
        </tr>
      