<?php 
/**
 * Account Page Controller
 * @category  Controller
 */
class AccountController extends SecureController{
	function __construct(){
		parent::__construct(); 
		$this->tablename = "user";
	}
	/**
		* Index Action
		* @return null
		*/
	function index(){
		$db = $this->GetModel();
		$rec_id = $this->rec_id = USER_ID; //get current user id from session
		$db->where ("id_user", $rec_id);
		$tablename = $this->tablename;
		$fields = array("user.id_user", 
			"user.nama", 
			"user.jenis_kelamin", 
			"user.tahun_lulus", 
			"user.jurusan", 
			"jurusan.jurusan AS jurusan_jurusan", 
			"user.email", 
			"user.no_telepon", 
			"user.alamat", 
			"user.pekerjaan_saat_ini", 
			"user.account_status", 
			"user.user_role_id", 
			"roles.role_name AS roles_role_name");
		$db->join("jurusan", "user.jurusan = jurusan.id_jurusan", "INNER");
		$db->join("roles", "user.user_role_id = roles.role_id", "INNER");
		$user = $db->getOne($tablename , $fields);
		if(!empty($user)){
			$page_title = $this->view->page_title = "My Account";
			$this->render_view("account/view.php", $user);
		}
		else{
			$this->set_page_error();
			$this->render_view("account/view.php");
		}
	}
	/**
     * Update user account record with formdata
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = USER_ID;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_user","nama","jenis_kelamin","tahun_lulus","jurusan","no_telepon","alamat","pekerjaan_saat_ini","photo","account_status","user_role_id");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nama' => 'required',
				'jenis_kelamin' => 'required',
				'tahun_lulus' => 'required',
				'jurusan' => 'required',
				'no_telepon' => 'required',
				'alamat' => 'required',
				'pekerjaan_saat_ini' => 'required',
				'photo' => 'required',
				'account_status' => 'required',
			);
			$this->sanitize_array = array(
				'nama' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'tahun_lulus' => 'sanitize_string',
				'jurusan' => 'sanitize_string',
				'no_telepon' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'pekerjaan_saat_ini' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'account_status' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['nama'])){
				$db->where("nama", $modeldata['nama'])->where("id_user", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['nama']." Already exist!";
				}
			}
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['no_telepon'])){
				$db->where("no_telepon", $modeldata['no_telepon'])->where("id_user", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['no_telepon']." Already exist!";
				}
			} 
			if($this->validated()){
				$db->where("user.id_user", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					$db->where ("id_user", $rec_id);
					$user = $db->getOne($tablename , "*");
					set_session("user_data", $user);// update session with new user data
					return $this->redirect("account");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$this->set_flash_msg("No record updated", "warning");
						return	$this->redirect("account");
					}
				}
			}
		}
		$db->where("user.id_user", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "My Account";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("account/edit.php", $data);
	}
	/**
     * Change account email
     * @return BaseView
     */
	function change_email($formdata = null){
		if($formdata){
			$email = trim($formdata['email']);
			$db = $this->GetModel();
			$rec_id = $this->rec_id = USER_ID; //get current user id from session
			$tablename = $this->tablename;
			$db->where ("id_user", $rec_id);
			$result = $db->update($tablename, array('email' => $email ));
			if($result){
				$this->set_flash_msg("Email address changed successfully", "success");
				$this->redirect("account");
			}
			else{
				$this->set_page_error("Email not changed");
			}
		}
		return $this->render_view("account/change_email.php");
	}
}
