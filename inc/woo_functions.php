<?php
/*** Tiny account ***/
if( !function_exists('mydecor_tiny_account') ){
	function mydecor_tiny_account( $show_dropdown = true ){
		$login_url = '#';
		$register_url = '#';
		$profile_url = '#';
		$logout_url = wp_logout_url(get_permalink());

		if( class_exists('WooCommerce') ){
			$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
			if ( $myaccount_page_id ) {
			  $login_url = get_permalink( $myaccount_page_id );
			  $register_url = $login_url;
			  $profile_url = $login_url;
			}
		}
		else{
			$login_url = wp_login_url();
			$register_url = wp_registration_url();
			$profile_url = admin_url( 'profile.php' );
		}

		$_user_logged = is_user_logged_in();
		ob_start();

		?>
		<div class="ts-tiny-account-wrapper">
			<div class="account-control">

				<?php if( !$_user_logged ): ?>
					<a  class="login" href="<?php echo esc_url($login_url); ?>" title="<?php esc_attr_e('Login', 'mydecor'); ?>"></a>
				<?php else: ?>
					<a class="my-account" href="<?php echo esc_url($profile_url); ?>" title="<?php esc_attr_e('My Account', 'mydecor'); ?>"></a>
				<?php endif; ?>

				<?php if( $show_dropdown ): ?>
				<div class="account-dropdown-form dropdown-container">
					<div class="form-content">
						<?php if( !$_user_logged ): ?>
							<h2 class="dropdown-title"><?php esc_attr_e('Login', 'mydecor'); ?></h2>
							<?php wp_login_form( array('form_id' => 'ts-login-form') ); ?>
						<?php else: ?>
						<ul>
							<li><a class="my-account" href="<?php echo esc_url($profile_url); ?>" title="<?php esc_attr_e('My Account', 'mydecor'); ?>"><?php esc_html_e('My Account', 'mydecor'); ?></a></li>
							<li><a class="log-out" href="<?php echo esc_url($logout_url); ?>"><?php esc_html_e( 'Logout', 'mydecor' ); ?></a></li>
						</ul>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>

			</div>
		</div>

		<?php
		return ob_get_clean();
	}
}

/*** Tiny Cart ***/
if( !function_exists('mydecor_tiny_cart') ){
	function mydecor_tiny_cart( $show_cart_control = true, $show_cart_dropdown = true ){
		if( !class_exists('WooCommerce') ){
			return '';
		}
		$cart_empty = WC()->cart->is_empty();
		$cart_url = wc_get_cart_url();
		$checkout_url = wc_get_checkout_url();
		$cart_number = WC()->cart->get_cart_contents_count();
		ob_start();
		?>
			<div class="ts-tiny-cart-wrapper">
				<?php if( $show_cart_control ): ?>
				<div class="cart-icon">
					<a class="cart-control" href="<?php echo esc_url($cart_url); ?>" title="<?php esc_attr_e('View your shopping cart', 'mydecor'); ?>">
						<span class="ic-cart"><span class="cart-number"><?php echo esc_html($cart_number) ?></span></span>
					</a>
				</div>
				<?php endif; ?>

				<?php if( $show_cart_dropdown ): ?>
				<div class="cart-dropdown-form dropdown-container woocommerce">
					<div class="form-content <?php echo esc_attr( $cart_empty?'cart-empty':'' ); ?>">
						<?php if( $cart_empty ): ?>
							<h2 class="dropdown-title"><?php echo sprintf( esc_html__('Cart (%d)', 'mydecor'), $cart_number ) ?></h2>
							<div>
								<label><?php esc_html_e('Your cart is currently empty', 'mydecor'); ?></label>
								<a class="continue-shopping-button button-text" href="<?php echo wc_get_page_permalink('shop'); ?>"><?php esc_html_e('Continue Shopping', 'mydecor'); ?></a>
							</div>
						<?php else: ?>
							<h2 class="dropdown-title"><?php echo sprintf( esc_html__('Cart (%d)', 'mydecor'), $cart_number ) ?></h2>
							<a class="clear-cart-button" href="#"><?php esc_html_e('Clear All', 'mydecor'); ?></a>
							<div class="cart-wrapper">
								<div class="cart-content">
									<ul class="cart_list">
										<?php
										foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
											$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
											if ( !( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) ){
												continue;
											}
											$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
										?>
											<li class="woocommerce-mini-cart-item">
												<a class="thumbnail" href="<?php echo esc_url($product_permalink); ?>">
													<?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); ?>
												</a>
												<div class="cart-item-wrapper">
													<h3 class="product-name">
														<a href="<?php echo esc_url($product_permalink); ?>">
															<?php echo apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key); ?>
														</a>
													</h3>

													<span class="price"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></span>

													<?php
													if( $_product->is_sold_individually() ){
														$product_quantity = '<span class="quantity">1</span>';
													}else{
														$product_quantity = woocommerce_quantity_input( array(
															'input_name'  	=> "cart[{$cart_item_key}][qty]",
															'input_value' 	=> $cart_item['quantity'],
															'max_value'   	=> $_product->get_max_purchase_quantity(),
															'min_value'   	=> '0',
															'product_name'  => $_product->get_name()
														), $_product, false );
													}

													echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );

													echo '<div class="subtotal">'. apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) . '</div>';
													?>

													<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-cart_item_key="%s">&times;</a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'mydecor' ), $cart_item_key ), $cart_item_key ); ?>
												</div>
											</li>

										<?php endforeach; ?>
									</ul>
									<div class="dropdown-footer">
										<div class="total"><span class="total-title"><?php esc_html_e('Subtotal : ', 'mydecor');?></span><?php echo WC()->cart->get_cart_subtotal(); ?></div>

										<a href="<?php echo esc_url($cart_url); ?>" class="button view-cart"><?php esc_html_e('View Cart', 'mydecor'); ?></a>
										<a href="<?php echo esc_url($checkout_url); ?>" class="button checkout-button"><?php esc_html_e('Checkout', 'mydecor'); ?></a>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		<?php
		return ob_get_clean();
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'mydecor_tiny_cart_filter');
function mydecor_tiny_cart_filter($fragments){
	$cart_sidebar = cb_get_theme_options('ts_shopping_cart_sidebar');
	$fragments['.ts-tiny-cart-wrapper'] = mydecor_tiny_cart(true, !$cart_sidebar);
	if( $cart_sidebar ){
		$fragments['#ts-shopping-cart-sidebar .ts-tiny-cart-wrapper'] = mydecor_tiny_cart(false, true);
	}
	return $fragments;
}

add_action('wp_ajax_mydecor_update_cart_quantity', 'mydecor_update_cart_quantity');
add_action('wp_ajax_nopriv_mydecor_update_cart_quantity', 'mydecor_update_cart_quantity');
function mydecor_update_cart_quantity(){
	if( isset($_POST['cart_item_key'], $_POST['qty']) ){
		$cart_item_key = $_POST['cart_item_key'];
		$qty = $_POST['qty'];
		$cart =  WC()->cart->get_cart();
		if( isset($cart[$cart_item_key]) ){
			$qty = apply_filters( 'woocommerce_stock_amount_cart_item', wc_stock_amount( preg_replace( '/[^0-9\.]/', '', $qty ) ), $cart_item_key );
			if( !($qty === '' || $qty === $cart[$cart_item_key]['quantity']) ){
				if( !($cart[$cart_item_key]['data']->is_sold_individually() && $qty > 1) ){
					WC()->cart->set_quantity( $cart_item_key, $qty, false );
					$cart_updated = apply_filters( 'woocommerce_update_cart_action_cart_updated', true );
					if( $cart_updated ){
						WC()->cart->calculate_totals();
					}
				}
			}
		}
	}
	else if( isset($_POST['clear_cart']) ){
		WC()->cart->empty_cart();
	}
	WC_AJAX::get_refreshed_fragments();
}

