<?php

class stampa{
  public $id;
  public $copie;
  public $pagine;
  public $tipo;
  public $costo;
  public $richiedente;
  public $operatore;
  public $data;

  function __construct($id,$copie,$pagine,$tipo,$costo,$richiedente,$operatore,$data){
    $this->id = $id;
    $this->copie = $copie;
    $this->pagine = $pagine;
    $this->tipo = $tipo;
    $this->costo = $costo;
    $this->richiedente = $richiedente;
    $this->operatore = $operatore;
    $this->data = $data;
  }

  function get_id() {
    return $this->id;
  }

  function get_copie() {
    return $this->copie;
  }

  function get_pagine() {
    return $this->pagine;
  }

  function get_tipo() {
    return $this->tipo;
  }

  function get_costo() {
    return $this->costo;
  }

  function get_richiedente() {
    return $this->richiedente;
  }

  function get_operatore() {
    return $this->operatore;
  }

  function get_data() {
    return $this->data;
  }
}

 ?>
