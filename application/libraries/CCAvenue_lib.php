<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Code Igniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Rick Ellis
 * @copyright	Copyright (c) 2006, pMachine, Inc.
 * @license		http://www.codeignitor.com/user_guide/license.html
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
 
 // ------------------------------------------------------------------------
 
/**
 * CCAvenue_Lib Controller Class (CCAvenue Class)
 *
 * This CI library is based on the CCAvenue PHP Integration Kit by CCAvenue
 * See www.ccavenue.com for the most recent version of this class
 * along with any applicable sample files and other documentaion.
 *
 * This file provides a neat and simple method to interface with CCAvenue 
 * This file is NOT intended to make the ccavenue integration "plug 'n' play". 
 * It still requires the developer (that should be you) to understand the 
 * ccavenue process and know the variables you want/need to pass to ccavenue 
 * to achieve what you want. 
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Commerce
 * @author      Sanskruti Technologies <info@sanskruti.net>
 * @copyright   Copyright (c) 2017, http://sanskruti.net/products/ccavenue-codeigniter-integration/copyright/
 * https://github.com/codexworld/paypal-library-for-codeigniter
 */

// ------------------------------------------------------------------------
class ccavenue_lib {
	
	var $fields = array();		// array holds the fields to submit to ccavenue
	
	function ccavenue_lib()
	{
		$merchant_id = $this->CI->config->item('ccavenue_merchant_id');
		$this->add_field('merchant_id',$merchant_id);
				
		$currency = $this->CI->config->item('ccavenue_currency');
		$this->add_field('currency',$currency);
		
		$redirect_url = $this->CI->config->item('ccavenue_redirect_url');
		$this->add_field('redirect_url',$redirect_url);
		$this->add_field('cancel_url',$redirect_url);
		$this->add_field('language','EN');
		
			
	}
	function add_field($field, $value) 
	{
		// adds a key=>value pair to the fields array, which is what will be 
		// sent to paypal as POST variables.  If the value is already in the 
		// array, it will be overwritten.
		$this->fields[$field] = $value;
	}
}
?>