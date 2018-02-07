<?php

class Phone_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_phone($name, $phone, $note) {
        $data = array(
            'name' => $name,
            'phone' => $phone,
            'note' => $note,
        );

        return $this->db->insert('phones', $data);
    }

    public function update_phone($id, $name, $phone, $note) {
        return $this->db->where('ID', $id)->update('phones', array('name' => $name, 'phone' => $phone, 'note' => $note));
    }

    public function get_phones($offset=null) {
        if(!is_null($offset))
            return $this->db->limit(10,$offset)->get('phones')->result();
        else
            return $this->db->get('phones')->result();
    }

    public function get_phone_by_id($id) {
        return $this->db->get_where('phones', array('id' => $id))->row();
    }

    public function delete_phone($id) {
        return $this->db->delete('phones', array('id' => $id));
    }

    public function search_phone($search, $offset=null) {
        if(is_null($offset))
            return $this->db->like('name', $search)->or_like('phone', $search)->or_like('date', $search)->or_like('note', $search)->get('phones')->result();
        else
            return $this->db->limit(10,$offset)->like('name', $search)->or_like('phone', $search)->or_like('date', $search)->or_like('note', $search)->get('phones')->result();
    }
}