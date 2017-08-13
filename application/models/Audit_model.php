<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Audit_model extends CI_Model
{
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'audits';
    }

    function get_audit_by_id_user($idUser)
    {
        $this->db->where('id_user', $idUser);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    function save_audit($data)
    {
        return $this->db->insert($this->table, $data);
    }
}