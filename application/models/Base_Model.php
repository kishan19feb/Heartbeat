<?php defined('BASEPATH') or exit('No direct script access allowed');
class Base_Model extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	
	function saveEntity($entityName, $arrData, $arrWhere = array()){
        $response = 0;
        if (! empty($arrWhere)) {
            $this->db->where($arrWhere);
            $this->db->update($entityName, $arrData);
            $response = $this->db->affected_rows();
        } else {
            $status = $this->db->insert($entityName, $arrData);
            $response = $status ? $this->db->insert_id() : $response;
        }
        return $response;
    }
    
    function getEntity($entityName, $arrWhere = array(), $onlyCount = false){
        if (! empty($arrWhere)) {
            $this->db->where($arrWhere);
        }
        $response = $this->db->get($entityName);
        if ($onlyCount) {
            $response = count($response->result_array());
        }
        return $response;
    }
    
    function removeEntity($entityName, $arrWhere = array()){
        if (! empty($arrWhere)) {
            $this->db->where($arrWhere);
        }
        $this->db->delete($entityName);
        return $this->db->affected_rows();
    }
}