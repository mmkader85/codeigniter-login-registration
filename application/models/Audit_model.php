<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Audit_model extends CI_Model
{
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'audits';
    }

    function get_audit_by_id_user($idUser, $currentPage = 0, $resultsPerPage = 0)
    {
        $offset = 0;
        $limit = $resultsPerPage;
        if ($currentPage && $resultsPerPage) {
            if ($currentPage >= 1) {
                $offset = $currentPage * $resultsPerPage;
            }
        }

        $this->db->where('id_user', $idUser);
        $this->db->order_by('id_audit', 'desc');

        if ($offset && $limit) {
            $this->db->limit($offset, $limit);
        } else if ($limit) {
            $this->db->limit($limit);
        }

        $query = $this->db->get($this->table);

        return $query->result();
    }

    function get_audit_count_by_id_user($idUser)
    {
        $this->db->from($this->table);
        $this->db->where('id_user', $idUser);
        $count = $this->db->count_all_results();

        return $count;
    }

    function save_audit($data)
    {
        return $this->db->insert($this->table, $data);
    }
}