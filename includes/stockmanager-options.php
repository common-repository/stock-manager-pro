<?php 
function setting_radio_1_fn() {	$options = get_option( 'plugin_options_smp' );	$items = array( "Yes" => __( "Yes" ), "No" => __( "No" ) );	foreach( $items as $key => $item ) {		if ( $options[ 'radio_buttons_1' ] == $key ) {			$checked = ' checked="checked" ';		} else {			$checked = '';		}		echo "<label><input " . $checked . " value='$key' name='plugin_options_smp[radio_buttons_1]' type='radio' /> $item</label><br />";	}}
function setting_radio_2_fn() {	$options = get_option( 'plugin_options_smp' );	$items = array( "Yes" => __( "Yes" ), "No" => __( "No" ) );	foreach( $items as $key => $item ) {		if ( $options[ 'radio_buttons_2' ] == $key ) {			$checked = ' checked="checked" ';		} else {			$checked = '';		}		echo "<label><input ".$checked." value='$key' name='plugin_options_smp[radio_buttons_2]' type='radio' /> $item</label><br />";	}}function  setting_dropdown_3_fn() {	$options = get_option( 'plugin_options_smp' );	$items = array( "10", "25", "50", "100" );	echo "<select id='dropdown_3' name='plugin_options_smp[dropdown_3]'>";	foreach($items as $item) {		if ( $options[ 'dropdown_3' ] == $item ) {			$selected = ' selected ';		} else {			$selected = '';		}		echo "<option value='$item' $selected>$item</option>";	}	echo "</select>";}
function  setting_dropdown_4_fn() {	$options = get_option( 'plugin_options_smp' );
	$items = array( "Y-m-d", "d-m-Y", "d-m-y", "d/m/Y", "d/m/y", "m/d/Y", "m/d/y", "d.m.Y", "d.m.y" );	echo "<select id='dropdown_4' name='plugin_options_smp[dropdown_4]'>";	foreach($items as $item) {		if ( $options[ 'dropdown_4' ] == $item ) {			$selected = ' selected ';		} else {			$selected = '';		}		echo "<option value='$item' $selected>$item</option>";	}	echo "</select>";}
function setting_radio_5_fn() {	$options = get_option( 'plugin_options_smp' );	$items = array( "24hr" => __( "24hr", "stockmanager" ), "12hr" => __( "12hr", "stockmanager" ) );	foreach( $items as $key => $item ) {		if ( $options[ 'radio_buttons_5' ] == $key ) {			$checked = ' checked="checked" ';		} else {			$checked = '';		}
		echo "<label><input ".$checked." value='$key' name='plugin_options_smp[radio_buttons_5]' type='radio' /> $item</label><br />";	}}
function  setting_dropdown_6_fn() {	$options = get_option( 'plugin_options_smp' );	$items = array( "10", "25", "50", "100" );	echo "<select id='dropdown_6' name='plugin_options_smp[dropdown_6]'>";	foreach($items as $item) {		if ( $options[ 'dropdown_6' ] == $item ) {			$selected = ' selected ';		} else {			$selected = '';		}		echo "<option value='$item' $selected>$item</option>";	}	echo "</select>";}
// the report section header textfunction section_report_text_fn() {}
// the history section header textfunction section_history_text_fn() {}
// display the admin options pagefunction plugin_options_page() {	?>	<div id="poststuff" class="woocommerce-reports-wrap halved">		<div class="woocommerce-reports-left">			<div class="postbox">				<h3><span><?php _e( 'Stock report options', 'stockmanager' ); ?></span></h3>				<div class="inside">					<p><?php _e( 'View and set the options for the Stock report plugin.', 'stockmanager' ); ?></p>					<form action="options.php" method="post">						<?php settings_fields('plugin_options_smp'); ?>						<?php do_settings_sections('stock_manager'); ?>						<input name="Submit" class = "button-primary" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />					</form>				</div>			</div>		</div>	</div>	<?php}?>