<?php
/**
 * Plugin Name: WooCommerce Filter Orders By Area
 * Plugin URI: https://github.com/LyleBennett/woocommerce-filter-orders-by-custom-field
 * Description: Adds a filter to the Edit Orders admin page to show orders by the custom field - billing area.
 * Version: 1.0.1
 * Author: LyleBennett
 * Author URI: https://github.com/LyleBennett/
 * Text Domain: ww-filter-orders
 */


if ( is_admin() ) {
	add_action( 'restrict_manage_posts', 'ww_restrict_orders', 50 );
	function ww_restrict_orders() {
		global $typenow;

		if ( 'shop_order' != $typenow ) {
			return;
		}

		?>
		<select name='ww_order_view' id='dropdown_ww_order_view'>
			<option <?php
				if ( isset( $_GET['ww_order_view'] ) && $_GET['ww_order_view'] ) {
					selected( 'all', $_GET['ww_order_view'] );
				}
			?> value="all"><?php esc_html_e( 'No Area Filter', 'ww-filter-orders' ); ?></option>
			<option <?php
			        if ( isset( $_GET['ww_order_view'] ) && $_GET['ww_order_view'] ) {
				        selected( 'atlantic-seaboard', $_GET['ww_order_view'] );
			        }
			        ?>value="atlantic-seaboard"><?php esc_html_e( 'Atlantic Seaboard', 'ww-filter-orders' ); ?></option>
			<option <?php
			        if ( isset( $_GET['ww_order_view'] ) && $_GET['ww_order_view'] ) {
				        selected( 'city-bowl', $_GET['ww_order_view'] );
			        }
			        ?>value="city-bowl"><?php esc_html_e( 'City Bowl', 'ww-filter-orders' ); ?></option>
			<option <?php
			        if ( isset( $_GET['ww_order_view'] ) && $_GET['ww_order_view'] ) {
				        selected( 'northern-suburbs', $_GET['ww_order_view'] );
			        }
			        ?>value="northern-suburbs"><?php esc_html_e( 'Northern Suburbs', 'ww-filter-orders' ); ?></option>
			<option <?php
			        if ( isset( $_GET['ww_order_view'] ) && $_GET['ww_order_view'] ) {
				        selected( 'southern-suburbs', $_GET['ww_order_view'] );
			        }
			        ?>value="southern-suburbs"><?php esc_html_e( 'Southern Suburbs', 'ww-filter-orders' ); ?></option>

		</select>
		<?php
	}

	add_filter( 'request', 'ww_orders_by_restrict_option', 100 );
	function ww_orders_by_restrict_option( $vars ) {
		global $typenow;
		$key = 'post__not_in';
		if ( 'shop_order' == $typenow && isset( $_GET['ww_order_view'] ) ) {


			//atlantic seaboard
			if ( 'atlantic-seaboard' == $_GET['ww_order_view'] ) {
				if ( ! empty( $key ) ) {
					$vars[ $key ] = get_posts( array(
						'posts_per_page' => -1,
						'post_type'      => 'shop_order',
						'post_status'    => 'any',
						'fields'         => 'ids',
						'orderby'        => 'date',
						'order'          => 'DESC',
						'meta_query'     => array(
							array(
								'key'     => '_billing_area',
								'value'   => 'Atlantic Seaboard',
								'compare' => '!=',
							),
						),
					) );

				}

			}

			//northern suburbs
			if ( 'northern-suburbs' == $_GET['ww_order_view'] ) {
				if ( ! empty( $key ) ) {
					$vars[ $key ] = get_posts( array(
						'posts_per_page' => -1,
						'post_type'      => 'shop_order',
						'post_status'    => 'any',
						'fields'         => 'ids',
						'orderby'        => 'date',
						'order'          => 'DESC',
						'meta_query'     => array(
							array(
								'key'     => '_billing_area',
								'value'   => 'Northern Suburbs',
								'compare' => '!=',
							),
						),
					) );

				}

			}

			//city bowl
			if ( 'city-bowl' == $_GET['ww_order_view'] ) {
				if ( ! empty( $key ) ) {
					$vars[ $key ] = get_posts( array(
						'posts_per_page' => -1,
						'post_type'      => 'shop_order',
						'post_status'    => 'any',
						'fields'         => 'ids',
						'orderby'        => 'date',
						'order'          => 'DESC',
						'meta_query'     => array(
							array(
								'key'     => '_billing_area',
								'value'   => 'City Bowl',
								'compare' => '!=',
							),
						),
					) );

				}

			}

			// southern suburbs

			if ( 'southern-suburbs' == $_GET['ww_order_view'] ) {
				if ( ! empty( $key ) ) {
					$vars[ $key ] = get_posts( array(
						'posts_per_page' => -1,
						'post_type'      => 'shop_order',
						'post_status'    => 'any',
						'fields'         => 'ids',
						'orderby'        => 'date',
						'order'          => 'DESC',
						'meta_query'     => array(
							array(
								'key'     => '_billing_area',
								'value'   => 'Southern Suburbs',
								'compare' => '!=',
							),
						),
					) );

				}

			}

		}

		return $vars;
	}
}
