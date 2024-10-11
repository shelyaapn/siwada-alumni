<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * jurusan_jurusan_value_exist Model Action
     * @return array
     */
	function jurusan_jurusan_value_exist($val){
		$db = $this->GetModel();
		$db->where("jurusan", $val);
		$exist = $db->has("jurusan");
		return $exist;
	}

	/**
     * loker_mitra_option_list Model Action
     * @return array
     */
	function loker_mitra_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_mitra AS value , id_mitra AS label FROM mitra ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * mitra_mitra_value_exist Model Action
     * @return array
     */
	function mitra_mitra_value_exist($val){
		$db = $this->GetModel();
		$db->where("mitra", $val);
		$exist = $db->has("mitra");
		return $exist;
	}

	/**
     * user_tahun_lulus_option_list Model Action
     * @return array
     */
	function user_tahun_lulus_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_tahun_lulus AS value,tahun_lulus AS label FROM tahun_lulus";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_jurusan_option_list Model Action
     * @return array
     */
	function user_jurusan_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_jurusan AS value,jurusan AS label FROM jurusan";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_nama_value_exist Model Action
     * @return array
     */
	function user_nama_value_exist($val){
		$db = $this->GetModel();
		$db->where("nama", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * user_email_value_exist Model Action
     * @return array
     */
	function user_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * user_no_telepon_value_exist Model Action
     * @return array
     */
	function user_no_telepon_value_exist($val){
		$db = $this->GetModel();
		$db->where("no_telepon", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * user_user_role_id_option_list Model Action
     * @return array
     */
	function user_user_role_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * tahun_lulus_tahun_lulus_option_list Model Action
     * @return array
     */
	function tahun_lulus_tahun_lulus_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_user AS value , id_user AS label FROM user ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * tahun_lulus_id_user_option_list Model Action
     * @return array
     */
	function tahun_lulus_id_user_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_user AS value , id_user AS label FROM user ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * tahun_lulus_id_jurusan_option_list Model Action
     * @return array
     */
	function tahun_lulus_id_jurusan_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_jurusan AS value , id_jurusan AS label FROM jurusan ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

}
