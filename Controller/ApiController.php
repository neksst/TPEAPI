<?php

require_once 'Views/ApiView.php';
require_once 'Models/MoviesModel.php';
require_once 'AuthHelper/AuthApiHelper.php';

class ApiController{


	private $Model;
	private $View;
	private $Data;
	private $Helper;

	public function __construct(){
		$this->Model = new MoviesModel();
		$this->View = new ApiView();
		$this->Data = file_get_contents("php://input");
		$this->Helper = new AuthApiHelper();
	}

	public function getInput(){
		return json_decode($this->Data);
	}

	//Endpoints metodos
	public function getMovies($params = null){
		//Orden del las peliculas
		if(isset($_GET['field']) && !empty($_GET['field'])){//Orden del las peliculas por Campo
			$this->OrderMovies($_GET['field']);
		}elseif(isset($_GET['rate']) && !empty($_GET['rate'])) {//Filtro por calificacion
			$this->filterByRate($_GET['rate']);
		}elseif(isset($_GET['orderByDate']) && !empty($_GET['orderByDate'])){// Orden por un campo (punto 3 tpe)
			$this->OrderMoviesByDate($_GET['orderByDate']);
		}elseif(isset($_GET['page'])){ //Paginacion
			$limit = 10;
			if(isset($_GET['limit']) && !empty($_GET['limit'])){
				$limit = $_GET['limit'];
			}
			$this->pagination($limit,$_GET['page']);

		}
		else{
			$movies = $this->Model->getMovies();
			$this->View->response($movies,200);
		}
		

	}

	public function getMovie($params = null){
		$id = $params[':ID'];		
		if(isset($id) && !empty($id)){
			$movie = $this->Model->getMoviesById($id);
			if($movie){
				$this->View->response($movie,200);
			}
			else{
				$this->View->response("Pelicula no encontrada",404);
			}

		}
	}

	public function AddMovie(){
		if(!$this->Helper->isLoggedIn()){
			$this->View->response("No estas logeado", 401);
			return;
		}
		$body = $this->getInput();

		if(isset($body->Titulo,$body->Fecha,$body->Productor,$body->Descripcion,$body->Calificacion,$body->id_genero_fk)){
			if($body->Calificacion > 0 && $body->Calificacion <= 5){
				$id = $this->Model->AddMovie($body->Titulo,$body->Fecha,$body->Productor,$body->Descripcion,$body->Calificacion,$body->id_genero_fk,null);
			$movie = $this->Model->getMoviesById($id);
			$this->View->response($movie,201);
		}else{
			$this->View->response('Ingrese una Calificacion min 1 max 5',400);
		}
			
		}else{
				$this->View->response('Complete los campos',400);
			}

	}

	public function EditMovie($params = null){
		if(!$this->Helper->isLoggedIn()){
			$this->View->response("No estas logeado", 401);
			return;
		}
		$id = $params[':ID'];
		$body = $this->getInput();
		$movie = $this->Model->getMoviesById($id); //Verifica si existe la pelicula
		if(isset($id) && !empty($id) && $movie){
			if(isset($body->Titulo,$body->Fecha,$body->Productor,$body->Descripcion,$body->Calificacion,$body->id_genero_fk)){
				if($body->Calificacion > 0 && $body->Calificacion <= 5){
					$this->Model->UpdateMovie($body->Titulo,$body->Fecha,$body->Productor,$body->Descripcion,$body->Calificacion,$body->id_genero_fk,null,$id);
					$movie = $this->Model->getMoviesById($id);
					$this->View->response($movie,200);
				}else{
					$this->View->response('Ingrese una Calificacion min 1 max 5',400);
				}
				
			}else{
				$this->View->response('Verifique la entrada',400);
			}
		}else{
			$this->View->response("No se encuentra la Pelicula con el ID $id",404);
		}

	}


	public function DeleteMovie($params = null){
		if(!$this->Helper->isLoggedIn()){
			$this->View->response("No estas logeado", 401);
			return;
		}
		$id = $params[':ID'];
		$movie = $this->Model->getMoviesById($id);
		if ($movie){
			$this->Model->DeleteMovie($movie->ID);
			$this->View->response('Pelicula borrada',200);
		}else{
			$this->View->response("La pelicula con el $id no existe",404);
		}

	}

	public function OrderMoviesByDate($order){
		if($order != 'ASC' && $order != 'DESC'){
			$this->View->response('Ingrese un orden ascendente o descendente',400);
			return;
		}
		if($order == 'ASC'){
			$order = 'ASC';
		}elseif($order == 'DESC'){
			$order = 'DESC';
		}

		$movies = $this->Model->OrderMoviesByDate($order);
		if($movies){
			$this->View->response($movies,200);
		}else{
			$this->View->response('',204);
		}

	}

	public function pagination($limit,$offset){
		$movies = $this->Model->pagination($limit,$offset);
		$total = count($movies);
		if($movies){
			$this->View->response(["Cantidad: $total",$movies],200);
		}else{
			$this->View->response('',204);
		}
	}



	//modularizacion

	//impide la entrada del usuario previniendo una inyeccion SQL
	public function OrderMovies($field){

			switch($field){
				
				case 'Titulo':
					$order = $this->isOrderSet();
					$field = 'Titulo';
					$movies = $this->Model->OrderMovies($field,$order);
					$this->View->response($movies,200);
					break;
				case 'Fecha':
					$order = $this->isOrderSet();
					$field = 'Fecha';
					$movies = $this->Model->OrderMovies($field,$order);
					$this->View->response($movies,200);
					break;
				case 'ID':
					$order = $this->isOrderSet();
					$field = 'ID';
					$movies = $this->Model->OrderMovies($field,$order);
					$this->View->response($movies,200);
					break;
				case 'Descripcion':
					$order = $this->isOrderSet();
					$field = 'Descripcion';
					$movies = $this->Model->OrderMovies($field,$order);
					$this->View->response($movies,200);
					break;
				case 'Calificacion':
					$order = $this->isOrderSet();
					$field = 'Calificacion';
					$movies = $this->Model->OrderMovies($field,$order);
					$this->View->response($movies,200);
					break;
				case 'id_genero_fk':
					$order = $this->isOrderSet();
					$field = 'id_genero_fk';
					$movies = $this->Model->OrderMovies($field,$order);
					$this->View->response($movies,200);
					break;
				case 'Productor':
					$order = $this->isOrderSet();
					$field = 'Productor';
					$movies = $this->Model->OrderMovies($field,$order);
					$this->View->response($movies,200);
					break;	
				case 'Img':
					$order = $this->isOrderSet();
					$field = 'Img';
					$movies = $this->Model->OrderMovies($field,$order);
					$this->View->response($movies,200);
					break;
				default:
					$this->View->response('',204);
					break;
			}		
		
	}


	public function filterByRate($rate){
		$movies = $this->Model->getMoviesByRate($rate);
		if($movies){
			$this->View->response($movies,200);
		}else{
			$this->View->response('',204);
		}
		
	}

	//Verificamos si el parametro de orden esta seteado
	//Por defecto es Descendente
	public function isOrderSet(){
		$order = 'DESC';
			if(isset($_GET['order']) && !empty($_GET['order'])){
				if($_GET['order'] == 'ASC') $order = 'ASC';
		}
		return $order;
	}

}