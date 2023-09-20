<?php
/**
 * UserSubscriptionUpdated.
 * php version 5.6
 *
 * @category UserSubscriptionUpdated
 * @package  SureTriggers
 * @author   BSF <username@example.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link     https://www.brainstormforce.com/
 * @since    1.0.0
 */

namespace SureTriggers\Integrations\WoocommerceSubscriptions\Triggers;

use SureTriggers\Controllers\AutomationController;
use SureTriggers\Traits\SingletonLoader;
use WC_Subscription;
use SureTriggers\Integrations\WordPress\WordPress;

if ( ! class_exists( 'UserSubscriptionUpdated' ) ) :

	/**
	 * UserSubscriptionUpdated
	 *
	 * @category UserSubscriptionUpdated
	 * @package  SureTriggers
	 * @author   BSF <username@example.com>
	 * @license  https://www.gnu.org/licenses/gpl-3.0.html GPLv3
	 * @link     https://www.brainstormforce.com/
	 * @since    1.0.0
	 *
	 * @psalm-suppress UndefinedTrait
	 */
	class UserSubscriptionUpdated {

		/**
		 * Integration type.
		 *
		 * @var string
		 */
		public $integration = 'WoocommerceSubscriptions';

		/**
		 * Trigger name.
		 *
		 * @var string
		 */
		public $trigger = 'wc_subscription_updated';

		use SingletonLoader;

		/**
		 * Constructor
		 *
		 * @since  1.0.0
		 */
		public function __construct() {
			add_filter( 'sure_trigger_register_trigger', [ $this, 'register' ] );
		}

		/**
		 * Register action.
		 *
		 * @param array $triggers trigger data.
		 * @return array
		 */
		public function register( $triggers ) {
			$triggers[ $this->integration ][ $this->trigger ] = [
				'label'         => __( 'User Subscription Updated', 'suretriggers' ),
				'action'        => $this->trigger,
				'common_action' => 'woocommerce_subscription_status_updated',
				'function'      => [ $this, 'trigger_listener' ],
				'priority'      => 30,
				'accepted_args' => 3,
			];

			return $triggers;
		}

		/**
		 *  Trigger listener
		 *
		 * @param object $subscription Subscription.
		 * @param string $new_status New Status.
		 * @param string $old_status Old status.
		 *
		 * @return void
		 */
		public function trigger_listener( $subscription, $new_status, $old_status ) {

			if ( ! class_exists( '\WC_Subscription' ) ) {
				return;
			}
			if ( ! $subscription instanceof \WC_Subscription ) {
				return;
			}

			$items       = $subscription->get_items();
			$product_ids = [];
			foreach ( $items as $item ) {
				$product = $item->get_product();
				if ( class_exists( '\WC_Subscriptions_Product' ) && \WC_Subscriptions_Product::is_subscription( $product ) ) {
					$product_ids[] = $item->get_product_id();
				}
			}

			$subscription_status            = $subscription->get_status();
			$subscription_start_date        = $subscription->get_date_created();
			$subscription_next_payment_date = $subscription->get_date( 'next_payment' );
			
			$context['subscription_data'] = [
				'start_date'        => $subscription_start_date,
				'next_payment_date' => $subscription_next_payment_date,
			];
			$context['user']              = WordPress::get_user_context( $subscription->get_user_id() );

			foreach ( $product_ids as $val ) {
				$context['subscription']      = $val;
				$context['new_status']        = $subscription_status;
				$context['old_status']        = $old_status;
				$context['status']            = 'wc-' . $subscription_status;
				$context['subscription_name'] = get_the_title( $val );
			}

			AutomationController::sure_trigger_handle_trigger(
				[
					'trigger' => $this->trigger,
					'context' => $context,
				]
			);
		}
	}

	/**
	 * Ignore false positive
	 *
	 * @psalm-suppress UndefinedMethod
	 */
	UserSubscriptionUpdated::get_instance();

endif;