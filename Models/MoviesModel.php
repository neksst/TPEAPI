<?php


class MoviesModel{
	private $db;

	public function __construct(){
		$this->db = new PDO('mysql:host=localhost;'.'dbname=peliculas_db;charset=utf8', 'root', '');
	}

	//Consultas

	public function getMovies(){
		$query = $this->db->prepare('SELECT * FROM pelicula');
		$query->execute();
		$movie = $query->FetchAll(PDO::FETCH_OBJ);
		return $movie;
	}

	public function getMoviesById($id){
		$query = $this->db->prepare('SELECT * FROM pelicula where ID = ?');
		$query->execute([$id]);
		$movie = $query->Fetch(PDO::FETCH_OBJ);
		return $movie;
	}
	public function getMoviesByIdJOIN($id){
		$query = $this->db->prepare('SELECT movie.*, genre.Genero FROM pelicula movie INNER JOIN genero genre ON movie.id_genero_fk = genre.ID WHERE movie.ID = ?');
		$query->execute([$id]);
		$movie = $query->Fetch(PDO::FETCH_OBJ);
		return $movie;
	}

	public function getMoviesJOIN(){
		//obtiene 5 peliculas de manera aleatria
		$query = $this->db->prepare('SELECT movie.*, genre.Genero FROM pelicula movie INNER JOIN genero genre ON movie.id_genero_fk = genre.ID ORDER BY RAND() LIMIT 5');
		//SELECT * FROM pelicula ORDER BY RAND() LIMIT 1
		$query->execute();
		$movies = $query->FetchAll(PDO::FETCH_OBJ);
		return $movies;
	}

	public function getMoviesByGenre($id_fk){
		$query = $this->db->prepare('SELECT * FROM pelicula WHERE id_genero_fk = ?');
		$query->execute([$id_fk]);
		$movies = $query->FetchAll(PDO::FETCH_OBJ);
		return $movies;
	}

	public function OrderMovies($field,$order){
		$query = $this->db->prepare("SELECT * FROM pelicula ORDER BY $field $order");
		$query->execute();
		$movies = $query->FetchAll(PDO::FETCH_OBJ);
		return $movies;
	}

	public function OrderMoviesByDate($order){
		$query = $this->db->prepare("SELECT * FROM pelicula ORDER BY Fecha $order");
		$query->execute();
		$movies = $query->FetchAll(PDO::FETCH_OBJ);
		return $movies;
	}

	public function getMoviesByRate($rate){
		$query = $this->db->prepare('SELECT * FROM pelicula WHERE Calificacion = ?');
		$query->execute([$rate]);
		$movies = $query->FetchAll(PDO::FETCH_OBJ);
		return $movies;
	}

	public function pagination($limit,$offset){
		$query = $this->db->prepare('SELECT * FROM pelicula LIMIT :limit OFFSET :offset');
		$query->bindValue(':limit', $limit, PDO::PARAM_INT);
		$query->bindValue(':offset', $offset, PDO::PARAM_INT);
		$query->execute();
		$movies = $query->FetchAll(PDO::FETCH_OBJ);
		return $movies;

	}

	
	 // Alta Baja y modificacion
	  
	 public function AddMovie($Titulo,$Fecha,$Productor,$Descricion,$Calificacion,$Id_genero_fk,$imagen = null){
	 	$pathImg = null;
        if ($imagen)
            $pathImg = $this->uploadImage($imagen);

	 	$query = $this->db->prepare('INSERT INTO  pelicula (Titulo, Fecha, Productor, Descripcion, Calificacion, id_genero_fk,Img) VALUES (?,?,?,?,?,?,?)');
	 	$query->execute([$Titulo,$Fecha,$Productor,$Descricion,$Calificacion,$Id_genero_fk,$pathImg]);
	 	return $this->db->lastInsertId(); 
	 }


	 public function DeleteMovie($id){
	 	$query = $this->db->prepare('DELETE FROM pelicula where ID = ?');
	 	$query->execute([$id]);
	 }

	 public function UpdateMovie($Titulo,$Fecha,$Productor,$Descricion,$Calificacion,$Id_genero_fk,$imagen,$id){
	 	$pathImg = null;
        if ($imagen)
            $pathImg = $this->uploadImage($imagen);

	 	$query = $this->db->prepare('UPDATE pelicula SET Titulo= ? , Fecha = ?, Productor= ? , Descripcion= ?, Calificacion = ?, id_genero_fk= ?,Img=? WHERE ID = ?');
	 	$query->execute([$Titulo,$Fecha,$Productor,$Descricion,$Calificacion,$Id_genero_fk,$pathImg,$id]);

	 	
	 }

	 private function uploadImage($image){
        $target = 'static/img/' . uniqid() . '.jpg';
        move_uploaded_file($image, $target);
        return $target;
    }

}