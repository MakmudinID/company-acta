<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table      = 'blog';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    protected $allowedFields = ['id', 'photo_url', 'judul', 'slug', 'ringkasan', 'konten', 'create_date'];
    protected $useTimestamps = true;

    public function fetchTag($blog_id){
        $query = $this->db->query("SELECT blog_tag.* FROM blog JOIN blog_tag ON blog_tag.blog_id = blog.id WHERE blog_tag.blog_id=? ", array($blog_id));
        return $query->getResult();
    }
}