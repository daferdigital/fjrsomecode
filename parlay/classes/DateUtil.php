<?php
class DateUtil {
	private static $dateTimeObj = null;
	private static $TIMEZONE = "America/Caracas";  // timezone VZLA
	
	/**
	 * Prepare the initial value to the date formatter object
	 */
	private static function initDateTimeObj(){
		if(DateUtil::$dateTimeObj == null){
			DateUtil::$dateTimeObj = new DateTime(date('Y-m-d H:i:s e'));
			DateUtil::$dateTimeObj->setTimeZone(new DateTimeZone(DateUtil::$TIMEZONE));
		}
	}
	
	/**
	 * Function to get the current date under Venezuelan TimeZone
	 */
	public static function getDateUnderVzlaTZ(){
		DateUtil::initDateTimeObj();
		
		return DateUtil::$dateTimeObj->format('Y-m-d');
	}
	
	/**
	 * Function to get the current date under Venezuelan TimeZone
	 */
	public static function getDateUnderVzlaTZDayMonthYear(){
		DateUtil::initDateTimeObj();
	
		return DateUtil::$dateTimeObj->format('d/m/Y');
	}
	
	/**
	 * Function to get the current time under Venezuelan TimeZone
	 */
	public static function getTimeUnderVzlaTZ(){
		DateUtil::initDateTimeObj();
	
		return DateUtil::$dateTimeObj->format('H:i:s');
	}
}
/*
echo "UnitTest DateUtil.php:<br /><br />";
echo "DateUtil::getTimeUnderVzlaTZ(): ".DateUtil::getTimeUnderVzlaTZ()."<br /><br />";
echo "DateUtil::getDateUnderVzlaTZDayMonthYear(): ".DateUtil::getDateUnderVzlaTZDayMonthYear()."<br /><br />";
echo "DateUtil::getDateUnderVzlaTZ(): ".DateUtil::getDateUnderVzlaTZ()."<br /><br />";
*/
?>