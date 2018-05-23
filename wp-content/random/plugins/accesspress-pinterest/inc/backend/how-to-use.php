<h2 class="apsp-title">Pinterest pin it hover Help</h2>
<p>You can disable the pinterest image hover effect for each images by adding these attributes to images. </p>
<p>1) data-pin-no-hover="true"</p>
<p>2) nopin="nopin"</p>
<h4>Example: </h4>
<ul class="ul-disc">
    <li>&#60;img src="http://site-url/Penguins-300x225.jpg" alt="Penguins" data-pin-no-hover="true" /></li>
    <li>&#60;img src="http://site-url/Penguins-300x225.jpg" alt="Penguins" nopin="nopin" /></li>
</ul>

<h2 class="apsp-title">Shortcode Help</h2>
<h3 class="apsp-sub-title">Follow Button</h3>
<p>Use the shortcode <code>[apsp-follow-button]</code> to display the Pinterest Follow Button within your content.</p>
<p>Use the function <code>&lt;?php echo do_shortcode('[apsp-follow-button]'); ?&gt;</code>
    to display within template or theme files.</p>

<h4>Available Attributes: </h4>
<table class="widefat importers" cellspacing="0" border="1">
    <thead>
        <tr>
            <th>Attribute</th>
            <th>Description</th>
            <th>Default</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>name</td>
            <td>Pinterest username</td>
            <td>pinterest</td>
        </tr>
        <tr>
            <td>button_label</td>
            <td>Button label</td>
            <td>Follow Pinterest</td>
        </tr>
    </tbody>
</table>

<h4>Example: </h4>
<ul class="ul-disc">
    <li><code>[apsp-follow-button name='pinterest' button_label='Follow Pinterest']</code></li>
</ul>

<h3 class="apsp-sub-title">Pin Image Button</h3>
<p>Use the shortcode <code>[apsp-pin-image]</code> to display the Pinterest pin image within your content.</p>
<p>Use the function <code>&lt;?php echo do_shortcode('[apsp-pin-image]'); ?&gt;</code>
    to display within template or theme files.</p>

<h4>Available Attributes: </h4>
<table class="widefat importers" cellspacing="0" border="1">
    <thead>
        <tr>
            <th>Attribute</th>
            <th>Description</th>
            <th>Default</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>image_url</td>
            <td>Please enter the pinterest image url here.</td>
            <td>https://www.pinterest.com/pin/434034482809764694/</td>
        </tr>
    </tbody>
</table>

<h4>Example: </h4>
<ul class="ul-disc">
    <li><code>[apsp-pin-image image_url='https://www.pinterest.com/pin/434034482809764694/']</code></li>
</ul>

<h3 class="apsp-sub-title">Profile Widget</h3>
<p>Use the shortcode <code>[apsp-profile-widget]</code> to display the Pinterest pin image within your content.</p>
<p>Use the function <code>&lt;?php echo do_shortcode('[apsp-profile-widget]'); ?&gt;</code>
    to display within template or theme files.</p>

<h4>Available Attributes: </h4>
<table class="widefat importers" cellspacing="0" border="1">
    <thead>
        <tr>
            <th>Attribute</th>
            <th>Description</th>
            <th>Default</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>profile</td>
            <td>Please enter the pinterest profile name.</td>
            <td>pinterest</td>
        </tr>
        <tr>
            <td>custom_size</td>
            <td>Please enter the widget sizes(square, sidebar, header, custom)</td>
            <td>square</td>
        </tr>
        <tr>
            <td colspan="4"><strong>The following options will take effect only when size is set to custom, otherwise they will be ignored.</strong></td>
        </tr>
        <tr>
            <td>image_width</td>
            <td>Please enter the image width here. Any number greater than 60.</td>
            <td>92</td>
        </tr>

        <tr>
            <td>board_height</td>
            <td>Please enter the widget height here. Any number greater than 60.</td>
            <td>172</td>
        </tr>

        <tr>
            <td>board_width</td>
            <td>Please enter the widget width here. Any number greater than 130.</td>
            <td>auto</td>
        </tr>

    </tbody>
</table>

<h4>Example: </h4>
<ul class="ul-disc">
    <li><code>[apsp-profile-widget profile="pinterest" custom_size='custom' image_width="100" board_height="540" board_width="800"]</code></li>
</ul>

<h3 class="apsp-sub-title">Board Widget</h3>
<p>Use the shortcode <code>[apsp-board-widget]</code> to display the Pinterest pin image within your content.</p>
<p>Use the function <code>&lt;?php echo do_shortcode('[apsp-board-widget]'); ?&gt;</code>
    to display within template or theme files.</p>

<h4>Available Attributes: </h4>
<table class="widefat importers" cellspacing="0" border="1">
    <thead>
        <tr>
            <th>Attribute</th>
            <th>Description</th>
            <th>Default</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>board_url</td>
            <td>Please enter the pinterest board url.</td>
            <td>pinterest</td>
        </tr>
        <tr>
            <td>custom_size</td>
            <td>Please enter the widget sizes(square, sidebar, header, custom)</td>
            <td>square</td>
        </tr>
        <tr>
            <td colspan="4"><strong>The following options will take effect only when size is set to custom, otherwise they will be ignored.</strong></td>
        </tr>
        <tr>
            <td>image_width</td>
            <td>Please enter the image width here. Any number greater than 60.</td>
            <td>92</td>
        </tr>

        <tr>
            <td>board_height</td>
            <td>Please enter the widget height here. Any number greater than 60.</td>
            <td>172</td>
        </tr>

        <tr>
            <td>board_width</td>
            <td>Please enter the widget width here. Any number greater than 130.</td>
            <td>auto</td>
        </tr>

    </tbody>
</table>

<h4>Example: </h4>
<ul class="ul-disc">
    <li><code>[apsp-board-widget board_url="http://www.pinterest.com/pinterest/pin-pets/" custom_size='custom' image_width="100" board_height="540" board_width="800"]</code></li>
</ul>

<h3 class="apsp-sub-title">Latest Pins Widget</h3>
<p>Use the shortcode <code>[apsp-latest-pins]</code> to display the latest Pinterest pin images within your widget.</p>
<p>Use the function <code>&lt;?php echo do_shortcode('[apsp-latest-pins]'); ?&gt;</code>
    to display within template or theme files.</p>

<h4>Available Attributes: </h4>
<table class="widefat importers" cellspacing="0" border="1">
    <thead>
        <tr>
            <th>Attribute</th>
            <th>Description</th>
            <th>Default</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>feed_url</td>
            <td>Please enter the pinterest url.</td>
            <td>https://www.pinterest.com/pinterest</td>
        </tr>
        <tr>
            <td>specific_board</td>
            <td>Please enter the specific board name here if you want to display for specific board.</td>
            <td>Default: none</td>
        </tr>
        <tr>
            <td>feed_count</td>
            <td>You can specify the feed counts from here.</td>
            <td>1</td>
        </tr>

        <tr>
            <td>caption</td>
            <td>You can enable or disable the image caption from here.</td>
            <td>No</td>
        </tr>
        <tr>
            <td>show_pinterest_link</td>
            <td>You can enable or disable the pinterest link from here.</td>
            <td>No</td>
        </tr>
    </tbody>
</table>

<h4>Example: </h4>
<ul class="ul-disc">
    <li><code>[apsp-latest-pins feed_url='https://www.pinterest.com/pinterest' specific_board='breakfast-favorites' feed_count='5' caption='1' show_pinterest_link='yes']</code></li>
</ul>

<h3 class="apsp-sub-title">Save button</h3>
<p>Use the shortcode <code>[apsp_save_button]</code> to display the save button to posts/pages.</p>
<p>Use the function <code>&lt;?php echo do_shortcode('[apsp_save_button]'); ?&gt;</code>
    to display within template or theme files.</p>

<h4>Available Attributes: </h4>
<table class="widefat importers" cellspacing="0" border="1">
    <thead>
        <tr>
            <th>Attribute</th>
            <th>Description</th>
            <th>Default</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>type</td>
            <td>Please enter the save button type(one-image, any-image).</td>
            <td>default: any-image</td>
        </tr>
        <tr>
            <td>shape</td>
            <td>Please enter the shape of the save button(round, rectangle).</td>
            <td>Default: rectangle</td>
        </tr>
        <tr>
            <td>size</td>
            <td>Please enter the size of the save button(small, large).</td>
            <td>Default: large</td>
        </tr>

        <tr>
            <td>save_url</td>
            <td>Please enter the url where you want to link the save button.</td>
            <td>Note: This parameter is required only for type:one-image</td>
        </tr>
        <tr>
            <td>save_image</td>
            <td>Please enter the url of the image where the pin will appear.</td>
            <td>Note: This parameter is required only for type:one-image</td>
        </tr>

        <tr>
            <td>image_description</td>
            <td>Please enter the description of the image or link which will describe it.</td>
            <td>Note: This parameter is required only for type:one-image</td>
        </tr>

        <tr>
            <td>count_position</td>
            <td>Please enter the position of the save button count(above, beside).</td>
            <td>Note: This parameter is required only for type:one-image</td>
        </tr>
    </tbody>
</table>

<h4>Example: </h4>
<ul class="ul-disc">
    <li>1. <code>[apsp_save_button type='one-image' shape='rectangle' size='small' save_url='https://www.flickr.com/photos/kentbrew/6851755809' save_image='https://farm8.staticflickr.com/7027/6851755809_df5b2051c9_z.jpg' image_description='Next stop: Pinterest']</code></li>
    <li>2. <code>[apsp_save_button type='any-image' shape='rectangle' size='large']</code></li>
</ul>

<h3 class="apsp-sub-title">Pinterest share button</h3>
<p>Use the shortcode <code>[apsp_share]</code> to display the Pinterest share button.</p>
<p>Use the function <code>&lt;?php echo do_shortcode('[apsp_share]'); ?&gt;</code>
    to display within template or theme files.</p>

<h2 class="apsp-title">Documentation</h2>
<p>Please go to the following link for the documentation of a plugin</p>
<p><a href='https://accesspressthemes.com/documentation/documentation-plugin-instruction-accesspress-pinterest' target="_blank">https://accesspressthemes.com/documentation/documentation-plugin-instruction-accesspress-pinterest</a></p>

