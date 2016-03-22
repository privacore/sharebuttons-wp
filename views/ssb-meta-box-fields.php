<!-- Hidden nonce field -->
<input type="hidden" value="<?php echo $nonce; ?>" name="pssb_nonce"/>
<table class="pssbFields">
    <!-- Show/Hide buttons from page field -->
    <tr class="form-field" valign="middle">
        <td scope="row"> <label for="pssbShowButtons"><?php _e('Show SSB Buttons on page', 'privacore-ssb'); ?></label></td>
        <td>
            <input type="checkbox" name="pssb_show_on_page" value="1" <?php echo ($pssb_show_on_page==1)?'checked="checked"' :''; ?> />
        </td>
    </tr>
    <tr valign="middle">
        <td colspan="2">&nbsp;</td>
    </tr>
    <!-- End Show/Hide buttons from page field -->

    <!-- SSB Image -->
    <tr class="form-field" valign="top">
        <td scope="row">
            <label for="pssbUploadImage"><?php _e('Upload Image', 'privacore-ssb'); ?></label>
        </td>
        <td>
            <input id="pssbUploadImage" type="text" name="pssb_image" value="<?php echo $pssb_image; ?>"/>
            <input id="upload_image_button" class="button-primary pssbSetCustomImages" type="button"
                   value="<?php _e('Select Image', 'privacore-ssb') ?>"/>
            </label>
        </td>
    </tr>
    <!-- End SSB Image-->

    <!-- Facebook section -->
    <tr valign="middle">
        <td colspan="2"><h4><?php _e('Facebook SSB', 'privacore-ssb'); ?></h4></td>
    </tr>
    <tr class="form-field" valign="middle">
        <td scope="row">
            <label for="pssbFacebookTitle"><?php _e('Facebook Title', 'privacore-ssb'); ?></label>
        </td>
        <td>
            <input id="pssbFacebookTitle" type="text" name="pssb_facebook_title"
                   value="<?php echo $pssb_facebook_title; ?>" maxlength="100"/>
            <small><i><?php _e('Facebook title length must be 100 symbols maximum.', 'privacore-ssb'); ?></i></small>
            <?php if (isset($pssb_facebook_title_error)): ?>
                <div class="field_error"><?php echo $pssb_facebook_title_error; ?></div>
            <?php endif; ?>
        </td>
    </tr>

    <tr class="form-field" valign="top">
        <td scope="row">
            <label for="pssbFacebookDescription"><?php _e('Facebook Description', 'privacore-ssb'); ?></label>
        </td>
        <td>
            <textarea id="pssbFacebookDescription" name="pssb_facebook_description"
                      maxlength="300"><?php echo $pssb_facebook_description; ?></textarea>
            <small><i><?php _e('Facebook description length must be 300 symbols maximum.', 'privacore-ssb'); ?></i>
            </small>
            <?php if (isset($pssb_facebook_description_error)): ?>
                <div class="field_error"><?php echo $pssb_facebook_description_error; ?></div>
            <?php endif; ?>
        </td>
    </tr>
    <!-- End Facebook section -->

    <!-- Twitter section -->
    <tr valign="middle">
        <td colspan="2"><h4><?php _e('Twitter SSB', 'privacore-ssb'); ?></h4></td>
    </tr>
    <tr class="form-field" valign="top">
        <td scope="row">
            <label for="pssTwitterText"><?php _e('Twitter Text', 'privacore-ssb'); ?></label>
        </td>
        <td>
            <textarea id="pssb_twitter_text" name="pssb_twitter_text"
                      maxlength="116"><?php echo $pssb_twitter_text; ?></textarea>
            <small><i><?php _e('Twitter text length must be 116 symbols maximum.', 'privacore-ssb'); ?></i></small>
            <?php if (isset($pssb_twitter_text_error)): ?>
                <div class="field_error"><?php echo $pssb_twitter_text_error; ?></div>
            <?php endif; ?>
        </td>
    </tr>
    <!-- End Twitter section -->

    <!-- Linkedin section -->
    <tr valign="middle">
        <td colspan="2"><h4><?php _e('LinkedIn SSB', 'privacore-ssb'); ?></h4></td>
    </tr>
    <tr class="form-field" valign="middle">
        <td scope="row">
            <label for=" pssbLinkedinTitle"><?php _e('LinkedIn Title', 'privacore-ssb'); ?></label>
        </td>
        <td>
            <input id="pssbLinkedinTitle" type="text" name="pssb_linkedin_title"
                   value="<?php echo $pssb_linkedin_title; ?>" maxlength="200"/>
            <small><i><?php _e('LinkedIn title length must be 200 symbols maximum.', 'privacore-ssb'); ?></i></small>
            <?php if (isset($pssb_linkedin_title_error)): ?>
                <div class="field_error"><?php echo $pssb_linkedin_title_error; ?></div>
            <?php endif; ?>
        </td>
    </tr>

    <tr class="form-field" valign="top">
        <td scope="row">
            <label for="pssbLlinkedinDescription"><?php _e('LinkedIn Description', 'privacore-ssb'); ?></label>
        </td>
        <td>
            <textarea id="pssbLinkedinDescription" name="pssb_linkedin_description"
                      maxlength="256"><?php echo $pssb_linkedin_description; ?></textarea>
            <small><i><?php _e('LinkedIn summary length must be 256 symbols maximum.', 'privacore-ssb'); ?></i></small>
            <?php if (isset($pssb_linkedin_description_error)): ?>
                <div class="field_error"><?php echo $pssb_linkedin_description_error; ?></div>
            <?php endif; ?>
        </td>
    </tr>
    <!-- End Linkedin section -->
</table>