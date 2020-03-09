<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    BRBTR_Radio
 * @subpackage BRBTR_Radio/includes
 * @author     DarkAngel
 */
class BRBTR_Radio_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        global $wpdb, $table_prefix;

        $charset_collate = $wpdb->get_charset_collate();

        $create_table_query = "CREATE TABLE IF NOT EXISTS " . $table_prefix . BRBTR_TABLE_NAME . " (
            `id` MEDIUMINT(9) NOT NULL AUTO_INCREMENT ,
            `changeuuid` VARCHAR(36) NULL,
            `stationuuid` VARCHAR(36) NULL,
            `name` VARCHAR(256) NULL,
            `url` VARCHAR(2083) NULL,
            `url_resolved` VARCHAR(2083) NULL,
            `homepage` VARCHAR(2083) NULL,
            `favicon` VARCHAR(2083) NULL,
            `tags` TEXT NULL,
            `country` VARCHAR(128) NULL,
            `countrycode` VARCHAR(3) NULL,
            `state` VARCHAR(128) NULL,
            `language` VARCHAR(64) NULL,
            `votes` INT NULL,
            `lastchangetime` DATETIME NULL,
            `codec` VARCHAR(10) NULL,
            `bitrate` INT NULL,
            `hls` INT NULL,
            `lastcheckok` INT NULL,
            `lastchecktime` DATETIME NULL,
            `lastcheckoktime` DATETIME NULL,
            `lastlocalchecktime` DATETIME NULL,
            `clicktimestamp` DATETIME NULL,
            `clickcount` INT NULL,
            `clicktrend` INT NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $res = dbDelta( $create_table_query );
        // echo "= " . $res;
        if ($res) {
            add_action( 'admin_notices', function(){
                echo "<div class='notice notice-success is-dismissible'><p>DB created</p></div>";
            } );
        } else {
            add_action( 'admin_notices', function(){
                echo "<div class='notice notice-error is-dismissible'><p>DB NOT created</p></div>";
            } );
        }
	}

}
