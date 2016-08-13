<?php

class common_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_records($table) {
        $results = $this->db->get($table);
        return $results->num_rows() > 0 ? $results->result() : FALSE;
    }

    function find_in_db($table, $field, $value) {
        $results = $this->db->where($field, $value)->get_where($table);
        return $results->num_rows() > 0 ? $results->result() : FALSE;
    }

    function insert_data($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function update_record($table, $data, $pkname, $pkvalue) {
        $this->db->where($pkname, $pkvalue);
        $this->db->update($table, $data);
    }

    function getcandidates($candidate_id = -1, $party_id = -1) {
        $this->db->select('*')
                ->from('candidates')
                ->join('parties', 'candidates.party_id=parties.party_id');
        if ($candidate_id != -1) {
            $this->db->where('candidates.candidate_id', $candidate_id);
        }
        if ($party_id != -1) {
            $this->db->where('candidates.party_id', $party_id);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function get_votes() {
        $this->db->select('COUNT(*) AS votes_count,candidates.*')->from('votes')
                ->join('candidates', 'candidates.candidate_id=votes.candidate_id')
                ->group_by('votes.candidate_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function send_sms($recipients, $message) {
//$this->load->add_package_path(APPPATH.'third_party/AfricasTalking/');


        $username = "morrismukiri";
        $apiKey_ = "7fc06e4ae63d1f55b29b91325f520d54aaec08798d2cdcdb5e7ea435c72a4262";
         $params = array(1=>$username,2=>$apiKey_);
                $this->load->library('AfricasTalkingGateway',compact('username','apiKey_'));
        $gateway = new AfricaStalkingGateway($username, $apiKey_);
        $results = $gateway->sendMessage($recipients, $message);
        $out = "";
        if (count($results)) {
            // These are the results if the request is well formed
            foreach ($results as $result) {
                $out = " Number: " . $result->number;
                $out.= " Status: " . $result->status;
                $out.= " MessageId: " . $result->messageId;
                $out.= " Cost: " . $result->cost . "\n";
            }
        } else {
            // We only get here if we cannot process your request at all
            // (usually due to wrong username/apikey combinations)
            $out.= "Oops, No messages were sent. ErrorMessage: " . $gateway->getErrorMessage();
        }
        return $out;
    }

}

?>