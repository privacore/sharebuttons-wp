<!-- Settings page wrap -->
<div class="wrap">
    <h1><?php _e('Privacore SSB Settings', 'privacore-ssb'); ?></h1>
    <!-- Settings Form-->
    <form method="post" action="options.php">
        <?php settings_fields('privacore-ssb-settings-group'); ?>
        <?php do_settings_sections('privacore-ssb-settings-group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e('Enable auto adding', 'privacore-ssb'); ?></th>
                <td><input type="checkbox" name="pssb_display_auto"
                           value="1" <?php echo esc_attr(get_option('pssb_display_auto')) == 1 ? 'checked' : ''; ?> />
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>
    <!-- End Settings Form-->

    <!-- Info Section -->
    <div class="pssbInfoSection">
        <h2 class="title"><?php _e('Privacore SSB information', 'privacore-ssb'); ?></h2>

        <p>
            <!-- TODO: Add description how to use plugin -->
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
            scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
            electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of
            Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like
            Aldus PageMaker including versions of Lorem Ipsum.
        </p>
    </div>
    <!-- End Info Section -->
</div>
<!-- End Settings page wrap -->