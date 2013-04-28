<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
include('media/com_mymart3/includes/AlliancePortalClientProxy.class.php');
 
/**
 * OnlineLearning Model
 */
class myMART3ModelOnlineLearning extends JModelItem
{

	/**
	 * Get the URL for YesTeachMe SSO 
	 * @return string The message to be displayed to the user
	 */
	public function getURL() 
	{
		$session = JFactory::getSession();
		$id = $session->get('mymart3UserID');
		$ytmToken = $session->get('yesteachmeToken');
		$ytmTokenCreation = $session->get('yesteachmeTokenCreation');
		$renewToken = false;
		
		//Check to see if user has myMART3ID
		if (empty($id)) {
			return false;
		}
		
		if (empty($ytmTokenCreation)) {
			$renewToken = true;
		}
		else
		{
		  //Get Current DateTime
		  $currentDateTime = new DateTime();
		  $tokenExpiry = clone $ytmTokenCreation;
		  
		  //Check we haven't exceeded expiry
		  date_add($tokenExpiry, new DateInterval('PT4M'));
		  if ($currentDateTime > $tokenExpiry) {
		    $renewToken = true;
		  }
		}
		
		if ($renewToken)
		{
			$token = $this->getToken($id);
			$ytmToken = $token;
			$ytmTokenCreation = new DateTime();
		}
		
		return $ytmToken;
	}
	
	function getToken($id)
	{
		$proxy = new AlliancePortalClientProxy();
		$obj->ID = $id;
		$tokenResponse = $proxy->GetYTMAccess($obj);
		unset($proxy);
		return $tokenResponse->GetYTMAccessResult->YTMURL;
	}
}