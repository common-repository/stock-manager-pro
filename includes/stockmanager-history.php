<?php
// get the time in either 12 or 24 hr formatfunction get_time( $time ) {	$options = get_option( 'plugin_options_smp' );	$time_format = $options[ 'radio_buttons_5' ];	if ( $time_format == "24hr" ) {		return $time;	} else {		// Make it into a Unix TimeStamp 		$timestamp = strtotime( $time ); 		$time12h = date( "g:i:s A", $timestamp ); 		return $time12h;	}}
// get date in the format the user chosefunction get_date( $date ) {	$options = get_option( 'plugin_options_smp' );	$date_format = $options[ 'dropdown_4' ];	return date_format( date_create( $date ), $date_format ) ;}// get date for sortingfunction get_sort_date( $date ) {	$tmp = date_create( $date );	return date_format($tmp, 'Y') . date_format($tmp, 'm') . date_format($tmp, 'd');}
// Get the actual result lines for the stock history reportfunction get_results() {
	global $wpdb; 
	$table_name = $wpdb->prefix . "stockmanager";	$query = 'SELECT * FROM ' . $table_name ;	$records = $wpdb->get_results( $query );
	foreach ( $records as $record ) {		$id = $record->id; 		$tmp = $record->time;		$date = get_date( $tmp );		$sortdate = get_sort_date( $tmp );		$arr_tmp = explode( " ", $tmp );		$time = get_time( $arr_tmp[ 1 ] );		$comment = $record->comments;		echo '<tr onClick="window.location.href=\'?page=stock-manager&tab=history&id=' . $id . '\'"><td style="display:none">' . $sortdate . '</td><td>' . $date . '</td><td>' . $time . '</td><td>' . $comment . '</td></tr>';	}}
// display the stock report history pagefunction stockreport_history_page() {
	global $pagenow;	?>	<script type="text/javascript" charset="utf-8">	jQuery(document).ready(function ($) {		$('#history').dataTable( {			"oLanguage": {				"sLengthMenu": <?php echo '"' . __( 'Display', 'stockmanager') . ' _MENU_ ' . __('records per page', 'stockmanager') . '"'; ?>,				"sZeroRecords": <?php echo '"' . __( 'Nothing found - sorry', 'stockmanager' ) . '"'; ?>,				"sInfo": <?php echo'"'.__( 'Showing', 'stockmanager' ) . ' _START_ ' . __( 'to', 'stockmanager' ) . ' _END_ ' . __( 'of', 'stockmanager' ) . ' _TOTAL_ ' . __( 'records', 'stockmanager' ) .'"'; ?>,				"sInfoFiltered": <?php echo'"'.__( 'filtered from', 'stockmanager' ) . ' _MAX_ ' . __( 'total records', 'stockmanager' ).'"'; ?>,				"sSearch": <?php echo'"'.__( 'Apply filter', 'stockmanager' ) . ' _INPUT_ ' . __( 'to table', 'stockmanager' ).'"'; ?>			},			"bPaginate": true,			"aoColumnDefs": [				{ "iDataSort": 0, "aTargets": [ 1 ] }			],			"aaSorting": [[0,'desc']], 			<?php			$options = get_option( 'plugin_options_smp' );			$display = $options[ 'dropdown_6' ];			echo '"iDisplayLength": ' . (int)$display . ','			?>		} );	} );	</script>		<div id="poststuff" class="woocommerce-reports-wrap halved">		<div class="woocommerce-reports-left">			<div class="postbox">				<h3><span><?php _e( 'Stock mutation history', 'stockmanager' ); ?></span></h3>				<div class="inside">					<?php					echo '<table id="history" class="history">';						echo '<thead>';							echo '<tr>';								echo '<th style="display:none"></th>';								echo '<th>' . __( 'Date', 'woocommerce' ) . '</th>';								echo '<th>' . __( 'Time', 'stockmanager' ) . '</th>';								echo '<th>' . __( 'Description', 'woocommerce' ) . '</th>';							echo '</tr>';						echo '</thead>';						echo '<tbody>';							echo get_results();						echo '</tbody>';					echo '</table>';?>				</div>			</div>		</div>	</div><?php}
// Build the actual detail rowsfunction get_details( $mutations, $oldstock ) {	if ( is_array( $mutations ) ) {		foreach( $mutations as $key => $detail ) {			$product = get_product( $key );			$title = $product->get_title();			if ( $product->product_type == 'variation' ) {				$attribs = $product->get_variation_attributes();				foreach ( $attribs as $label => $val ) {					$title = $title . ' ' . $val;				}			}			$old = $oldstock[ $key ];			$new = (int)$detail + (int)$old;			echo '<tr><td>' . $title . '</td><td>' . $detail . '</td><td>' . $old . '</td><td>' . $new . '</td></tr>';		}	}}
// display the stock report history detailsfunction stockreport_history_details_page() {
	global $wpdb;
    $tab = $_GET[ 'id' ];	$table_name = $wpdb->prefix . "stockmanager";	$query = 'SELECT * FROM ' . $table_name . ' WHERE id=' . $tab;	$record = $wpdb->get_row( $query );	$tmp = $record->time;	$date = get_date( $tmp );	$comment = $record->comments;	$mutations = unserialize( $record->mutations );	$oldstock = unserialize( $record->oldstock );	?>	<div id="poststuff" class="woocommerce-reports-wrap halved">		<div class="woocommerce-reports-left">			<div class="postbox">				<h3><span><?php echo $date . ': ' . $comment; ?></span></h3>				<div class="inside">					<?php					echo '<table id="history" class="history">';						echo '<thead>';							echo '<tr>';								echo '<th>' . __( 'Description', 'woocommerce' ) . '</th>';								echo '<th>' . __( 'Mutation', 'stockmanager' ) . '</th>';								echo '<th>' . __( 'Before mutation', 'stockmanager' ) . '</th>';								echo '<th>' . __( 'After mutation', 'stockmanager' ) . '</th>';							echo '</tr>';						echo '</thead>';						echo '<tbody>';							echo get_details($mutations, $oldstock);						echo '</tbody>';					echo '</table>';					echo '<br/><input type="submit" class="button-primary" onclick="window.location.href=\'?page=stock-manager&tab=history\'" value="' . __( 'Back', 'stockmanager' ) . '">';					?>				</div>			</div>		</div>	</div><?php}?>