
        <tr>
          <td class="eBody pdTp32" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 32px;padding-bottom: 0;padding-left: 16px;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;width: 512px;color: #242424;background-color: #ffffff;"><p style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 24px;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;font-size: 14px;line-height: 22px;text-align: left;">Dear <?php echo $user_info->fullname;?>,<br><br>
              This is to inform you that <strong>Order <?php echo $order_key;?></strong> has been delivered and is ready for download.</p></td>
          <!-- end .eBody--> 
        </tr>
        <tr>
          <td class="highlight" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 16px;padding-bottom: 0;padding-left: 16px;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;width: 512px;text-align: center;background-color: #fafafa;border-bottom: 1px solid #ebebeb;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="invoiceTable" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-collapse: collapse;border-spacing: 0;">
              <tr>
               <td class="width116" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 0;padding-bottom: 16px;padding-left: 0;padding-right: 0;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;text-align: left;vertical-align: top;width: 116px;font-size: 12px;line-height: 19px;color: #242424;"><a href="<?php echo $download_url;?>" style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;color: #0dc0c0;width: 100%;margin-left: auto;margin-right: auto;"><img src="<?php echo $this->config->item('email_asset');?>/download-btn.png" alt="Download Now" width="169" height="43" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;height: auto;width: auto;line-height: 100%;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;border: none;"></a></td>
               
               <td class="width246 pdRg16" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 0;padding-bottom: 16px;padding-left: 0;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;text-align: left;vertical-align: top;width: 116px;font-size: 12px;line-height: 19px;color: #242424;"><strong class="amount" style="color: #666666;font-weight: bold;font-size: 16px;line-height: 24px;">Download Link</strong><br><span class="label" style="color: #898989; text-decoration: none;"><?php echo $download_url;?></span></td>

              </tr>
            </table></td>
          <!-- end .highlight--> 
        </tr>
        <tr>
          <td class="eBody" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 16px;padding-bottom: 0;padding-left: 16px;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;width: 512px;color: #242424;background-color: #ffffff;"><p style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 24px;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;font-size: 14px;line-height: 22px;text-align: left; font-style: oblique;">If we can be of any further assistance please just let us know, we will gladly assist you.</p>
            <p style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 24px;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;font-size: 14px;line-height: 22px;text-align: left;">Best regards,<br>
              <strong>Cut Out Image Team</strong></p></td>
          <!-- end .eBody--> 
        </tr>
       