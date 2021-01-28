<?php
namespace controllers;

use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\utils\http\USession;

/**
 * Controller TodosController
 **/
class TodosController extends ControllerBase{

	public function initialize()
	{
		parent::initialize();
		$this->menu();
	}


	public function menu(){
		$this->loadView('todosController/menu.html');
	}

	#[Route("_default", name:"home")]
	public function index(){
	
	}


	#[Get(path: "todos/delete/{index}", name: "todos.delete")]
	public function deleteElement($index){
		
	}


	#[Post(path: "todos/add/", name:"todos.add")]
	public function addElement(){
		
	}


	#[Post(path: "todos/edit/{index}", name:"todos.edit")]
	public function editElement($index){
		
	}


	#[Get(path: "todos/loadList/{uniqid}", name:"todos.loadList")]
	public function loadList($uniqid){
		
	}


	#[Post(path: "todos/loadList/", name:"todosLoadListPost")]
	public function loadListFromForm(){
		
	}


	#[Get(path: "todos/new/{force}", name:"todos.new")]
	public function newlist($force){
		
	}


	#[Get(path: "todos/save", name:"todos.save")]
	public function saveList(){
		
	}

}
