<?php
session_start();
class connect
{
	public function connectid($id)
	{
			$_SESSION['id'] = $id;
	}
	public function connectpre($prenom)
	{
			$_SESSION['prenom'] = $prenom;
	}
	public function connectidp($idprojet)
	{
			$_SESSION['idprojet'] = $idprojet;
	}
	public function connectcli($idclient)
	{
			$_SESSION['idclient'] = $idclient;
	}
	public function getid()
	{
			return $_SESSION['id'];
	}
	public function getpre()
	{
			return $_SESSION['prenom'];
	}
	public function getidp()
	{
			return $_SESSION['idprojet'];
	}
	public function getcli()
	{
			return $_SESSION['idclient'];
	}
	
}?>