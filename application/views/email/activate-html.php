<table border="0" width="480" align="center" cellpadding="0" cellspacing="0" class="container560">
    <tr>
        <td align="center" style="color: #454545; font-size: 18px; font-family: 'Noto Sans', Arial, sans-serif;" class="main-header">Welcome To <?php echo $site_name; ?>!</td>
    </tr>

    <tr>
        <td height="20"></td>
    </tr>

    <tr>
        <td align="center" style="color: #9f9f9f; font-size: 13px; font-family: 'Noto Sans', Arial, sans-serif; line-height: 29px;" class="main-subheader">
            Thanks for joining <strong><?php echo $site_name; ?></strong>. We listed your sign in details below, make sure you keep them safe.<br />
            To verify your email address, please follow this link:<br />
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
            Best Regards,<br />
            The <strong><?php echo $site_name; ?></strong> Team
        </td>
    </tr>

    <tr>
        <td height="30"></td>
    </tr>
</table>