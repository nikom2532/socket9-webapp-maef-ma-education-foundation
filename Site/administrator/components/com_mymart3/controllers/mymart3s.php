<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');
include('../media/com_mymart3/includes/AlliancePortalClientProxy.class.php');
/**
 * myMART3ControllermyMART3s Controller
 */
class myMART3ControllermyMART3s extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * @since	2.5
	 */
	public function getModel($name = 'myMART3s', $prefix = 'myMART3Model') 
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
	
  public function refresh()
  {
  	$models = $this->getModel();
  	$count = 0;
  	$items = $models->getItems();
  	$proxy = new AlliancePortalClientProxy();
  	$groupAssignments = $this->GetGroupAssignments();
  	foreach($items as $i => $item):
  	  $mymartUser = $this->myMARTUserCheck($proxy, $item->email);
  	  if (is_null($item->mymart3id)) {
				if (!is_null($mymartUser) && $this->AddUserLink($mymartUser, $item, $groupAssignments)) {
					$count++;
				}
		  } else {
		    if (!is_null($mymartUser)) {
		      //User is already linked - Check groups
		      if($this->AddUserToGroups($mymartUser, $item, $groupAssignments)) {
		      	$count++;
		      }
		    }
			}
  	endforeach;
  	unset($proxy);
  	
  	$controller = JApplication::redirect(JURI::base() . 'index.php?option=com_mymart3&updatecount='.$count);
  }
  
  function myMARTUserCheck($proxy, $email)
	{
		$obj->email = $email;
		$returnedObj = $proxy->CheckUserStatus($obj);
		return $returnedObj;
	}
	
	function AddUserLink($mymartUser, $item, $groupAssignments)
	{
		$results = $mymartUser->CheckUserStatusResult;
		if (!is_null($results) && $results->UserExists) {
			$newItem = array();
			$newItem['userid'] = $item->joomlaid;
			$newItem['mymart3id'] = $results->ID;
			if ($results->HasYTMAccess) {
			  $newItem['onlinelearningenabled'] = 1;
			} else {
			  $newItem['onlinelearningenabled'] = 0;
		  }
		  $newModel = $this->getModel('myMART3');
		  $newModel->save($newItem);
		  $this->AddUserToGroups($mymartUser, $item, $groupAssignments);
		  return true;
		}
		return false;
	}
	
	function GetGroupAssignments()
	{
		$db	= JFactory::getDbo();
		$userquery	= $db->getQuery(true);
		$userquery->select('groupid, onlinelearning');
		$userquery->from('#__mymart3groups');
		$db->setQuery($userquery);
		$userresult = $db->loadObjectList();
		return $userresult;
	}
	
	function AddUserToGroups($mymartUser, $item, $groupAssignments)
	{
		$results = $mymartUser->CheckUserStatusResult;
		if (!is_null($results) && $results->UserExists) {
			$dirty = false;
			$user = JUser::getInstance($item->joomlaid);
			foreach($groupAssignments as $i => $group):
			  if (!$user->groups[$group->groupid]) {
			    if ($group->onlinelearning) {
			    	if ($results->HasYTMAccess) {
			    	  $user->groups[$group->groupid] = $group->groupid;
			    	  $dirty = true;
			      }
			    } else {
			  	  $user->groups[$group->groupid] = $group->groupid;
			  	  $dirty = true;
			  	}
				}
			endforeach;
			if ($dirty) {
				return $user->save();
			}
	  }
		return false;
		//JUser Object ( [isRoot:protected] => [id] => 42 [name] => Super User [username] => admin [email] => paul@fairpoint.com.au [password] => 35114ef6f85fd72d8fa8276ee17a44c6:SDS1tZsi3u0XPaLWq0DSeMJlnRdG8OYd [password_clear] => [usertype] => deprecated [block] => 0 [sendEmail] => 1 [registerDate] => 2012-03-16 01:18:37 [lastvisitDate] => 2012-03-27 01:52:52 [activation] => 0 [params] => {"admin_style":"","admin_language":"","language":"","editor":"","helpsite":"","timezone":""} [groups] => Array ( [8] => 8 [13] => 13 [14] => 14 ) [guest] => [_params:protected] => JRegistry Object ( [data:protected] => stdClass Object ( [admin_style] => [admin_language] => [language] => [editor] => [helpsite] => [timezone] => ) ) [_authGroups:protected] => [_authLevels:protected] => [_authActions:protected] => [_errorMsg:protected] => [_errors:protected] => Array ( ) ) stdClass Object ( [groupid] => 14 [onlinelearning] => 1 )
	}
}
