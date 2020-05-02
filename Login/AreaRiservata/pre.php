<?php

class pre{
  public $id;
  public $nome;
  public $cognome;
  public $ruolo;
  public $classe;
  public $pagine;
  public $copie;
  public $costo;
  public $formato;
  public $orario;
  public $file;
  public $note;

  function __construct($id,$nome,$cognome,$ruolo,$classe,$pagine,$copie,$costo,$formato,$orario,$file,$note) {
      $this->id = $id;
      $this->nome = $nome;
      $this->cognome = $cognome;
      $this->ruolo = $ruolo;
      $this->classe = $classe;
      $this->pagine = $pagine;
      $this->copie = $copie;
      $this->costo = $costo;
      $this->formato = $formato;
      $this->orario = $orario;
      $this->file = $file;
      $this->note = $note;
  }
  function set_note($note) {
    $this->note = $note;
  }
  function get_note() {
    return $this->note;
  }

  function set_file($file) {
    $this->file = $file;
  }
  function get_file() {
    return $this->file;
  }

  function set_id($id) {
    $this->id = $id;
  }
  function get_id() {
    return $this->id;
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

  function set_pagine($pagine) {
    $this->pagine = $pagine;
  }
  function get_pagine() {
    return $this->pagine;
  }

  function set_costo($costo) {
    $this->costo = $costo;
  }
  function get_costo() {
    return $this->costo;
  }

  function set_formato($formato) {
    $this->formato = $formato;
  }
  function get_formato() {
    return $this->formato;
  }

  function set_orario($orario) {
    $this->orario = $orario;
  }
  function get_orario() {
    return $this->orario;
  }

}




?>
