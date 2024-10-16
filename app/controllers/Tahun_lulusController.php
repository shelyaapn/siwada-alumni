<?php 
/**
 * Tahun_lulus Page Controller
 * @category  Controller
 */
class Tahun_lulusController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "tahun_lulus";
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
		$fields = $this->fields = array("id_tahun_lulus","tahun_lulus","id_user","id_jurusan");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'id_tahun_lulus' => 'required|numeric',
				'tahun_lulus' => 'required',
				'id_user' => 'required',
				'id_jurusan' => 'required',
			);
			$this->sanitize_array = array(
				'id_tahun_lulus' => 'sanitize_string',
				'tahun_lulus' => 'sanitize_string',
				'id_user' => 'sanitize_string',
				'id_jurusan' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("tahun_lulus.id_tahun_lulus", $rec_id);;
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
}
