<?php
namespace App\Helpers;

/**
 * Class DateHelper
 *
 * Format and check user input dates
 *
 * DateHelper
 * @package App\Helpers
 */
class DateHelper {

	/**
	 * Format and set start date
	 *
	 * @param string $date
	 * @return string
	 */
	public static function formatStartDate(string $date ):string
	{
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
	public static function formatEndDate(string $start, string $end ):string
	{
		if ( empty( $end ) || is_null( $end ) ) {
			return date( 'Y-m-d', strtotime( $start . ' + 30 days' ) );
		}
		return date('Y-m-d', strtotime("+30 days"));


	}
}
