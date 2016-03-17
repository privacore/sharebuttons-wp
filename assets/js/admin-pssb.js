/**
 * Created by Miroslav Marinov on 2.3.2016.
 */

(function ($) {

    $(function () {
        //Call Select Share Image function
        pssbAdmin.selectSocialImage();
    });

    /**
     * Privacore Social Share Button Object
     *
     * @type {{selectSocialImage: pssbAdmin.selectSocialImage}}
     */
    var pssbAdmin = {
        /**
         * Display upload/select media window
         */
        selectSocialImage: function () {
            //check if button exist
            if ($('.pssbSetCustomImages').length > 0) {

                //check if media editor is enabled
                if (typeof wp !== 'undefined' && wp.media && wp.media.editor) {
                    $('.wrap').on('click', '.pssbSetCustomImages', function (e) {
                        e.preventDefault();
                        var button = $(this);
                        //get image field
                        var field = button.prev();
                        wp.media.editor.send.attachment = function (props, attachment) {
                            var size = props.size;
                            //set selected image to value of selected image field
                            field.val(attachment.sizes[size].url);
                        };
                        wp.media.editor.open(button);
                        return false;
                    });
                }// ./end checking media editor
            }// ./end button exist check
        }
    };
    
})(jQuery.noConflict());
