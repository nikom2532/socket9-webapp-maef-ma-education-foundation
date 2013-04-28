<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
/**
 * 
 * Proxy Class : AlliancePortalClientProxyClass (to interact with SOAP server at http://trial.mymart3.com.au/services/dataservice/AlliancePortal.svc?wsdl)
 * @package AlliancePortalClientProxy
 * @version 1.00
 * 
 */
	
class AlliancePortalClientProxy {
var $client = null;
var $soapUrl = 'https://services.mymart3.com.au/AlliancePortal.svc?wsdl';
var $options = array('trace' 				=> 1,
										 'exceptions'		=> true,
										 'soap_version'	=> SOAP_1_1); 

/**
 * 
 * Class: AlliancePortalClientProxy - Construct Method
 * 
 */

function __construct()
{
$this->client = new SoapClient($this->soapUrl, $this->options);
//Insert Additional Constructor Code
}

/**
 * 
 * Class: AlliancePortalClientProxy - Destruct Method
 * 
 */

function __destruct()
{
unset ($this->client);
//Insert Destructor Code
}



function Authenticate($parameters ){
	try {
		$funcRet = $this->client->Authenticate($parameters );
	} catch ( Exception $e ) {
		echo '(Authenticate) SOAP Error: - ' . $e->getMessage ();
	}
	return $funcRet; 
}



function RenewToken($parameters ){
	try {
		$funcRet = $this->client->RenewToken($parameters );
	} catch ( Exception $e ) {
		echo '(RenewToken) SOAP Error: - ' . $e->getMessage ();
	}
	return $funcRet; 
}



function GetYTMAccess($parameters ){
	try {
		$funcRet = $this->client->GetYTMAccess($parameters );
	} catch ( Exception $e ) {
		echo '(GetYTMAccess) SOAP Error: - ' . $e->getMessage ();
	}
	return $funcRet; 
}



function CheckUserStatus($parameters ){
	try {
		$funcRet = $this->client->CheckUserStatus($parameters );
	} catch ( Exception $e ) {
		echo '(CheckUserStatus) SOAP Error: - ' . $e->getMessage ();
	}
	return $funcRet; 
}


		
}

?>
