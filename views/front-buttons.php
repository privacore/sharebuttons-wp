<div class="pssbSocialButtons">
    <!-- Twitter Button -->
    <a class="pssbButton"
       href="https://twitter.com/intent/tweet?text=<?php echo $twitter_text; ?>&amp;url=<?php echo $post_url; ?>"
       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
        <img class="alignnone wp-image-802" src="<?php echo $plugin_url; ?>assets/images/TwitterLogo_50.png"
             alt="Share this post on twitter"/></a>
    <!-- End Twitter Button -->

    <!-- LinkedIn Button -->
    <a class="pssbButton"
       href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $post_url; ?>&amp;title=<?php echo $linkedin_title; ?>&amp;summary=<?php echo $linkedin_summary; ?>&amp;source=<?php echo get_site_url(); ?>"
       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
        <img class="alignnone wp-image-808" src="<?php echo $plugin_url; ?>assets/images/linkein-logo_50.png"
             alt="Share this post on Linkedin"/></a>
    <!-- End LinkedIn Button -->

    <!-- Facebook Button -->
    <a class="pssbButton"
       href="https://www.facebook.com/sharer/sharer.php? u=<?php echo $post_url; ?>&amp;picture=<?php echo $social_image; ?>&amp;title=<?php echo $facebook_title; ?>&amp;description=<?php echo $facebook_description; ?>"
       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
       target="_blank">
        <img class="alignnone wp-image-815"
             src="<?php echo $plugin_url; ?>assets/images/facebook_logo_50.png" alt="Share this on Facebook"/></a>
    <!-- End Facebook Button -->
</div>
