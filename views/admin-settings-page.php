<!-- Settings page wrap -->
<div class="wrap">
    <h1><?php _e('Privacore SSB Settings', 'privacore-ssb'); ?></h1>
    <!-- Settings Form-->
    <form method="post" action="options.php">
        <?php settings_fields('privacore-ssb-settings-group'); ?>
        <?php do_settings_sections('privacore-ssb-settings-group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e('Default auto adding', 'privacore-ssb'); ?></th>
                <td><input type="checkbox" name="pssb_display_auto"
                           value="1" <?php echo esc_attr(get_option('pssb_display_auto')) == 1 ? 'checked' : ''; ?> />
                </td>
            </tr>
            <tr valign="top" class="pssbSettingsInfoRow">
                <td colspan="2">
                    <span class="pssbSettingsInfoMessage">
                        <?php _e('Note: If option above is checked by default "Show SSB Buttons on page" will be selected and SSB buttons will automatically displayed after content on every post, page or custom post type.', 'privacore-ssb'); ?></span>
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>
    <!-- End Settings Form-->

    <!-- Info Section -->
    <div class="pssbInfoSection">
        <h2 class="title"><?php _e('Privacore SSB information', 'privacore-ssb'); ?></h2>
        <p><?php _e('If you need to add manually SSB buttons to your post, page or custom post type use shortcode placed below.', 'privacore-ssb'); ?></p>
        <p>
           <code>
               [privacore-ssb-sc]
           </code>
        </p>
    </div>
    <!-- End Info Section -->
</div>
<!-- End Settings page wrap -->