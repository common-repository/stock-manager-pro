<?php
//	Function to build the actual stock report
	global $woocommerce, $wpdb, $product, $pagenow;
	//Get simple/downloadable/virtual products stock. Grouped don't have stock. Variations need a separate query
	// Get product variations stock
	$stock_variations = (array) get_posts($args);
	// Get variable products stock (where stock is set for the parent)
	$stock_variable_products = (array) get_posts($args);
	// Merge results
	<script type="text/javascript" charset="utf-8">
	<div id="poststuff" class="woocommerce-reports-wrap halved">
									// If do_variations is true then first find out all variations
											if ( $product->product_type == 'variation' ) {
// ### Functions to process the stock fluctuations
	global $wpdb;
	$table_name = $wpdb->prefix . "stockmanager";
	//walk through all fields and check if numeric. 
	foreach ( $_POST as $key => $val ) {