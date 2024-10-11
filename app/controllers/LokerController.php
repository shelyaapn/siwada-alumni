<?php 
/**
 * Loker Page Controller
 * @category  Controller
 */
class LokerController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "loker";
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
		$fields = array("loker.id_loker", 
			"loker.judul_loker", 
			"loker.photo", 
			"loker.mitra", 
			"mitra.mitra AS mitra_mitra", 
			"loker.tanggal_penutupan_loker", 
			"loker.tanggal_diubah", 
			"loker.editor", 
			"user.nama AS user_nama");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				loker.id_loker LIKE ? OR 
				loker.judul_loker LIKE ? OR 
				loker.isi_loker LIKE ? OR 
				loker.photo LIKE ? OR 
				loker.mitra LIKE ? OR 
				loker.tanggal_penutupan_loker LIKE ? OR 
				loker.tanggal_diubah LIKE ? OR 
				loker.editor LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "loker/search.php";
		}
		$db->join("mitra", "loker.mitra = mitra.id_mitra", "INNER");
		$db->join("user", "loker.editor = user.id_user", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("loker.id_loker", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Lowongan Pekerjaan";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("loker/list.php", $data); //render the full page
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
		$fields = array("loker.id_loker", 
			"loker.judul_loker", 
			"loker.isi_loker", 
			"loker.photo", 
			"loker.mitra", 
			"mitra.mitra AS mitra_mitra", 
			"loker.tanggal_penutupan_loker", 
			"loker.tanggal_diubah", 
			"loker.editor", 
			"user.nama AS user_nama");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("loker.id_loker", $rec_id);; //select record based on primary key
		}
		$db->join("mitra", "loker.mitra = mitra.id_mitra", "INNER");
		$db->join("user", "loker.editor = user.id_user", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "Detail Lowongan Pekerjaan";
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
		return $this->render_view("loker/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("judul_loker","isi_loker","photo","mitra","tanggal_penutupan_loker","tanggal_diubah","editor");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'judul_loker' => 'required',
				'isi_loker' => 'required',
				'photo' => 'required',
				'mitra' => 'required',
				'tanggal_penutupan_loker' => 'required',
			);
			$this->sanitize_array = array(
				'judul_loker' => 'sanitize_string',
				'isi_loker' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'mitra' => 'sanitize_string',
				'tanggal_penutupan_loker' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['tanggal_diubah'] = datetime_now();
$modeldata['editor'] = USER_ID;
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Data Berhasil Ditambahkan", "success");
					return	$this->redirect("loker");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Tambahkan Lowongan Baru";
		$this->render_view("loker/add.php");
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
		$fields = $this->fields = array("id_loker","judul_loker","isi_loker","photo","mitra","tanggal_penutupan_loker","tanggal_diubah","editor");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'judul_loker' => 'required',
				'isi_loker' => 'required',
				'photo' => 'required',
				'mitra' => 'required',
				'tanggal_penutupan_loker' => 'required',
			);
			$this->sanitize_array = array(
				'judul_loker' => 'sanitize_string',
				'isi_loker' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'mitra' => 'sanitize_string',
				'tanggal_penutupan_loker' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['tanggal_diubah'] = datetime_now();
$modeldata['editor'] = USER_ID;
			if($this->validated()){
				$db->where("loker.id_loker", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Data Berhasil Di Update", "success");
					return $this->redirect("loker");
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
						return	$this->redirect("loker");
					}
				}
			}
		}
		$db->where("loker.id_loker", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit Lowongan Pekerjaan";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("loker/edit.php", $data);
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
		$fields = $this->fields = array("id_loker","judul_loker","isi_loker","photo","mitra","tanggal_penutupan_loker","tanggal_diubah","editor");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'judul_loker' => 'required',
				'isi_loker' => 'required',
				'photo' => 'required',
				'mitra' => 'required',
				'tanggal_penutupan_loker' => 'required',
			);
			$this->sanitize_array = array(
				'judul_loker' => 'sanitize_string',
				'isi_loker' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'mitra' => 'sanitize_string',
				'tanggal_penutupan_loker' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("loker.id_loker", $rec_id);;
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
		$db->where("loker.id_loker", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Data Berhasil Dihapus", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("loker");
	}
}
