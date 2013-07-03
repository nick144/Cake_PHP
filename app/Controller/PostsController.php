<?php

class PostsController extends AppController{
	public $helper = array("Html", "Form");
	
	public function index(){
		$this->set('posts', $this->Post->find('all'));
	}
	
	public function view($id = null){
		if(!$id){
			throw new NotFoundException(__('Invalid Post'));
		}
		
		$post = $this->Post->findById($id);
		
		if(!$post){
			throw new NotFoundException(__('Invalid Post'));
		}
		
		$this->set('post', $post);
	}
	
	public function add(){
		if($this->request->is('post')){
			$this->Post->create();
			if($this->Post->save($this->request->data)){
				$this->Session->setFlash("Your post has been saves.");
				$this->redirect(array("action" => "index"));
			}else{
				$this->Session->setFlash("Unable to add your post.");
			}
		}
	}
	
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}

		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		if($this->request->is('post') || $this->request->is('put')){
			$this->Post->id = $id;
			
			if($this->Post->save($this->request->data)){
				$this->Session->setFlash("Your POst has been Updated");
				$this->redirect(array("action"=>"index"));
			}else{
				$this->Session->setFlash("Unable to Update the Post");
			}
		
		}
		
		if(!$this->request->data){
			$this->request->data = $post;
		}
	}
}