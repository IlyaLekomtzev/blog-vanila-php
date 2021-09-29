<?php

namespace app\controllers;

use app\core\Controller;
use app\core\View;
use app\lib\Slug;
use app\lib\Validator;

class MainController extends Controller
{
    public function indexAction()
    {
        $data = $this->model->getArticles();
        $this->view->render('Главная страница', [
            'news' => $data
        ]);
    }

    public function detailAction()
    {
        $slug = $this->route['slug'];
        $data = $this->model->getArticleBySlug($slug);
        if (empty($data)) {
            View::setErrorCode(404);
        }

        $this->view->render('Детальная страница', [
            'data' => $data,
            'colors' => ['primary', 'secondary', 'success', 'danger', 'dark']
        ]);
    }

    public function addAction()
    {
        $this->view->render('Добавление статьи');
    }

    public function createAction()
    {
        $validator = new Validator;
        $valid = $validator->make($_REQUEST, [
            'title' => [
                'required' => true,
                'min' => 1,
                'max' => 255
            ],
            'full_description' => [
                'required' => true,
                'min' => 10,
                'max' => 10000
            ],
        ]);

        if (!$valid) {
            $errors = $validator->getErrors();
            $this->view->redirect('/add?result=error');
        } else {
            $result = $this->model->create($_REQUEST);
            if ($result) {
                $this->view->redirect('/add?result=success');
            } else {
                debug($result);
            }
        }
    }

    public function editAction()
    {
        $id = $this->route['id'];
        $data = $this->model->getArticleById($id);
        if (empty($data)) {
            View::setErrorCode(404);
        }

        $this->view->render('Изменение статьи', ['data' => $data]);
    }

    public function updateAction()
    {
        $validator = new Validator;
        $valid = $validator->make($_REQUEST, [
            'title' => [
                'required' => true,
                'min' => 1,
                'max' => 255
            ],
            'full_description' => [
                'required' => true,
                'min' => 10,
                'max' => 10000
            ],
        ]);
        if (!$valid) {
            $errors = $validator->getErrors();
            debug($errors);
        } else {
            $result = $this->model->update($_REQUEST);
            if ($result) {
                $this->view->redirect('/');
            } else {
                debug($result);
            }
        }
    }

    public function deleteAction()
    {
        $id = $this->route['id'];
        if (empty($id)) {
            View::setErrorCode(404);
        }

        $result = $this->model->deleteArticleById($id);
        if ($result) {
            $this->view->redirect('/');
        } else {
            debug($result);
        }
    }
}