<table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="container560">
    <tr>
        <td align="center" style="color: #454545; font-size: 18px; font-family: 'Noto Sans', Arial, sans-serif;" class="main-header">Create a new password</td>
    </tr>

    <tr>
        <td height="20"></td>
    </tr>

    <tr>
        <td align="center" style="color: #9f9f9f; font-size: 13px; font-family: 'Noto Sans', Arial, sans-serif; line-height: 29px;" class="main-subheader">
            Forgot your password, huh? No big deal.<br />
            To create a new password, just follow this link:<br />
            <br />
            <strong><a href="<?php echo site_url('/auth/reset_password/'.$user_id.'/'.$new_pass_key); ?>" style="color: #3366cc;">Create a new password</a></strong><br />
            <br />
            Link doesn't work? Copy the following link to your browser address bar:<br />
            <nobr><a href="<?php echo site_url('/auth/reset_password/'.$user_id.'/'.$new_pass_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/reset_password/'.$user_id.'/'.$new_pass_key); ?></a></nobr><br />
            <br />
            <br />
            You received this email, because it was requested by a <a href="<?php echo site_url(''); ?>" style="color: #3366cc;"><?php echo $site_name; ?></a> user. This is part of the procedure to create a new password on the system. If you DID NOT request a new password then please ignore this email and your password will remain the same.<br />
            <br />
            <br />
            Thank you,<br />
            The <?php echo $site_name; ?> Team
        </td>
    </tr>

    <tr>
        <td height="30"></td>
    </tr>
</table>