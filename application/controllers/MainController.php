<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Post;

class MainController extends Controller
{

	public function indexAction()
	{
		$postModel = new Post;
		$pagination = new Pagination($this->route, $postModel->postsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $postModel->postsList($this->route),
		];
		$this->view->render('Главная страница', $vars);
	}

	public function aboutAction()
	{
		$this->view->render('Обо мне');
	}

	public function contactAction()
	{
		if (!empty($_POST)) {
			if (!$this->model->contactValidate($_POST)) {
				$this->view->message('error', $this->model->error);
			}
			mail('famouscossacks@gmail.com', 'Сообщение из блога', $_POST['name'] . '|' . $_POST['email'] . '|' . $_POST['text']);
			$this->view->message('success', 'Сообщение отправлено Администратору');
		}
		$this->view->render('Контакты');
	}

	public function postAction()
	{
		$postModel = new Post;
		if (!$postModel->isPostExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$vars = [
			'data' => $postModel->postData($this->route['id'])[0],
		];
		$this->view->render('Пост', $vars);
	}
}
