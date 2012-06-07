<?php

class Reporter_View_Helper_IsLoggedIn
{
	public function IsLoggedIn($baseUrl='')
	{
		$identity = Zend_Auth::getInstance()->getIdentity();
#Zend_Debug::Dump($identity);   
		$output = "<div id=\"logged-in\">";

#Zend_Debug::Dump($identity);

		if($identity)
		{
#			$output .= 'conectado como <b>';
#$output .= "{$identity->firstname} {$identity->lastname}";
			$do = new User_Model_DbTable_User();
			$data = $do->find($identity->id);
			$data = $data[0]->toArray();
			
			$output .= "<div id='user-top'>";
			$output .= "{$identity->username} <br/> {$identity->name}<br/>\n";
			$output .= "</b> <a href=\"{$baseUrl}/Auth/logout\">fazer logoff</a>\n";
			$output .= "</div>\n";
			$output .= "<div id='user-data-top'>";
			$output .= "<ul>\n";
			$output .= "<li id='icons-favs-online'>XX de seus favoritos estão on-line</lo>\n";
			$output .= "<li id='icons-balance'>{$data['credit']} créditos no momento</lo>\n";
			$output .= "<li id='icons-buy'><a href='/User/Credit/buy'>adquira mais créditos</a></li>\n";
			$output .= "</ul>\n";
			$output .= "</div>\n";
		}
		else
		{
			$output .= "<a href=\"{$baseUrl}/Auth/login\">entrar</a>\n";
			$output .= " ou <a href=\"{$baseUrl}/User/register\">cadaste-se</a>\n";
		}
		$output .= "</div>\n";

		return $output;
	}
}

