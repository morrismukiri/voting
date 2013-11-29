<?php

/**
 * Model to do all the CRUD unctions and do maintain the transaction log
 *
 * @author Morris
 */
class crud extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Add a single record to the database
     * 
     * @param String $table Name of the table to insert to
     * @param Array $data Data to be inserted e.g array('name'=>'John')
     * @return Integer Id of the primary key or -1 if false
     */
    function add($table, $data) {
      if( $result= $this->db->insert($table, $data)){
           return $this->db->insert_id();
      }  else {
           return FALSE;
      }
      
        
    }

    /**
     * Edit a single record in the database
     * 
     * @param String $table Name of the table to update
     * @param Array $data Data to be Updated e.g array('name'=>'George')
     * @param Integer $id Description
     * @return Integer Id of the primary key or -1 if false
     */
    function edit($table, $data, $pk) {
        
    }

    /**
     * Delete a single record from the database
     * @param String $table name of the table to delete from
     * @param Integer $pk primary key of the row to delete
     * @param Boolean $completely Delete completely or change the status
     */
    function delete($table, $pk, $completely = 0) {
        
    }

    /**
     * 
     * @param type $table
     * @param type $fields
     * @param type $condition
     * @param type $group
     * @param type $sort
     */
    function get($table, $fields = '*', $condition = '', $join = '', $group = '', $sort = '') {
        
    }

    function get_all_records($table) {
        $results = $this->db->get($table);
        return $results->num_rows() > 0 ? $results->result() : FALSE;
    }

    function find_in_db($table, $field, $value) {
        $results = $this->db->where($field, $value)->get_where($table);
        return $results->num_rows() > 0 ? $results->result() : FALSE;
    }

}

?>
