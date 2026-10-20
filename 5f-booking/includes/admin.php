<?php
/**
 * Dashboard screens: hunt dates, booking details, settings.
 *
 * @package 5f-booking
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'admin_menu',
	static function () {
		add_submenu_page( 'edit.php?post_type=fivef_booking', __( 'Hunt Dates', '5f-booking' ), __( 'Hunt Dates', '5f-booking' ), 'edit_pages', 'fivef-bk-dates', 'fivef_bk_dates_screen' );
		add_submenu_page( 'edit.php?post_type=fivef_booking', __( 'Booking Settings', '5f-booking' ), __( 'Settings', '5f-booking' ), 'manage_options', 'fivef-bk-settings', 'fivef_bk_settings_screen' );
	}
);

/*
 * Hunt Dates.
 */

add_action( 'admin_post_fivef_bk_dates', 'fivef_bk_dates_save' );

/**
 * Add, open, close or remove dates.
 */
function fivef_bk_dates_save() {
	if ( ! current_user_can( 'edit_pages' ) ) {
		wp_die( esc_html__( 'Not allowed.', '5f-booking' ) );
	}
	check_admin_referer( 'fivef_bk_dates' );
	$type = isset( $_POST['type'] ) ? sanitize_key( wp_unslash( $_POST['type'] ) ) : '';
	$do   = isset( $_POST['do'] ) ? sanitize_key( wp_unslash( $_POST['do'] ) ) : '';
	$msg  = '';
	if ( fivef_bk_type( $type ) ) {
		if ( 'add' === $do ) {
			$from  = isset( $_POST['from'] ) ? sanitize_text_field( wp_unslash( $_POST['from'] ) ) : '';
			$until = isset( $_POST['until'] ) ? sanitize_text_field( wp_unslash( $_POST['until'] ) ) : '';
			$until = $until ? $until : $from;
			$count = 0;
			if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/', $from ) && preg_match( '/^\d{4}-\d{2}-\d{2}$/', $until ) && $until >= $from ) {
				$d = new DateTime( $from, new DateTimeZone( 'UTC' ) );
				$e = new DateTime( $until, new DateTimeZone( 'UTC' ) );
				while ( $d <= $e && $count < 60 ) {
					fivef_bk_set_date( $type, $d->format( 'Y-m-d' ), 1 );
					$d->modify( '+7 days' );
					$count++;
				}
			}
			/* translators: %d: number of dates */
			$msg = $count ? sprintf( _n( '%d date opened.', '%d dates opened.', $count, '5f-booking' ), $count ) : __( 'Pick a valid date.', '5f-booking' );
		} else {
			$date = isset( $_POST['date'] ) ? sanitize_text_field( wp_unslash( $_POST['date'] ) ) : '';
			if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/', $date ) ) {
				if ( 'open' === $do || 'close' === $do ) {
					fivef_bk_set_date( $type, $date, 'open' === $do ? 1 : 0 );
				} elseif ( 'remove' === $do ) {
					fivef_bk_set_date( $type, $date, null );
				}
				$msg = __( 'Saved.', '5f-booking' );
			}
		}
	}
	wp_safe_redirect(
		add_query_arg(
			array(
				'post_type' => 'fivef_booking',
				'page'      => 'fivef-bk-dates',
				'tab'       => $type,
				'msg'       => rawurlencode( $msg ),
			),
			admin_url( 'edit.php' )
		)
	);
	exit;
}

/**
 * Hunt Dates screen.
 */
function fivef_bk_dates_screen() {
	$types = fivef_bk_types();
	$tab   = isset( $_GET['tab'] ) && isset( $types[ sanitize_key( $_GET['tab'] ) ] ) ? sanitize_key( $_GET['tab'] ) : 'hog'; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$t     = $types[ $tab ];
	$msg   = isset( $_GET['msg'] ) ? sanitize_text_field( rawurldecode( wp_unslash( $_GET['msg'] ) ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$today = fivef_bk_today();
	$form  = static function ( $do, $date, $label, $class = 'button' ) use ( $tab ) {
		echo '<form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '" style="display:inline">';
		wp_nonce_field( 'fivef_bk_dates' );
		echo '<input type="hidden" name="action" value="fivef_bk_dates"><input type="hidden" name="type" value="' . esc_attr( $tab ) . '"><input type="hidden" name="do" value="' . esc_attr( $do ) . '"><input type="hidden" name="date" value="' . esc_attr( $date ) . '">';
		echo '<button class="' . esc_attr( $class ) . '"' . ( 'remove' === $do ? ' onclick="return confirm(\'Remove this date?\')"' : '' ) . '>' . esc_html( $label ) . '</button></form> ';
	};
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Hunt Dates', '5f-booking' ); ?></h1>
		<p><?php esc_html_e( 'Only dates you open here can be booked on the website. Closing a date hides it from the calendar but keeps its bookings.', '5f-booking' ); ?></p>
		<?php if ( $msg ) : ?>
			<div class="notice notice-success is-dismissible"><p><?php echo esc_html( $msg ); ?></p></div>
		<?php endif; ?>
		<nav class="nav-tab-wrapper">
			<?php foreach ( $types as $key => $type ) : ?>
				<a class="nav-tab<?php echo $key === $tab ? ' nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( 'edit.php?post_type=fivef_booking&page=fivef-bk-dates&tab=' . $key ) ); ?>"><?php echo esc_html( $type['label'] . ( $type['enabled'] ? '' : ' ' . __( '(not bookable online yet)', '5f-booking' ) ) ); ?></a>
			<?php endforeach; ?>
		</nav>

		<h2><?php esc_html_e( 'Open new dates', '5f-booking' ); ?></h2>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'fivef_bk_dates' ); ?>
			<input type="hidden" name="action" value="fivef_bk_dates">
			<input type="hidden" name="type" value="<?php echo esc_attr( $tab ); ?>">
			<input type="hidden" name="do" value="add">
			<p>
				<label><?php echo 'weekend' === $t['unit'] ? esc_html__( 'First day of the weekend', '5f-booking' ) : esc_html__( 'Hunt date', '5f-booking' ); ?>
					<input type="date" name="from" required min="<?php echo esc_attr( $today ); ?>"></label>
				&nbsp;
				<label><?php esc_html_e( 'Repeat weekly until (optional)', '5f-booking' ); ?>
					<input type="date" name="until" min="<?php echo esc_attr( $today ); ?>"></label>
				<button class="button button-primary"><?php esc_html_e( 'Open date(s)', '5f-booking' ); ?></button>
			</p>
			<p class="description">
				<?php
				echo 'spots' === $t['mode']
					/* translators: %d: hunters per date */
					? esc_html( sprintf( __( 'Each date takes up to %d hunters, booked individually or as a group.', '5f-booking' ), $t['capacity'] ) )
					/* translators: 1: min, 2: max */
					: esc_html( sprintf( __( 'Each date is one private group of %1$d to %2$d hunters.', '5f-booking' ), $t['min'], $t['max'] ) );
				?>
			</p>
		</form>

		<h2><?php esc_html_e( 'Upcoming dates', '5f-booking' ); ?></h2>
		<table class="widefat striped">
			<thead><tr>
				<th><?php esc_html_e( 'Date', '5f-booking' ); ?></th>
				<th><?php esc_html_e( 'On the website', '5f-booking' ); ?></th>
				<th><?php esc_html_e( 'Booked', '5f-booking' ); ?></th>
				<th><?php esc_html_e( 'Left', '5f-booking' ); ?></th>
				<th></th>
			</tr></thead>
			<tbody>
			<?php
			$rows = 0;
			foreach ( fivef_bk_dates( $tab ) as $date => $open ) :
				if ( $date < $today ) {
					continue;
				}
				$rows++;
				$active = fivef_bk_active_bookings( $tab, $date );
				$left   = fivef_bk_left( $tab, $date );
				?>
				<tr>
					<td><strong><?php echo esc_html( fivef_bk_date_label( $tab, $date ) ); ?></strong></td>
					<td><?php echo $open ? '<span style="color:#2e7d32">' . esc_html__( 'Open', '5f-booking' ) . '</span>' : esc_html__( 'Closed', '5f-booking' ); ?></td>
					<td>
						<?php
						if ( ! $active ) {
							echo '—';
						}
						foreach ( $active as $p ) {
							$b = fivef_bk_get( $p->ID );
							echo '<a href="' . esc_url( get_edit_post_link( $p->ID ) ) . '">' . esc_html( $b['name'] . ' (' . $b['people'] . ')' ) . '</a> <small>' . esc_html( fivef_bk_statuses()[ $b['status'] ] ) . '</small><br>';
						}
						?>
					</td>
					<td><?php echo esc_html( 'group' === $t['mode'] ? ( $left ? __( 'Available', '5f-booking' ) : __( 'Booked', '5f-booking' ) ) : $left ); ?></td>
					<td style="text-align:right">
						<?php
						if ( $open ) {
							$form( 'close', $date, __( 'Close', '5f-booking' ) );
						} else {
							$form( 'open', $date, __( 'Open', '5f-booking' ) );
						}
						if ( ! $active ) {
							$form( 'remove', $date, __( 'Remove', '5f-booking' ), 'button-link-delete button-link' );
						}
						?>
					</td>
				</tr>
			<?php endforeach; ?>
			<?php if ( ! $rows ) : ?>
				<tr><td colspan="5"><?php esc_html_e( 'No upcoming dates yet. Open some above.', '5f-booking' ); ?></td></tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php
}

/*
 * Bookings list and booking screen.
 */

add_filter(
	'manage_fivef_booking_posts_columns',
	static function () {
		return array(
			'cb'           => '<input type="checkbox" />',
			'title'        => __( 'Booking', '5f-booking' ),
			'fivef_hunt'   => __( 'Hunt date', '5f-booking' ),
			'fivef_people' => __( 'Hunters', '5f-booking' ),
			'fivef_guest'  => __( 'Contact', '5f-booking' ),
			'fivef_money'  => __( 'Deposit / total', '5f-booking' ),
			'fivef_status' => __( 'Status', '5f-booking' ),
			'date'         => __( 'Booked on', '5f-booking' ),
		);
	}
);

add_action(
	'manage_fivef_booking_posts_custom_column',
	static function ( $col, $id ) {
		$b = fivef_bk_get( $id );
		switch ( $col ) {
			case 'fivef_hunt':
				echo esc_html( fivef_bk_date_label( $b['type'], $b['date'] ) );
				break;
			case 'fivef_people':
				echo (int) $b['people'];
				break;
			case 'fivef_guest':
				echo esc_html( $b['email'] ) . '<br>' . esc_html( $b['phone'] );
				break;
			case 'fivef_money':
				echo esc_html( fivef_bk_money( $b['deposit'] ) . ' / ' . fivef_bk_money( $b['total'] ) );
				break;
			case 'fivef_status':
				$s = fivef_bk_statuses();
				echo esc_html( isset( $s[ $b['status'] ] ) ? $s[ $b['status'] ] : $b['status'] );
				break;
		}
	},
	10,
	2
);

add_action(
	'add_meta_boxes_fivef_booking',
	static function () {
		add_meta_box( 'fivef_bk_details', __( 'Booking details', '5f-booking' ), 'fivef_bk_details_box', 'fivef_booking', 'normal', 'high' );
	}
);

/**
 * Booking details and status.
 *
 * @param WP_Post $post Booking.
 */
function fivef_bk_details_box( $post ) {
	$b = fivef_bk_get( $post->ID );
	$t = fivef_bk_type( $b['type'] );
	wp_nonce_field( 'fivef_bk_status', 'fivef_bk_status_nonce' );
	$rows = array(
		__( 'Hunt', '5f-booking' )      => $t ? $t['label'] : $b['type'],
		__( 'Date', '5f-booking' )      => fivef_bk_date_label( $b['type'], $b['date'] ),
		__( 'Hunters', '5f-booking' )   => $b['people'],
		__( 'Add-on', '5f-booking' )    => ( $b['addon'] && $t && ! empty( $t['addon'] ) ) ? $t['addon']['short'] : '—',
		__( 'Name', '5f-booking' )      => $b['name'],
		__( 'Email', '5f-booking' )     => $b['email'],
		__( 'Phone', '5f-booking' )     => $b['phone'],
		__( 'Notes', '5f-booking' )     => $b['notes'],
		__( 'Total', '5f-booking' )     => fivef_bk_money( $b['total'] ),
		__( 'Deposit', '5f-booking' )   => fivef_bk_money( $b['deposit'] ),
		__( 'Balance', '5f-booking' )   => fivef_bk_money( $b['balance'] ),
		__( 'Stripe', '5f-booking' )    => $b['session'] ? $b['session'] : '—',
	);
	echo '<table class="form-table"><tbody>';
	foreach ( $rows as $k => $v ) {
		echo '<tr><th>' . esc_html( $k ) . '</th><td>' . nl2br( esc_html( (string) $v ) ) . '</td></tr>';
	}
	echo '<tr><th><label for="fivef_bk_status">' . esc_html__( 'Status', '5f-booking' ) . '</label></th><td><select id="fivef_bk_status" name="fivef_bk_status">';
	foreach ( fivef_bk_statuses() as $k => $label ) {
		echo '<option value="' . esc_attr( $k ) . '"' . selected( $b['status'], $k, false ) . '>' . esc_html( $label ) . '</option>';
	}
	echo '</select><p class="description">' . esc_html__( 'Cancelled and expired bookings free their spots. Refunds are handled in your Stripe dashboard.', '5f-booking' ) . '</p></td></tr>';
	$log = (array) get_post_meta( $post->ID, '_fivef_log', true );
	echo '<tr><th>' . esc_html__( 'History', '5f-booking' ) . '</th><td><small>' . implode( '<br>', array_map( 'esc_html', array_filter( $log ) ) ) . '</small></td></tr>';
	echo '</tbody></table>';
}

add_action(
	'save_post_fivef_booking',
	static function ( $id ) {
		if ( ! isset( $_POST['fivef_bk_status_nonce'], $_POST['fivef_bk_status'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['fivef_bk_status_nonce'] ) ), 'fivef_bk_status' ) ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $id ) ) {
			return;
		}
		$status = sanitize_key( wp_unslash( $_POST['fivef_bk_status'] ) );
		if ( isset( fivef_bk_statuses()[ $status ] ) && get_post_meta( $id, '_fivef_status', true ) !== $status ) {
			fivef_bk_set_status( $id, $status, 'changed by ' . wp_get_current_user()->user_login );
		}
	}
);

/*
 * Settings.
 */

add_action(
	'admin_init',
	static function () {
		foreach ( array( 'fivef_bk_stripe_secret', 'fivef_bk_stripe_webhook', 'fivef_bk_notify_email' ) as $opt ) {
			register_setting( 'fivef_bk', $opt, array( 'sanitize_callback' => 'sanitize_text_field' ) );
		}
		register_setting( 'fivef_bk', 'fivef_bk_duck_enabled', array( 'sanitize_callback' => 'absint' ) );
		register_setting( 'fivef_bk', 'fivef_bk_duck_deposit_pct', array( 'sanitize_callback' => 'absint' ) );
	}
);

/**
 * Settings screen.
 */
function fivef_bk_settings_screen() {
	$key = fivef_bk_stripe_key();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Booking Settings', '5f-booking' ); ?></h1>
		<form method="post" action="options.php">
			<?php settings_fields( 'fivef_bk' ); ?>
			<h2><?php esc_html_e( 'Online deposits (Stripe)', '5f-booking' ); ?></h2>
			<p>
				<?php
				if ( ! $key ) {
					esc_html_e( 'Not set up: bookings are taken as requests and no payment is collected online.', '5f-booking' );
				} elseif ( fivef_bk_stripe_test_mode() ) {
					esc_html_e( 'TEST MODE: payments use Stripe test cards and no real money moves.', '5f-booking' );
				} else {
					esc_html_e( 'LIVE: deposits are charged to guests’ cards.', '5f-booking' );
				}
				?>
			</p>
			<table class="form-table">
				<tr>
					<th><label for="fivef_bk_stripe_secret"><?php esc_html_e( 'Stripe secret key', '5f-booking' ); ?></label></th>
					<td><input type="password" class="regular-text" id="fivef_bk_stripe_secret" name="fivef_bk_stripe_secret" value="<?php echo esc_attr( get_option( 'fivef_bk_stripe_secret', '' ) ); ?>" autocomplete="off">
					<p class="description"><?php esc_html_e( 'Stripe Dashboard → Developers → API keys. Starts with sk_test_ (testing) or sk_live_. A restricted key (rk_) with Checkout Sessions write access also works.', '5f-booking' ); ?></p></td>
				</tr>
				<tr>
					<th><label for="fivef_bk_stripe_webhook"><?php esc_html_e( 'Webhook signing secret', '5f-booking' ); ?></label></th>
					<td><input type="password" class="regular-text" id="fivef_bk_stripe_webhook" name="fivef_bk_stripe_webhook" value="<?php echo esc_attr( get_option( 'fivef_bk_stripe_webhook', '' ) ); ?>" autocomplete="off">
					<p class="description">
						<?php esc_html_e( 'Stripe Dashboard → Developers → Webhooks → Add endpoint with this URL, and the events checkout.session.completed, checkout.session.async_payment_succeeded and checkout.session.expired. Then paste the signing secret (whsec_...) here.', '5f-booking' ); ?><br>
						<code><?php echo esc_html( rest_url( 'fivef/v1/stripe-webhook' ) ); ?></code>
					</p></td>
				</tr>
				<tr>
					<th><label for="fivef_bk_notify_email"><?php esc_html_e( 'Send booking emails to', '5f-booking' ); ?></label></th>
					<td><input type="email" class="regular-text" id="fivef_bk_notify_email" name="fivef_bk_notify_email" value="<?php echo esc_attr( get_option( 'fivef_bk_notify_email', '' ) ); ?>" placeholder="<?php echo esc_attr( fivef_bk_ranch_email() ); ?>">
					<p class="description"><?php esc_html_e( 'Leave empty to use the contact form address.', '5f-booking' ); ?></p></td>
				</tr>
			</table>
			<h2><?php esc_html_e( 'Duck hunts', '5f-booking' ); ?></h2>
			<table class="form-table">
				<tr>
					<th><?php esc_html_e( 'Bookable online', '5f-booking' ); ?></th>
					<td><label><input type="checkbox" name="fivef_bk_duck_enabled" value="1" <?php checked( (int) get_option( 'fivef_bk_duck_enabled', 0 ), 1 ); ?>> <?php esc_html_e( 'Show duck hunts on the booking calendar', '5f-booking' ); ?></label></td>
				</tr>
				<tr>
					<th><label for="fivef_bk_duck_deposit_pct"><?php esc_html_e( 'Deposit (% of the total)', '5f-booking' ); ?></label></th>
					<td><input type="number" min="0" max="100" step="1" id="fivef_bk_duck_deposit_pct" name="fivef_bk_duck_deposit_pct" value="<?php echo esc_attr( (int) get_option( 'fivef_bk_duck_deposit_pct', 50 ) ); ?>">
					<p class="description"><?php esc_html_e( 'Duck hunts are $300 per person on weekdays and $350 on Saturdays and Sundays. 50 takes half up front; 100 takes full payment online.', '5f-booking' ); ?></p></td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
