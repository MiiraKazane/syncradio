<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if(!function_exists('see_tipos'))
{
	function see_tipos($t) {

		switch ($t) {
			case 1:
				$res = "Administrador";
				break;
			case 2:
				$res = "Usuario";
				break;
			case 3:
				$res = "Grabador";
				break;
			case 4:
				$res = "Continuista";
				break;
		}
		return $res;
	}
}

if(!function_exists('see_status'))
{
	function see_status($t) {

		switch ($t) {
			case 0:
				$res = '<i class="fa fa-exclamation" aria-hidden="true"></i> Abierto';
				break;
			case 1:
				$res = '<i class="fa fa-spinner" aria-hidden="true"></i> En proceso';
				break;
			case 2:
				$res = '<i class="fa fa-check" aria-hidden="true"></i> Finalizado';
		}
		return $res;
	}
}

if(!function_exists('color_status'))
{
	function color_status($t) {

		switch ($t) {
			case 0:
				$res = 'danger';
				break;
			case 1:
				$res = 'warning';
				break;
			case 2:
				$res = 'success';
		}
		return $res;
	}
}

if(!function_exists('see_tipo_reporte'))
{
	function see_tipo_reporte($t) {

		switch ($t) {
			case 1:
				$res = '<span class="glyphicon glyphicon-chevron-right" style="color:red"></span> Alta';
				break;
			case 2:
				$res = '<span class="glyphicon glyphicon-chevron-right" style="color:orange"></span> Media';
				break;
			case 3:
				$res = '<span class="glyphicon glyphicon-chevron-right" style="color:blue"></span> Baja';
				break;
		}
		return $res;
	}

	if(!function_exists('set_priority'))
	{
		function set_priority($t) {

			switch ($t) {
				case 1:
					$res = 'danger';
					break;
				case 2:
					$res = 'warning';
					break;
				case 3:
					$res = '';
					break;
			}
			return $res;
		}
	}

	if(!function_exists('unix_to_normal'))
	{
		function unix_to_normal($string) {

			$timestamp = substr($string, 0, -3);
			$res = date("Y/m/d H:i:s", $timestamp);
			
			return $res;
		}
	}

	if(!function_exists('unix_to_normal_show'))
	{
		function unix_to_normal_show($string) {

			$timestamp = substr($string, 0, -3);
			$res = date("d/m/Y H:i:s", $timestamp);
			
			return $res;
		}
	}

	if(!function_exists('normal_to_unix'))
	{
		function normal_to_unix($string) {

			$res = strtotime($string).'000';
			
			return $res;
		}
	}

	if(!function_exists('format_date'))
	{
		function format_date($string) {

			$res = explode('-',$string);
			
			return $res[2].'/'.$res[1].'/'.$res[0];
		}
	}

	if(!function_exists('validity'))
	{
		function validity($string) {

			$todays          = date("Y-m-d");
			$today           = strtotime($todays);
			$expiration_date = strtotime($string);

			if($expiration_date >= $today):
				return '<center><span class="label label-success">Vigente</span></center>';
			else:
				return '<center><span class="label label-danger">Caducado</span></center>';
			endif;
		}
	}
}


