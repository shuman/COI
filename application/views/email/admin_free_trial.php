
        <tr>
          <td class="eBody pdTp16" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 16px;padding-bottom: 0;padding-left: 16px;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;width: 512px;color: #242424;background-color: #ffffff;"><p style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 24px;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;font-size: 14px;line-height: 22px;text-align: left;">Hey! COI Team,<br><br />
              A new user has just Signed-Up with a <strong>Free Trial Request</strong> on <strong>Cut Out Image</strong>. Please find the user details below and free trial requirements.</p></td>
          <!-- end .eBody--> 
        </tr>
        <tr>
          <td class="highlight" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 16px;padding-bottom: 0;padding-left: 16px;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;width: 512px;text-align: center;background-color: #fafafa;border-bottom: 1px solid #ebebeb;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="invoiceTable" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-collapse: collapse;border-spacing: 0;">
              <tr>
                <td class="width246 pdRg16" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 0;padding-bottom: 16px;padding-left: 0;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;text-align: left;vertical-align: top;width: 246px;font-size: 12px;line-height: 19px;color: #242424;">
                  <span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>Full Name:</strong> <?php echo $user_info['fullname'];?></span><br>
                  <span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>Company:</strong> <?php echo $user_info['company'];?></span><br>
                  <span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>Country:</strong> <?php echo $user_info['country'];?></span><br>
                  <span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>IP Address:</strong> <?php echo $user_ip;?></span><br>
                  <span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>Phone:</strong> <?php echo $user_info['phone'];?></span><br>
                  <span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>Sign-Up Date:</strong> <?php echo date("F d, Y");?></span><br>
                  <span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>Folder Location:</strong> <?php echo "/free_trial/{$dir_name}/";?></span>                 
                </td>      

                <td class="width246 pdRg16" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 0;padding-bottom: 16px;padding-left: 0;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;text-align: left;vertical-align: top;width: 246px;font-size: 12px;line-height: 19px;color: #242424;">
                <span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>Service Types:</strong> <?php echo implode(',<br>', explode('|', $trial_entry['service_options']) );?></span><br>
                <span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>File Format:</strong> <?php echo $trial_entry['return_file_format'];?></span><br>
                <span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>Service Needed:</strong> <?php echo $trial_entry['service_needed'];?></span><br>
                <span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>Average Monthly:</strong> <?php echo $trial_entry['avg_monthly_files'];?></span><br>
                <span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>Quote Request:</strong> <?php echo $trial_entry['quotation_request'];?></span><br>
                <span class="serviceName" style="font-size: 12px;line-height: 22px;color: #666666;"><strong>How Found:</strong> <?php echo $trial_entry['how_find_us'];?></span>
                </td>                
              </tr>
            </table></td>
          <!-- end .highlight--> 
        </tr>
        <tr>
          <td class="eBody" style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 16px;padding-bottom: 0;padding-left: 16px;padding-right: 16px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;width: 512px;color: #242424;background-color: #ffffff;"><p style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 24px;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;font-size: 14px;line-height: 22px;text-align: justify;">
          <span style="font-style: oblique; color:#999999;">Additional Requirements:</span> 
          <br />
          <?php echo $trial_entry['instructions'];?>
          <br /></p>
            <p style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 24px;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;font-size: 14px;line-height: 22px;text-align: left;">Thanking you,<br>
              <strong>COI System</strong></p></td>
          <!-- end .eBody--> 
        </tr>
      