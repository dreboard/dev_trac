<?php
namespace App\Helpers;


class SiteHelper {

	/**
	 * Format and set start date
	 *
	 * @param string $date
	 * @return string
	 */
	static function formatStartDate( $date ) {
		if ( empty( $date ) || is_null( $date ) ) {
			return date( 'Y-m-d' );
		}
		return date( "Y-m-d", strtotime( $date ) );

	}

	/**
	 * Format, set and adjust end date
	 *
	 * @param string $start
	 * @param string $end
	 * @return string
	 */
	static function formatEndDate( $start, $end ) {
		if ( empty( $end ) || is_null( $end ) ) {
			return date( 'Y-m-d', strtotime( $start . ' + 30 days' ) );
		}
		return date('Y-m-d', strtotime("+30 days"));


	}
}
