<?php

// No direct access
defined('_JEXEC') or die;
include("AlliancePortalClientProxy.class.php");
/**
 * myMART3 Authentication Plugin
 *
 */
class plgAuthenticationMYMART3 extends JPlugin {
	/**
	 * This method should handle any authentication and report back to the subject
	 *
	 * @access	public
	 * @param   array	$credentials Array holding the user credentials
	 * @param	array   $options	Array of extra options
	 * @param	object	$response	Authentication response object
	 * @return	boolean
	 * @since 2.5
	 */
	function onUserAuthenticate($credentials, $options, & $response) {
		
		//Create Authentication Client Proxy
		$proxy = new AlliancePortalClientProxy();
		$obj->UserName = $credentials['username'];
		$obj->Password = $credentials['password'];
		$mm3response = $proxy->Authenticate($obj);
		
		if (isset($mm3response) && !empty($mm3response))
		{
			$loginResult = $mm3response->AuthenticateResult;
			if ($loginResult->Authenticated)
			{		  
			  $result = $this->CheckLink($loginResult->ID);
			  
			  if (!empty($result->id)) {
			  	//user found - update resonse with joomla user credentials
			  	$user = JUser::getInstance($result->id);
			  	$response->username = $result->username;
			    $response->fullname = $result->name;
			    $response->email	= $result->email;
			    
					$response->status		= JAuthentication::STATUS_SUCCESS;
			  	$response->error_message = '';
			  	$response->type = 'myMART3';
			  	$this->CheckUserGroupAssignments($result->OnlineLearning, $result->id);
			  	unset($proxy);
			  	return true;
			  } 

			  //search for user before creation
			  $userresult = $this->FindUserByEmail($loginResult->Email);
			  if (!$userresult) {
				  //create user & link
				  $user = $this->CreateUser($credentials, $loginResult);
				  if ($user->save()) {
				  	//successfull saved
				  	//find user by username so we can link to MM3
				  	$userresult = $this->FindUser($credentials['username']);
				  } else {
				  	unset($proxy);
				  	$response->error_message	= JText::sprintf('JGLOBAL_AUTH_FAILED', '1myMART user found but something went wrong in the process of creating your MA user credentials.');
				  	$response->status		= JAuthentication::STATUS_FAILURE;
				  	return false;
				  }
				}
				
				if ($userresult) {
					//update resonse with joomla user credentials
			  	$user = JUser::getInstance($userresult->id);
			  	$response->username = $userresult->username;
			  	$response->fullname = $userresult->name;
			  	$response->email	= $userresult->email;
			  	
					$this->CreateLink($user->id, $loginResult);
					$this->CheckUserGroupAssignments($loginResult->OnlineLearning, $userresult->id);
					unset($proxy);
			  	$response->status		= JAuthentication::STATUS_SUCCESS;
			  	$response->type = 'myMART3';
			  	$response->error_message = '';
					return true;
				}
			  
			  unset($proxy);
			  $response->error_message	= JText::sprintf('JGLOBAL_AUTH_FAILED', '2myMART user found but something went wrong in the process of creating your MA user credentials.');
			  $response->status		= JAuthentication::STATUS_FAILURE;
			  return false;
			}
		}
		unset($proxy);
		
	  $response->status		= JAuthentication::STATUS_FAILURE;
	  $response->error_message	= JText::sprintf('JGLOBAL_AUTH_FAILED', $message);
	}
	
	/**
	 * This method fires on successful logins
	 *
	 * @access	public
	 * @param   array	$user Array holding the user authentication details
	 * @param	array   $options	Array of extra options
	 * @return	boolean
	 * @since 2.5
	 */
	function onUserLogin($user, $options)
	{
		//Retrieve user with mm3 link if it exists
		$mmLink = $this->GetUserWithLink($user['username']);
		if ($mmLink && !empty($mmLink->mymart3id))
		{
			//Link Exists!
			//Generate SSO Token
			$tokenResult = $this->GetSSOToken($mmLink->mymart3id);
			$token = $tokenResult->Token;
			$onlineLearning = $tokenResult->OnlineLearning;
			if (!empty($token)) {
				//Store SSO Token in Session
				$this->SetToken($token, $mmLink->mymart3id);
				$this->CheckUserGroupAssignments($onlineLearning, $mmLink->id);
			}
			return true;
		}
		
		//link doesn't exist check mm3 for user to link
		$mymartUser = $this->myMARTUserCheck($user['email']);
		if ($mymartUser) {
			$results = $mymartUser->CheckUserStatusResult;
			if ($results && $results->UserExists) {
				//User Exists!
				//Lets create the link
				$loginResult->OnlineLearning = $results->HasYTMAccess;
				$loginResult->ID = $results->ID;
				$this->CreateLink($mmLink->id, $loginResult);
				
				//Generate SSO Token
				$tokenResult = $this->GetSSOToken($results->ID);
				$token = $tokenResult->Token;
				$onlineLearning = $tokenResult->OnlineLearning;
				if (!empty($token)) {
					//Store SSO Token in Session
					$this->SetToken($token, $results->ID);
					$this->CheckUserGroupAssignments($onlineLearning, $mmLink->id);
				}
			}
		}
		return true;
	}
	
	/**
	 * This method asks myMART3 to find a user that matches a specified email address
	 *
	 * @access	Private
	 * @param   string	$email to use to locate user
	 * @return	object
	 */
	function myMARTUserCheck($email)
	{
		$proxy = new AlliancePortalClientProxy();
		$obj->email = $email;
		$returnedObj = $proxy->CheckUserStatus($obj);
		unset($proxy);
		return $returnedObj;
	}
	
	/**
	 * This method stores a myMART3 token along with a creation date in the users session
	 *
	 * @access	Private
	 * @param   string	$token store
	 * @param   string	$membershipID myMART3 Membership ID
	 * @return	NULL
	 */
	function SetToken($token, $membershipID)
	{
		$session = JFactory::getSession();
		$session->set('mymart3Token', $token);
		$session->set('mymart3UserID', $membershipID);
		$session->set('mymart3TokenCreation', new DateTime());
	}
	
	/**
	 * This method asks myMART3 to retrieve a SSO token for a specified user using their membership ID
	 *
	 * @access	Private
	 * @param   string	$ID myMART3 Membership ID
	 * @return	string Token
	 */	
	function GetSSOToken($ID)
	{
		$proxy = new AlliancePortalClientProxy();
		$obj->ID = $ID;
		$tokenResponse = $proxy->RenewToken($obj);
		unset($proxy);
		return $tokenResponse->RenewTokenResult;
	}
	
	/**
	 * This method retrieves a userID and a myMART3 membership ID (if link exists) using the users username
	 *
	 * @access	Private
	 * @param   string	$Username Users Joomla Username
	 * @return	object Query Results
	 */	
	function GetUserWithLink($Username)
	{
		//Lets check to see if this user already exists in the Joomla DB
		//Get a database object
		$db	= JFactory::getDbo();
		$query	= $db->getQuery(true);
    
		$query->select('u.id, m.mymart3id');
		$query->from('#__users as u');
		$query->leftJoin('#__mymart3users as m on u.id = m.userid');
		$query->where('username=' . $db->Quote($Username));
    
		$db->setQuery($query);
		$result = $db->loadObject();
		return $result;
	}
	
	/**
	 * This method trys to retrieve Joomla user details based off a myMART3 membership ID (if link exists) 
	 *
	 * @access	Private
	 * @param   string	$ID myMART3 Membership ID
	 * @return	object Query Results
	 */	
	function CheckLink($ID)
	{
		//Lets check to see if this user already exists in the Joomla DB
		//Get a database object
		$db	= JFactory::getDbo();
		$query	= $db->getQuery(true);
    
		$query->select('u.id, u.username, u.name, u.email');
		$query->from('#__mymart3users as m');
		$query->leftJoin('#__users as u on u.id = m.userid');
		$query->where('mymart3id=' . $db->Quote($ID));
    
		$db->setQuery($query);
		$result = $db->loadObject();
		return $result;
	}
	
	/**
	 * This method trys to retrieve Joomla user details by Joomla username
	 *
	 * @access	Private
	 * @param   string	$username Joomla Username
	 * @return	object Query Results
	 */		
	function FindUser($username)
	{
		$db	= JFactory::getDbo();
		$userquery	= $db->getQuery(true);
		$userquery->select('id, username, name, email');
		$userquery->from('#__users');
		$userquery->where('username =' . $db->Quote($username));
		$db->setQuery($userquery);
		$userresult = $db->loadObject();
		return $userresult;
	}
	
	/**
	 * This method trys to retrieve Joomla user details by Joomla username
	 *
	 * @access	Private
	 * @param   string	$email Email address
	 * @return	object Query Results
	 */		
	function FindUserByEmail($email)
	{
		$db	= JFactory::getDbo();
		$userquery	= $db->getQuery(true);
		$userquery->select('id, username, name, email');
		$userquery->from('#__users');
		$userquery->where('LOWER(email) = LOWER(' . $db->Quote($email) . ')');
		$db->setQuery($userquery);
		$userresult = $db->loadObject();
		return $userresult;
	}
	
	/**
	 * This method creates a Joomla user based of user credentials and myMART3 user details
	 *
	 * @access	Private
	 * @param   arrray	$credentials User Credentials
	 * @param   object	$loginResult myMART3 user details
	 * @return	object  new user object
	 */	
	function CreateUser($credentials, $loginResult)
	{
		//create user & link
		$user = JUser::getInstance();
		$user->name = $loginResult->FullName;
		$user->username = $credentials['username'];
		$user->email = $loginResult->Email;
		
		//crypt password
		$salt = JUserHelper::genRandomPassword(32);
		$crypt = JUserHelper::getCryptedPassword($credentials['password'], $salt);
		$user->password = $crypt.':'.$salt;
		$user->usertype = '';
		$user->block = 0;
		$user->activation = 0;
		$user->registerDate = getdate();
		$user->lastvisitDate = getdate();
		return $user;
	}
	
	/**
	 * This method creates the link between a myMART3 user and a Joomla User
	 *
	 * @access	Private
	 * @param   string	$userID Joomla User ID
	 * @param   object	$loginResult myMART3 user details
	 * @return	NULL
	 */	
	function CreateLink($userID, $loginResult)
	{
		$db	= JFactory::getDbo();
		$newLink->userid = $userID;
		$newLink->mymart3id = $loginResult->ID;
		$newLink->onlinelearningenabled = $loginResult->OnlineLearning;
		$db->insertObject('#__mymart3users', $newLink);
	}
	
	/**
	 * This method retrieves the group assignments
	 *
	 * @access	Private
	 * @return	object	$userresult Group Assignments as array of objects
	 */	
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
	
	/**
	 * This method checks to see if the user has the correct group assignments
	 *
	 * @access	Private
	 * @param   boolean	$onlineLearningEnabled myMART3 user check result 
	 * @param   string	$id Joomla User ID
	 * @param   array(object)	$groupAssignments Array of Group Assignment Objects
	 * @return	boolean
	 */	
	function CheckUserGroupAssignments($onlineLearningEnabled, $id)
	{
		$groupAssignments = $this->GetGroupAssignments();
		$dirty = false;
		$user = JUser::getInstance($id);
		foreach($groupAssignments as $i => $group):
		  if (!$user->groups[$group->groupid]) {
		    if ($group->onlinelearning) {
		    	if ($onlineLearningEnabled) {
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
		return false;
	}
}
