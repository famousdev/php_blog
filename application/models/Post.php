<?php

namespace application\models;

use application\core\Model;

class Post extends Model
{
	public function isPostExists($id)
	{
		$params = [
			'id' => $id,
		];
		return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);
	}
	public function postData($id)
	{
		$params = [
			'id' => $id,
		];
		return $this->db->row('SELECT * FROM posts WHERE id = :id', $params);
	}

	public function postAdd($post)
	{
		$params = [
			'id' => $post['id'],
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
		];
		$this->db->query('INSERT INTO posts VALUES (:id, :name, :description, :text)', $params);
		return $this->db->lastInsertId();
	}

	public function postEdit($post, $id)
	{
		$params = [
			'id' => $id,
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
		];
		$this->db->query('UPDATE posts SET name = :name, description = :description, text = :text WHERE id = :id', $params);
	}

	public function postUploadImage($path, $id)
	{
		move_uploaded_file($path, 'public/materials/' . $id . '.jpg');
	}

	public function postDelete($id)
	{
		$params = [
			'id' => $id,
		];
		$this->db->query('DELETE FROM posts WHERE id = :id', $params);
		unlink('public/materials/' . $id . '.jpg');
	}

	public function postsCount()
	{
		return $this->db->column('SELECT COUNT(id) FROM posts');
	}

	public function postsList($route)
	{
		$max = 5;
		$params = [
			'max' => $max,
			'start' => ((($route['page'] ?? 1) - 1) * $max),
		];
		return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :start, :max', $params);
	}
}
