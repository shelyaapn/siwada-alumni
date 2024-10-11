<?php 
/**
 * Tabulasi_per_tahun Page Controller
 * @category  Controller
 */
class Tabulasi_per_tahunController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "Tabulasi_Per_Tahun";
	}
}
