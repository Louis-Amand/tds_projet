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
	const CACHE_KEY = 'datas/lists/';
	const EMPTY_LIST_ID='not saved';
	const LIST_SESSION_KEY='list';
	const ACTIVE_LIST_SESSION_KEY='active-list';

	public function initialize()
	{
		parent::initialize();
		$this->menu();
	}


	public function menu(){
		$this->loadView('todosController/menu.html');
	}

 	#[Route(path:"_default", name:'home' )]
 	public function index(){
	if(USession::exists(self::LIST_SESSION_KEY)) {
		$list = USession::get(self::LIST_SESSION_KEY, []);
		return $this->display($list);
	}
	$this->showMessage('Bienvenue !','TodoLists permet de gerer des listes...','info','info circle',[['caption'=>'ouvrir']]);
 }
	
	public function display(array $list){
		$this->loadView('todosController/display.html');
	}


	private function showMessage(string $header, string $message, string $type = '', string $icon = 'info circle',array $buttons=[]) {
		$this->loadView('main/showMessage.html', compact('header', 'type', 'icon', 'message','buttons'));
		
	}

	public function displayList(array $list){
		$this->jquery->change('#multiple','$("._form").toggle();');
		$this->jquery->renderView('todosController/displayList.html',['list'=>$list]);
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
