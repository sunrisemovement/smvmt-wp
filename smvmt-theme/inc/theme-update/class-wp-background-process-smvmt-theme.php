<?php
/**
 * Database Background Process
 *
 * @package smvmt
 * @since 2.1.3
 */

if ( class_exists( 'WP_Background_Process' ) ) :

	/**
	 * Database Background Process
	 *
	 * @since 2.1.3
	 */
	class WP_Background_Process_SMVMT_Theme extends WP_Background_Process {

		/**
		 * Database Process
		 *
		 * @var string
		 */
		protected $action = 'smvmt_theme_db_migration';

		/**
		 * Task
		 *
		 * Override this method to perform any actions required on each
		 * queue item. Return the modified item for further processing
		 * in the next pass through. Or, return false to remove the
		 * item from the queue.
		 *
		 * @since 2.1.3
		 *
		 * @param object $process Queue item object.
		 * @return mixed
		 */
		protected function task( $process ) {

			do_action( 'SMVMT_batch_process_task_' . $process, $process );

			if ( function_exists( $process ) ) {
				call_user_func( $process );
			}

			if ( 'update_db_version' === $process ) {
				SMVMT_Theme_Background_Updater::update_db_version();
			}

			return false;
		}

		/**
		 * Complete
		 *
		 * Override if applicable, but ensure that the below actions are
		 * performed, or, call parent::complete().
		 *
		 * @since 2.1.3
		 */
		protected function complete() {
			error_log( 'smvmt: Batch Process Completed!' ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log

			do_action( 'SMVMT_database_migration_complete' );
			parent::complete();
		}

	}

endif;
