<?php

namespace App\Models;

use CodeIgniter\Model;

class ServerSideModel extends Model
{
    protected $q;
    protected $up;
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function getBlogBy($slug){
        date_default_timezone_set('Asia/Jakarta');

        $slug = $this->db->escapeString($slug);
        $query = $this->db->query("SELECT * FROM blog WHERE slug=? and status=?", array($slug, 1))->getRow();
        if(empty($query)){
            return '';
        }else{
            return $query;
        }
    }

    public function createRows($data, $table)
    {
        $q = $this->db->table($table);
        $q->insert($data);

        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function createRowsReturnID($data, $table)
    {
        $q = $this->db->table($table);
        $q->insert($data);

        if ($this->db->affectedRows() > 0) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function updateRows($id, $data, $table)
    {
        $q = $this->db->table($table);
        $q->where('id', $id);
        $q->update($data);

        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function replaceRows($data, $table)
    {
        // $up = $this->db->table($table);

        $q = $this->db->table($table);
        $q->replace($data);

        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteRows($id, $table){
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        $up = $this->db->table($table);
        $up->delete(['id' => $id_]);

        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteRowsBy($field, $id, $table){
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        $up = $this->db->table($table);
        $up->delete([$field => $id_]);

        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBlog($id){
        $id_ = htmlspecialchars($id, ENT_QUOTES);

        $src = $this->db->table('blog')->getWhere(['id' => $id_])->getRow()->photo_url;

        $file_name = '.'.str_replace(base_url('/'), '', $src); // striping host to get relative path
        $a = explode("/", $file_name);

        if(file_exists('./assets-cms/img/blog/'.end($a))){
            unlink('./assets-cms/img/blog/'.end($a));
        }

        $up = $this->db->table('blog_tag');
        $up->delete(['blog_id' => $id_]);
        
        $del = $this->db->table('blog');
        $del->delete(['id' => $id_]);

        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function createBlog($blog, $blog_tag){
        $q = $this->db->table('blog');
        $q->insert($blog);
        $blog_id = $this->db->insertID();

        if ($this->db->affectedRows() > 0) {
            if($blog_tag != NULL){
                foreach ($blog_tag['listTag'] as $tag) {
                    $data=array(
                        'blog_id' => $blog_id,
                        'name' => htmlspecialchars($tag, ENT_QUOTES),
                        'create_user' => session()->get('admin_name')
                    );
                    $q_tag = $this->db->table('blog_tag');
                    $q_tag->insert($data);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function createPortfolio($portfolio, $portfolio_tag){
        $q = $this->db->table('portfolio');
        $q->insert($portfolio);
        $portfolio_id = $this->db->insertID();

        if ($this->db->affectedRows() > 0) {
            if($portfolio_tag != NULL){
                foreach ($portfolio_tag['listTag'] as $tag) {
                    $data=array(
                        'id_portfolio' => $portfolio_id,
                        'nama' => htmlspecialchars($tag, ENT_QUOTES),
                        'create_user' => session()->get('admin_name'),
                        'create_date' => date('Y-m-d H:i:s')
                    );
                    $q_tag = $this->db->table('portfolio_tag');
                    $q_tag->insert($data);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function updatePortfolio($id, $portfolio, $portfolio_tag){
        $q = $this->db->table('portfolio');
        $q->where('id', $id);
        $q->update($portfolio);

        if ($this->db->affectedRows() > 0) {
            if($portfolio_tag != NULL){
                $up = $this->db->table('portfolio_tag');
                $up->delete(['id_portfolio' => $id]);
                foreach ($portfolio_tag['listTag'] as $tag) {
                    $data=array(
                        'id_portfolio' => $id,
                        'nama' => htmlspecialchars($tag, ENT_QUOTES),
                        'edit_user' => session()->get('admin_name'),
                        'edit_date' => date('Y-m-d H:i:s')
                    );
                    $q_tag = $this->db->table('portfolio_tag');
                    $q_tag->insert($data);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function updateBlog($id, $blog, $blog_tag){
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        $q = $this->db->table('blog');
        $q->where('id', $id);
        $q->update($blog);

        if ($this->db->affectedRows() > 0) {
            if($blog_tag != NULL){
                $up = $this->db->table('blog_tag');
                $up->delete(['blog_id' => $id]);
                foreach ($blog_tag['listTag'] as $tag) {
                    $data=array(
                        'blog_id' => $id,
                        'name' => htmlspecialchars($tag, ENT_QUOTES),
                        'edit_user' => session()->get('admin_name'),
                        'edit_date' => date('Y-m-d H:i:s'),
                    );
                    $q_tag = $this->db->table('blog_tag');
                    $q_tag->insert($data);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function listTag()
    {
        date_default_timezone_set('Asia/Jakarta');
        $query = $this->db->query("SELECT DISTINCT(`name`) FROM blog_tag");
        $list = $query->getResult();
        $tag = "";
        foreach($list as $ls){
            $tag.= '"'.$ls->name.'", ';
        }
        return '['.rtrim($tag,", ").']';
    }

    public function listTagPortfolio()
    {
        date_default_timezone_set('Asia/Jakarta');
        $query = $this->db->query("SELECT DISTINCT(`nama`) FROM portfolio_tag");
        $list = $query->getResult();
        $tag = "";
        foreach($list as $ls){
            $tag.= '"'.$ls->nama.'", ';
        }
        return '['.rtrim($tag,", ").']';
    }

    public function limitRows($table, $select, $column_order, $column_search, $order, $join=NULL, $where=NULL)
    {
        $this->selectField($table, $select, $column_order, $column_search, $order, $join, $where);
        if (isset($_POST['length'])) {
            if ($_POST['length'] != -1) {
                $this->builder->limit($_POST['length'], $_POST['start']);
            }
        }
        $query = $this->builder->get();
        return $query->getResult();
    }

    protected function selectField($table, $select, $column_order, $column_search, $order, $join=NULL, $where=NULL)
    {
        $this->builder = $this->db->table($table);
        $this->builder->select($select);
        
        if($join != NULL){
            for ($i = 0; $i < count($join); $i++) {
                $this->builder->join($join[$i][0], $join[$i][1]);
            }
        };

        if ($where != NULL) {
            for ($i = 0; $i < count($where); $i++) {
                $this->builder->where($where[$i][0], $where[$i][1]);
            }
        };

        $i = 0;
        foreach ($column_search as $item) {
            if (isset($_POST['search'])) {
                if ($_POST['search']['value']) {
                    if ($i === 0) {
                        $this->builder->groupStart();
                        $this->builder->like($item, $_POST['search']['value']);
                    } else {
                        $this->builder->orLike($item, $_POST['search']['value']);
                    }

                    if (count($column_search) - 1 == $i) {
                        $this->builder->groupEnd();
                    }
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->builder->orderBy($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($order)) {
            $order = $order;
            $this->builder->orderBy(key($order), $order[key($order)]);
        }
    }

    public function countFiltered($table, $select, $column_order, $column_search, $order, $join=NULL, $where=NULL)
    {
        $this->selectField($table, $select, $column_order, $column_search, $order, $join, $where);
        return $this->builder->countAllResults();
    }

    public function countAll($table)
    {
        $this->builder = $this->db->table($table);
        return $this->builder->countAllResults();
    }

    public function fetchData($table, $select, $where=NULL, $join=NULL){
        $this->builder = $this->db->table($table);
        $this->builder->select($select);

        if($join != NULL){
            for ($i = 0; $i < count($join); $i++) {
                $this->builder->join($join[$i][0], $join[$i][1]);
            }
        };

        if($where != NULL){
            for ($i = 0; $i < count($where); $i++) {
                $this->builder->where($where[$i][0], $where[$i][1]);
            }
        };

        $query = $this->builder->get();
        return $query->getResult();
    }

    public function apiLayanan($url){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',
			)                                                                       
        );   
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
        //execute post
        $request = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if($httpCode == 200)
        {
            $results = json_decode($request, true);
            return $results;
        }
        else
        {
            $error_message = "Server Error " . $httpCode ." ";
            return $error_message;
        }
    }
}
