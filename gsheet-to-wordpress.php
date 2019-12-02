<?php
/*
 * Google Sheet Data to Wordpress
 * Author: Nevskie
 * Description: Wordpress short Code to get cell data form Google Sheet
 * Usage: It is use for total entries that you need to post in your site like Number of Partners of your company
 */

function sheetValueFunc($atts) {
    $API = 'API_Key';
    $google_spreadsheet_ID = 'Google Sheet Id';
    $api_key = esc_attr( $API); // wordpress function to escape the html attributes

    $location = $atts['location']; //parameter to get the position  of data in the sheet

    $get_cell = new WP_Http(); //worpress function 
    $cell_url = "https://sheets.googleapis.com/v4/spreadsheets/$google_spreadsheet_ID/values/$location?&key=$api_key";	 // sheet url with api key for permission and location of value
    $cell_response = $get_cell -> get( $cell_url);  //make a request and transport
    $json_body = json_decode($cell_response['body'],true); //decode json to php variable
    $cell_value = $json_body['values'][0][0]; 
    return $cell_value; // return the value from google sheet
}
add_shortcode('gsvalue', 'sheetValueFunc');

?>
