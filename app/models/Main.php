<?php

namespace app\models;

use app\core\Model;
use app\lib\Slug;

class Main extends Model
{
    public function getArticles()
    {
        return $this->db->row('SELECT id, title, description, image, slug from news ORDER BY id DESC');
    }

    public function getArticleBySlug($slug)
    {
        $data = $this->db->row('SELECT * from news WHERE slug = :slug', ['slug' => $slug]);
        if ($data) {
            return $data[0];
        } else {
            return [];
        }
    }

    public function getArticleById($id)
    {
        $data = $this->db->row('SELECT * from news WHERE id = :id', ['id' => $id]);
        if ($data) {
            return $data[0];
        } else {
            return [];
        }
    }

    public function create($data)
    {
        $params = [
            'id' => '',
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'],
            'image' => $data['image'],
            'full_description' => $data['full_description'],
            'slug' => Slug::create($data['title']),
        ];
        $res = $this->db->query('INSERT INTO news VALUES (:id, :title, :description, :category, :image, :full_description, :slug)', $params);

        if ($res['status']) {
            return $this->db->getLastInsertId();
        } else {
            debug($res);
            return false;
        }
    }

    public function update($data)
    {
        $params = [
            'id' => $data['id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'],
            'image' => $data['image'],
            'detail_description' => $data['full_description'],
            'slug' => Slug::create($data['title']),
        ];
        $res = $this->db->query('UPDATE news SET title = :title, description = :description, category = :category, image = :image, detail_description = :detail_description, slug = :slug WHERE id = :id', $params);

        if ($res['status']) {
            return true;
        } else {
            debug($res);
            return false;
        }
    }

    public function deleteArticleById($id)
    {
        $res = $this->db->query('DELETE FROM news WHERE id = :id', ['id' => $id]);
        if ($res['status']) {
            return true;
        } else {
            debug($res);
            return false;
        }
    }
}