<?php
namespace controllers;

use Ajax\semantic\widgets\business\user\UserModel;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\Router;
use Ubiquity\utils\http\URequest;
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
		$list = USession::get(self::LIST_SESSION_KEY);
		return $this->displayList($list);
	}
	$this->showMessage('Bienvenue !','TodoLists permet de gerer des listes...','info','info circle',    [['url'=>Router::path('todos.new'),'caption'=>'créer une nouvelle liste','style'=>'basic inverted']]);
 }
	
	private function showMessage(string $header, string $message, string $type = '', string $icon = 'info circle',array $buttons=[]) {
		$this->loadView('main/showMessage.html', compact('header', 'type', 'icon', 'message','buttons'));
		
	}

	public function displayList($list){
        if(\count($list)>0){
            $this->jquery->show('._saveList','','',false);
        }
        $this->jquery->change('#multiple', '$("._form").toggle();');
        $this->jquery->renderView('TodosController/displayList.html', ['list'=>$list]);
    }


	#[Post(path: "todos/add/", name:"todos.add")]
	public function addElement(){
		$post = URequest::post('element');
		$list = USession::get(self::LIST_SESSION_KEY);
		$list[] = $post;
		USession::set(self::LIST_SESSION_KEY, $list);
		$this->displayList($list);
	}


	#[Post(path: "todos/edit/{index}", name:"todos.edit")]
	public function editElement($index){
		$post = URequest::post('element');
		$list = USession::get(self::LIST_SESSION_KEY);
		if(isset($list[$index])){
            $list[$index] = URequest::post('editElement');
            USession::set(self::LIST_SESSION_KEY, $list);
        }
		$this->displayList($list);
	}


	

	#[Get(path: "todos/delete/{index}", name: "todos.delete")]
	public function deleteElement($index){
		$list=USession::get(self::LIST_SESSION_KEY);
        if(isset($list[$index])){
            array_splice($list, $index, 1);
            USession::set(self::LIST_SESSION_KEY, $list);
        }
        $this->displayList($list);
	}

	#[Get(path: "todos/loadList/{uniqid}", name:"todos.loadList")]
	public function loadList($uniqid){
		
	}


	#[Post(path: "todos/loadList/", name:"todosLoadListPost")]
	public function loadListFromForm(){
		
	}


	#[Get(path: "todos/new/{force}", name:"todos.new")]
	public function newList($force=false){
		if($force === false && USession::exists(self::LIST_SESSION_KEY)){
			return $this->showMessage('Nouvelle Liste','Une liste à déjà été crée. Souhaitez vous la vider ?','','',    [['url'=>Router::path('todos.menu'),'caption'=>'Menu','style'=>'basic inverted'], ['url'=>Router::path('todos.new',['nimportequoi']),'caption'=>'Confirmer la création','style'=>'btn-succes']]);
		}
		USession::set(self::LIST_SESSION_KEY,[]);
		$this->displayList([]);
	}


	#[Get(path: "todos/save", name:"todos.save")]
	public function saveList(){
		
	}

}
