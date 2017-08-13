<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table;

    /**
     * User_model constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    /**
     * @param $email
     * @param $password
     * @return array
     */
    function get_user($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $query = $this->db->get($this->table);

        return $query->result();
    }

    /**
     * @param $id
     * @return array
     */
    function get_user_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    /**
     * @param $data
     * @return int
     */
    function save_user($data)
    {
        $insertFlag = $this->db->insert($this->table, $data);
        if ($insertFlag) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
}