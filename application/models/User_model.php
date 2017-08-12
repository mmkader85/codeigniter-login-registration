<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    function get_user($email, $pwd)
    {
        $this->db->where('email', $email);
        $this->db->where('password', md5($pwd));
        $query = $this->db->get($this->table);

        return $query->result();
    }

    function get_user_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    function insert_user($data)
    {
        return $this->db->insert($this->table, $data);
    }
}