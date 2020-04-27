<?php

class pre{
  public $nome;
  public $cognome;
  public $ruolo;
  public $classe;
  public $copie;
  public $costo;
  public $orario;

  function __construct($nome,$cognome,$ruolo,$classe,$copie,$costo,$orario) {
      $this->nome = $nome;
      $this->cognome = $cognome;
      $this->ruolo = $ruolo;
      $this->classe = $classe;
      $this->copie = $copie;
      $this->costo = $costo;
      $this->orario = $orario;
  }


  function set_nome($nome) {
    $this->nome = $nome;
  }
  function get_nome() {
    return $this->nome;
  }

  function set_cognome($cognome) {
    $this->cognome = $cognome;
  }
  function get_cognome() {
    return $this->cognome;
  }

  function set_ruolo($ruolo) {
    $this->ruolo = $ruolo;
  }
  function get_ruolo() {
    return $this->ruolo;
  }

  function set_classe($classe) {
    $this->classe = $classe;
  }
  function get_classe() {
    return $this->classe;
  }

  function set_copie($copie) {
    $this->copie = $copie;
  }
  function get_copie() {
    return $this->copie;
  }

  function set_costo($costo) {
    $this->costo = $costo;
  }
  function get_costo() {
    return $this->costo;
  }
  function set_orario($orario) {
    $this->orario = $orario;
  }
  function get_orario() {
    return $this->orario;
  }

}




?>
