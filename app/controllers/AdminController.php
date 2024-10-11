<?php 
/**
 * Admin Page Controller
 * @category  Controller
 */
class AdminController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "admin";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("admin.id_admin", 
			"admin.nama_admin", 
			"user.nama AS user_nama", 
			"admin.jenis_kelamin", 
			"admin.jabatan", 
			"admin.email", 
			"admin.password", 
			"admin.no_telepon", 
			"admin.photo", 
			"admin.id_user", 
			"admin.role_id");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				admin.id_admin LIKE ? OR 
				admin.nama_admin LIKE ? OR 
				admin.jenis_kelamin LIKE ? OR 
				admin.jabatan LIKE ? OR 
				admin.email LIKE ? OR 
				admin.password LIKE ? OR 
				admin.no_telepon LIKE ? OR 
				admin.photo LIKE ? OR 
				admin.id_user LIKE ? OR 
				admin.role_id LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "admin/search.php";
		}
		$db->join("user", "admin.nama_admin = user.user_role_id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("admin.id_admin", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Admin";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("admin/list.php", $data); //render the full page
	}
	/**
     * Load json data
     * @return data
     */
	function import_data(){
		if(!empty($_FILES['file'])){
			$finfo = pathinfo($_FILES['file']['name']);
			$ext = strtolower($finfo['extension']);
			if(!in_array($ext , array('json'))){
				$this->set_flash_msg("File format not supported", "danger");
			}
			else{
			$file_path = $_FILES['file']['tmp_name'];
				if(!empty($file_path)){
					$request = $this->request;
					$db = $this->GetModel();
					$tablename = $this->tablename;
					$data = $db->loadJsonData( $file_path, $tablename , false );
					if($db->getLastError()){
						$this->set_flash_msg($db->getLastError(), "danger");
					}
					else{
						$this->set_flash_msg("Data imported successfully", "success");
					}
				}
				else{
					$this->set_flash_msg("Error uploading file", "danger");
				}
			}
		}
		else{
			$this->set_flash_msg("No file selected for upload", "warning");
		}
		$this->redirect("admin");
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("admin.id_admin", 
			"admin.nama_admin", 
			"user.nama AS user_nama", 
			"admin.jenis_kelamin", 
			"admin.jabatan", 
			"admin.email", 
			"admin.password", 
			"admin.no_telepon", 
			"admin.photo", 
			"admin.id_user", 
			"admin.role_id");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("admin.id_admin", $rec_id);; //select record based on primary key
		}
		$db->join("user", "admin.nama_admin = user.user_role_id", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Admin";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("admin/view.php", $record);
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_admin","nama_admin","jenis_kelamin","jabatan","email","password","no_telepon","photo","id_user","role_id");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$cpassword = $postdata['confirm_password'];
			$password = $postdata['password'];
			if($cpassword != $password){
				$this->view->page_error[] = "Your password confirmation is not consistent";
			}
			$this->rules_array = array(
				'id_admin' => 'required|numeric',
				'nama_admin' => 'required',
				'jenis_kelamin' => 'required',
				'jabatan' => 'required',
				'email' => 'required|valid_email',
				'password' => 'required',
				'no_telepon' => 'required',
				'photo' => 'required',
				'id_user' => 'required',
				'role_id' => 'required',
			);
			$this->sanitize_array = array(
				'id_admin' => 'sanitize_string',
				'nama_admin' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'jabatan' => 'sanitize_string',
				'email' => 'sanitize_string',
				'no_telepon' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'id_user' => 'sanitize_string',
				'role_id' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$password_text = $modeldata['password'];
			//update modeldata with the password hash
			$modeldata['password'] = $this->modeldata['password'] = password_hash($password_text , PASSWORD_DEFAULT);
			if($this->validated()){
				$db->where("admin.id_admin", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("admin");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("admin");
					}
				}
			}
		}
		$db->where("admin.id_admin", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Admin";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("admin/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id_admin","nama_admin","jenis_kelamin","jabatan","email","password","no_telepon","photo","id_user","role_id");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'id_admin' => 'required|numeric',
				'nama_admin' => 'required',
				'jenis_kelamin' => 'required',
				'jabatan' => 'required',
				'email' => 'required|valid_email',
				'password' => 'required',
				'no_telepon' => 'required',
				'photo' => 'required',
				'id_user' => 'required',
				'role_id' => 'required',
			);
			$this->sanitize_array = array(
				'id_admin' => 'sanitize_string',
				'nama_admin' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'jabatan' => 'sanitize_string',
				'email' => 'sanitize_string',
				'no_telepon' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'id_user' => 'sanitize_string',
				'role_id' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("admin.id_admin", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("admin.id_admin", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("admin");
	}
}
