<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="apsp-outer-wrapper">
    <div class='apsp-main-wrapper'>
        <div class="apsp-setting-header clearfix">
            <div class="apsp-headerlogo">
                <img src="<?php echo APSP_IMAGE_DIR; ?>/logo.png" alt="<?php esc_attr_e('AccessPress Pinterest', 'accesspress-pinterest' ); ?>" />
            </div>
            <div class="apsp-right-header-block">
                <div class="apsp-header-icons">
                    <p>Follow us for new updates</p>
                    <div class="apsp-social-bttns">
                        <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FAccessPress-Themes%2F1396595907277967&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35&amp;appId=1411139805828592" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:20px; width:50px " allowtransparency="true"></iframe>
                        &nbsp;&nbsp;
                        <iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/follow_button.5f46501ecfda1c3e1c05dd3e24875611.en.html#_=1421918256492&amp;dnt=true&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=apthemes&amp;show_count=false&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button twitter-follow-button" title="Twitter Follow Button" data-twttr-rendered="true" style="width: 126px; height: 20px;"></iframe>
                        <script>
                            !function (d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (!d.getElementById(id)) {
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "//platform.twitter.com/widgets.js";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }
                            }(document, "script", "twitter-wjs");
                        </script>

                    </div>
                </div>
                <div class="apsp-header-title">
                    <?php _e('AccessPress Pinterest', 'accesspress-pinterest' ); ?>
                </div>
            </div>
        </div>

        <?php
        $options = get_option(APSP_SETTINGS);
        if (isset($_SESSION['apsp_message'])) {
            ?>
            <div class="apsp-message">
                <p><?php
                    echo $_SESSION['apsp_message'];
                    unset($_SESSION['apsp_message']);
                    ?></p>
            </div>
        <?php } ?>

        <div class="apsp-backend-wrapper clearfix">
            <ul class="apsp-setting-tabs">
                <li><a href="javascript:void(0)" id="apsp-pinit-hover-settings" class="apsp-tabs-trigger apsp-active-tab	"><i class="fa fa-pinterest-square"></i><?php _e('Pinterest pin it settings', 'accesspress-pinterest' ); ?></a></li>
                <li><a href="javascript:void(0)" id="apsp-how-to-use" class="apsp-tabs-trigger"><i class="fa fa-cog"></i><?php _e('How To Use', 'accesspress-pinterest' ); ?></a></li>
                <li><a href="javascript:void(0)" id="apsp-about" class="apsp-tabs-trigger"><i class="fa fa-key"></i><?php _e('About', 'accesspress-pinterest' ); ?></a></li>
                <li><a href="http://wpall.club/" target='_blank' id="apsp-resources" class="apsp-tabs-trigger"><i class="fa fa-key"></i><?php _e('More WordPress Resources', 'accesspress-pinterest' ); ?></a></li>
            </ul>

            <div class="apsp-form-wrap">
                <form action="<?php echo admin_url() . 'admin-post.php' ?>" method='post'>
                    <div class='apsp-tab-contents apsp-active-tab' id='tab-apsp-pinit-hover-settings'>
                        <h2 class="apsp-title"><?php _e('Pinterest pinit.js Loading settings', 'accesspress-pinterest' ); ?></h2>
                        <div class="disable-wrap clearfix">
                            <label class='apsp-disable-pinit-js'><?php _e('Disable pinit.js?', 'accesspress-pinterest' ); ?> </label>
                            <div class="check-box-disable">
                                <input type='checkbox' id='apsp-disable-pinit-js' name='apsp-pinit-js-disable' <?php if (isset($options['pinit_js_disable']) && $options['pinit_js_disable'] == 'on') { ?> checked='checked'; <?php } ?>/> <label for='apsp-disable-pinit-js' ><?php _e('Disable output of pinit.js, the JavaScript file from this plugin.', 'accesspress-pinterest' ); ?></label>
                                <p class='apsp-info'><?php _e('Check this option if you have pinit.js already called in another plugin or theme. Multiple insertion of pinit.js on a page can cause conflicts.', 'accesspress-pinterest' ); ?></p>
                            </div>
                        </div>
                        <h2 class="apsp-title"><?php _e('Pinterest Pin it Hover Settings', 'accesspress-pinterest' ); ?></h2>
                        <input type="hidden" name="action" value="apsp_save_options" />
                        <input type='checkbox' id='apsp_js_enabled' name='apsp-pinit-js' <?php if (isset($options['js_enabled']) && $options['js_enabled'] == 'on') { ?> checked='checked'; <?php } ?>/> <label for='apsp_js_enabled'><?php _e('Enable the Pin It hover button over images.', 'accesspress-pinterest' ); ?></label>

                        <div class="apsp-display-settings" <?php if(isset($options['js_enabled']) && $options['js_enabled'] == 'on'){ ?> style='display:block;' <?php }else{ ?> style='display:none;' <?php } ?>>
                            <h3 class="apspp-sub-title"><?php _e('On which pages the pinterest button should be displayed?', 'accesspress-pinterest'  ); ?></h3>
                            <!-- Custom pinterest button dispaly settings in wordpress pages and posts -->
                            <p><input type="checkbox" id="apsp_home_page"   value="home_page"   name="apsp_display_settings[display_options][]"    <?php if (isset($options['display_options']) && in_array("home_page", $options['display_options'])) {                                                           echo "checked='checked'"; } ?> ><label for="apspp_home_page">   <?php _e('Home page(latest blog posts)', 'accesspress-pinterest'  ); ?></label></p>
                            <p><input type="checkbox" id="apsp_front_page"  value="front_page"  name="apsp_display_settings[display_options][]"    <?php if (isset($options['display_options']) && in_array("front_page", $options['display_options'])) {                                                          echo "checked='checked'"; } ?> ><label for="apspp_front_page">  <?php _e('Front page(static home page assigned from settings->reading)', 'accesspress-pinterest'  ); ?></label></p>
                            <p><input type="checkbox" id="apsp_posts"       value="post"        name="apsp_display_settings[display_options][]"    <?php if (isset($options['display_options']) && (in_array("post", $options['display_options']) || in_array("posts", $options['display_options']))) {            echo "checked='checked'"; } ?> ><label for="apspp_posts">       <?php _e( 'Posts', 'accesspress-pinterest'  ); ?> </label></p>
                            <p><input type="checkbox" id="apsp_pages"       value="page"        name="apsp_display_settings[display_options][]"    <?php if (isset($options['display_options']) && (in_array("page", $options['display_options']) || in_array("pages", $options['display_options']))) {            echo "checked='checked'"; } ?> ><label for="apspp_pages">       <?php _e( 'Pages', 'accesspress-pinterest'  ); ?> </label></p>
                            <p><input type="checkbox" id="apsp_categories"  value="categories"  name="apsp_display_settings[display_options][]"    <?php if (isset($options['display_options']) && (in_array("categories", $options['display_options']) || in_array("categories", $options['display_options']))) { echo "checked='checked'"; } ?> ><label for="apspp_categories">  <?php _e( 'Categories', 'accesspress-pinterest'  ); ?> </label></p>
                            <p><input type="checkbox" id="apsp_archives"    value="archives"    name="apsp_display_settings[display_options][]"    <?php if (isset($options['display_options']) && in_array("archives", $options['display_options'])) {                                                            echo "checked='checked'"; } ?> ><label for="apspp_archives">    <?php _e('Archives', 'accesspress-pinterest'  ); ?></label></p>
                            <?php
                            $post_types = self::get_registered_post_types();

                            if (!empty($post_types)) { ?>
                                <label><?php _e('Available Custom Post types:', 'accesspress-pinterest'); ?></label>
                                <?php
                                foreach ($post_types as $key => $value) {
                                    $objects = get_post_type_object($value);
                                    ?>
                                    <p><input type="checkbox" id="apspp_<?php echo $key; ?>" value="<?php echo $value; ?>" name="apsp_display_settings[display_options][]" <?php if( isset($options['display_options']) && (in_array($key, $options['display_options']))) { echo "checked='checked'"; } ?> ><label for="apsp_<?php echo $key; ?>"><?php _e($objects->labels->name, 'accesspress-pinterest'); ?></label></p>
                                    <?php
                                }
                            }

                            $taxonomies = self::get_registered_taxonomies();
                            if (!empty($taxonomies)) { ?>
                                <label><?php _e('Available Taxonomies:', 'accesspress-pinterest'); ?></label>
                                <?php
                                foreach ($taxonomies as $key => $value) { ?>
                                    <?php $required_tax_objects = $value->labels; ?>
                                    <?php $name = $required_tax_objects->name; ?>
                                    <p><input type="checkbox" id="apspp_<?php echo $value->name; ?>" value="<?php echo $value->name; ?>" name="apsp_display_settings[display_options][]" <?php if (in_array($value->name, $options['display_options'])) { echo "checked='checked'"; } ?> ><label for="apsp_<?php echo $value->name; ?>"><?php _e($name, 'accesspress-pinterest'); ?></label></p>
                                    <?php
                                }
                            } ?>
                        </div>

                        <h3 class="apsp-sub-title"><?php _e('Button apperance settings', 'accesspress-pinterest' ); ?></h3>
                        <div class="apsp-select-wrapper">
                            <label for='apsp-pinterest-button-size'><?php _e('size:', 'accesspress-pinterest' ); ?> </label>
                            <select name='apsp-pinterest-button-size' id='apsp-pinterest-button-size'>
                                <option value='small' <?php selected($options['size'], 'small'); ?>><?php _e('Small', 'accesspress-pinterest' ); ?></option>
                                <option value='28' <?php selected($options['size'], '28'); ?>><?php _e('Large', 'accesspress-pinterest' ); ?></option>
                            </select>
                        </div>

                        <div class="apsp-select-wrapper">
                            <label for='apsp-pinterest-button-shape'><?php _e('shape:', 'accesspress-pinterest' ); ?> </label>
                            <select name='apsp-pinterest-button-shape' id='apsp-pinterest-button-shape'>
                                <option value='rectangular' <?php selected($options['shape'], 'rectangular'); ?> ><?php _e('Rectangular', 'accesspress-pinterest' ); ?></option>
                                <option value='round' <?php selected($options['shape'], 'round'); ?> ><?php _e('Circular', 'accesspress-pinterest' ); ?></option>
                            </select>
                        </div>
                        <div class="apsp-rectangular-options" <?php if ($options['shape'] == 'rectangular') { ?> style="display:block;" <?php } else { ?>style='display:none;' <?php } ?>>
                            <h3 class="apsp-sub-title"><?php _e('Options for rectangular shape button', 'accesspress-pinterest' ); ?></h3>
                            <div class="apsp-select-wrapper">
                                <label for='apsp-pinterest-rectangle-lang'><?php _e('Language:', 'accesspress-pinterest'); ?></label>
                                <select name='apsp-pinterest-rectangle-lang' id='apsp-pinterest-rectangle-lang'>
                                    <option value='english' <?php selected($options['language'], 'en'); ?> ><?php _e('English', 'accesspress-pinterest'); ?></option>
                                    <option value='cs' <?php selected($options['language'], 'cs'); ?> ><?php _e('Czech', 'accesspress-pinterest'); ?></option>
                                    <option value='da' <?php selected($options['language'], 'da'); ?> ><?php _e('Danish', 'accesspress-pinterest'); ?></option>
                                    <option value='de' <?php selected($options['language'], 'de'); ?> ><?php _e('German', 'accesspress-pinterest'); ?></option>
                                    <option value='el' <?php selected($options['language'], 'el'); ?> ><?php _e('Greek', 'accesspress-pinterest'); ?></option>
                                    <option value='es' <?php selected($options['language'], 'es'); ?> ><?php _e('Spanish', 'accesspress-pinterest'); ?></option>
                                    <option value='fi' <?php selected($options['language'], 'fi'); ?> ><?php _e('Finnish', 'accesspress-pinterest'); ?></option>
                                    <option value='fr' <?php selected($options['language'], 'fr'); ?> ><?php _e('French', 'accesspress-pinterest'); ?></option>
                                    <option value='hi' <?php selected($options['language'], 'hi'); ?> ><?php _e('Hindu', 'accesspress-pinterest'); ?></option>
                                    <option value='hu' <?php selected($options['language'], 'hu'); ?> ><?php _e('Hungarian', 'accesspress-pinterest'); ?></option>
                                    <option value='id' <?php selected($options['language'], 'id'); ?> ><?php _e('Indonesian', 'accesspress-pinterest'); ?></option>
                                    <option value='it' <?php selected($options['language'], 'it'); ?> ><?php _e('Italian', 'accesspress-pinterest'); ?></option>
                                    <option value='ja' <?php selected($options['language'], 'ja'); ?> ><?php _e('Japanese', 'accesspress-pinterest'); ?></option>
                                    <option value='ko' <?php selected($options['language'], 'ko'); ?> ><?php _e('Korean', 'accesspress-pinterest'); ?></option>
                                    <option value='ms' <?php selected($options['language'], 'ms'); ?> ><?php _e('Malaysian', 'accesspress-pinterest'); ?></option>
                                    <option value='nb' <?php selected($options['language'], 'nb'); ?> ><?php _e('Norwegian', 'accesspress-pinterest'); ?></option>
                                    <option value='nl' <?php selected($options['language'], 'nl'); ?> ><?php _e('Dutch', 'accesspress-pinterest'); ?></option>
                                    <option value='pl' <?php selected($options['language'], 'pl'); ?> ><?php _e('Polish', 'accesspress-pinterest'); ?></option>
                                    <option value='pt' <?php selected($options['language'], 'pt'); ?> ><?php _e('Portuguese', 'accesspress-pinterest'); ?></option>
                                    <option value='pt-br' <?php selected($options['language'], 'pt-br'); ?> ><?php _e('Portuguese (Brazil)', 'accesspress-pinterest'); ?></option>
                                    <option value='ro' <?php selected($options['language'], 'ro'); ?> ><?php _e('Romanian', 'accesspress-pinterest'); ?></option>
                                    <option value='ru' <?php selected($options['language'], 'ru'); ?> ><?php _e('Russian', 'accesspress-pinterest'); ?></option>
                                    <option value='sk' <?php selected($options['language'], 'sk'); ?> ><?php _e('Slovak', 'accesspress-pinterest'); ?></option>
                                    <option value='sv' <?php selected($options['language'], 'sv'); ?> ><?php _e('Swedish', 'accesspress-pinterest'); ?></option>
                                    <option value='tl' <?php selected($options['language'], 'tl'); ?> ><?php _e('Tagalog', 'accesspress-pinterest'); ?></option>
                                    <option value='th' <?php selected($options['language'], 'th'); ?> ><?php _e('Thai', 'accesspress-pinterest'); ?></option>
                                    <option value='tr' <?php selected($options['language'], 'tr'); ?> ><?php _e('Turkish', 'accesspress-pinterest'); ?></option>
                                    <option value='uk' <?php selected($options['language'], 'uk'); ?> ><?php _e('Ukrainian', 'accesspress-pinterest'); ?></option>
                                    <option value='vi' <?php selected($options['language'], 'vi'); ?> ><?php _e('Vietnamese', 'accesspress-pinterest'); ?></option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class='apsp-tab-contents' id='tab-apsp-how-to-use' style="display:none">
                        <?php include('how-to-use.php'); ?>
                    </div>

                    <div class='apsp-tab-contents' id='tab-apsp-about' style="display:none">
                        <?php include('apsp-about.php'); ?>
                    </div>

                    <?php wp_nonce_field('apsp_nonce_save_settings', 'apsp_add_nonce_save_settings'); ?>
                    <input type='submit' name='apsp_save_settings' value='Save Settings' class="apsp-save-btn" />
                    <?php $nonce = wp_create_nonce('apsp-restore-default-settings-nonce'); ?>
                    <a class="apsp-btn-wrap" href="<?php echo admin_url() . 'admin-post.php?action=apsp_restore_default_settings&_wpnonce=' . $nonce; ?>" onclick="return confirm('<?php _e('Are you sure you want to restore default settings?', 'accesspress-pinterest'); ?>')"><input type="button" value="Restore Default Settings" class="apsp-reset-button"/></a>
                </form>
            </div> <!-- apsp form wrapper -->
        </div> <!-- apsp backend wrapper -->
    </div> <!-- apsp main wrapper -->

    <div class='apsp-add-wrapper'>
        <a href="https://accesspressthemes.com/wordpress-plugins/accesspress-pinterest-pro/" target="_blank" ><img src="<?php echo APSP_IMAGE_DIR; ?>/promo-top.jpg" alt="promo-top"></a>
        <div class="apsp-promo-buttons"><a target="_blank" href="http://demo.accesspressthemes.com/wordpress-plugins/accesspress-pinterest-pro"><img src="<?php echo APSP_IMAGE_DIR; ?>/demo-btn.png" alt="demo link"></a><a target="_blank" href="http://codecanyon.net/item/accesspress-pinterest-pro/11038373?ref=AccessKeys"><img src="<?php echo APSP_IMAGE_DIR; ?>/upgrade-btn.png" alt="upgrade link"></a></div>
        <a href="https://accesspressthemes.com/wordpress-plugins/accesspress-pinterest-pro/" target="_blank" ><img src="<?php echo APSP_IMAGE_DIR; ?>/promo-bottom.jpg" alt="promo-bottom"></a>
        <div class="apsp-promo-buttons"><a target="_blank" href="http://demo.accesspressthemes.com/wordpress-plugins/accesspress-pinterest-pro"><img src="<?php echo APSP_IMAGE_DIR; ?>/demo-btn.png" alt="demo link"></a><a target="_blank" href="http://codecanyon.net/item/accesspress-pinterest-pro/11038373?ref=AccessKeys"><img src="<?php echo APSP_IMAGE_DIR; ?>/upgrade-btn.png" alt="upgrade link"></a></div>
    </div> <!-- apsp-add-wrapper  -->
</div> <!-- apsp outer wrapper -->