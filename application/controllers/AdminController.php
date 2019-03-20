<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Post;

class AdminController extends Controller
{

	public function __construct($route)
	{
		parent::__construct($route);
		$this->view->layout = 'admin';
	}

	public function loginAction()
	{
		if (isset($_SESSION['admin'])) {
			$this->view->redirect('admin/posts');
		}
		if (!empty($_POST)) {
			if (!$this->model->loginValidate($_POST)) {
				$this->view->message('error', $this->model->error);
			}
			$_SESSION['admin'] = true;
			$this->view->location('admin/posts');
		}
		$this->view->render('Вход');
	}

	public function addAction()
	{
		$postModel = new Post;
		if (!empty($_POST)) {
			if (!$this->model->postValidate($_POST, 'add')) {
				$this->view->message('error', $this->model->error);
			}
			$id = $postModel->postAdd($_POST);
			if (!$id) {
				$this->view->message('error', 'Ошибка обработки запроса');
			}
			$postModel->postUploadImage($_FILES['img']['tmp_name'], $id);
			$this->view->message('success', 'Пост добавлен');
		}
		$this->view->render('Добавить пост');
	}

	public function editAction()
	{
		$postModel = new Post;
		if (!$postModel->isPostExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		if (!empty($_POST)) {
			if (!$this->model->postValidate($_POST, 'edit')) {
				$this->view->message('error', $this->model->error);
			}
			$postModel->postEdit($_POST, $this->route['id']);
			if ($_FILES['img']['tmp_name']) {
				$postModel->postUploadImage($_FILES['img']['tmp_name'], $this->route['id']);
			}
			$this->view->message('success', 'Сохранено');
		}
		$vars = [
			'data' => $postModel->postData($this->route['id'])[0],
		];
		$this->view->render('Редактировать пост', $vars);
	}

	public function deleteAction()
	{
		$postModel = new Post;
		if (!$postModel->isPostExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$postModel->postDelete($this->route['id']);
		$this->view->redirect('admin/posts');
	}

	public function logoutAction()
	{
		unset($_SESSION['admin']);
		$this->view->redirect('admin/login');
	}

	public function postsAction()
	{
		$postModel = new Post;
		$pagination = new Pagination($this->route, $postModel->postsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $postModel->postsList($this->route),
		];
		$this->view->render('Посты', $vars);
	}
}
