<?php


class UsersModel{

	private $db;

	public function __construct(){

		$this->db = new PDO('mysql:host=localhost;'.'dbname=peliculas_db;charset=utf8', 'root', '');

	}

	public function setUser($email,$pwd){
		$query = $this->db->prepare('INSERT INTO users (email,password) VALUES(?,?)');
		$query->execute([$email,$pwd]);
	}

	public function getUser($email){
		$query = $this->db->prepare('SELECT * FROM users WHERE email = ?');
		$query->execute([$email]);
		$user = $query->Fetch(PDO::FETCH_OBJ);
		return $user;
	}
}