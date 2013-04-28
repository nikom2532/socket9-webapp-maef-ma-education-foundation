<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
include('media/com_mymart3/includes/AlliancePortalClientProxy.class.php');
 
/**
 * myMART3 Model
 */
class myMART3ModelmyMART3 extends JModelItem
{

	/**
	 * Get the URL for myMART3 SSO 
	 * @return string The message to be displayed to the user
	 */
	public function getURL() 
	{
		$session = JFactory::getSession();
		$token = $session->get('mymart3Token');
		$id = $session->get('mymart3UserID');
		$createDate = $session->get('mymart3TokenCreation');
		
		//Check to see if user has myMART3ID
		if (empty($id)) {
			return false;
		}
		//Get Current DateTime
		$currentDateTime = new DateTime();
		$tokenExpiry = clone $createDate;
		
		//Check we haven't exceeded expiry
		date_add($tokenExpiry, new DateInterval('PT4M'));
		if ($currentDateTime > $tokenExpiry) {
			$newToken = $this->getToken($id);
			if ($newToken) {
				$token = $newToken;
				$createDate = new DateTime();
			} else {
				return false;
			}
		}
		
		$returnString = 'http://schools.mymart3.com.au/?SSOToken='. $token . '&SSOUser=' . $id;
		return $returnString;
	}
	
	function getToken($id)
	{
		$proxy = new AlliancePortalClientProxy();
		$obj->ID = $id;
		$tokenResponse = $proxy->RenewToken($obj);
		unset($proxy);
		return $tokenResponse->RenewTokenResult->Token;
	}
}