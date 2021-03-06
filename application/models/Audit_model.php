<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Audit_model.
 *
 * Model to help interact with audits table in database.
 */
class Audit_model extends CI_Model
{
    /**
     * @var string
     */
    private $table;

    /**
     * Audit_model constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->table = 'audits';
    }

    /**
     * Retrieve the registration and login history of the user from the database table
     * based on the given id of user.
     *
     * @param $idUser
     * @param int $currentPage
     * @param int $resultsPerPage
     * @return array
     */
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

    /**
     * Counts the number of rows in the database table for both registration and login history of the
     * user based on the given id of user.
     *
     * @param $idUser
     * @return int
     */
    function get_audit_count_by_id_user($idUser)
    {
        $this->db->from($this->table);
        $this->db->where('id_user', $idUser);
        $count = $this->db->count_all_results();

        return $count;
    }

    /**
     * Store the audit information in the database table as is.
     *
     * @param $data
     * @return bool
     */
    function save_audit($data)
    {
        return $this->db->insert($this->table, $data);
    }
}