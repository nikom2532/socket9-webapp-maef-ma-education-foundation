<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

if ($this->url)
{
	JApplication::redirect($this->url);
} 
else
{
	?>
	You are currently unauthenticated please try logging in again or contact the site administrator if the problem persists.
	<?php
}
?>