<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ramal_model extends CI_Model

{
  /*receitas
    ########################################## */

  public function buscaTudoRamal($limit, $start, $order_by = 'id_ramal', $pesquisa)
  {
    if ($pesquisa != 'all') {
      $pesquisa = $this->db->escape_str($pesquisa);
      $this->db->like("numero_ramal", $pesquisa);
      $this->db->or_like("nome_ramal", $pesquisa);
      $this->db->or_like("nome_setor", $pesquisa);
    }

    $this->db->select('*');
    $this->db->from('ramal');
    $this->db->join('setor', 'id_setor = setor_id_setor', 'left');
    $this->db->limit($limit, $start);
    $this->db->order_by($order_by);
    return $this->db->get();
  }

  public function buscaRamalId($id_ramal)
  {
    $this->db->select('*');
    $this->db->from('ramal');
    $this->db->join('setor', 'id_setor = setor_id_setor','left');
    $this->db->where('id_ramal', $id_ramal);
    return $this->db->get()->row_array();
  }

  public function salvaRamal($ramal)
  {
    return $this->db->insert("ramal", $ramal);
  }

  public function editarRamal($ramal)
  {
    $where = array('id_ramal' => $ramal['id_ramal']);
    $this->db->where($where);
    return $this->db->update('ramal', $ramal);
  }

  public function deleteRamal($id_ramal)
  {
    return $this->db->delete('ramal', ['id_ramal' => $id_ramal]);
  }

  /*categorias
    ########################################## */
  public function buscaSetores($pesquisa = 'all')
  {
    if ($pesquisa != 'all') {
      $this->db->like("nome_setor", $pesquisa);
    }
    return $this->db->get("setor")->result_array();
  }

  public function buscaSetorId($id_setor)
  {
    return $this->db->get_where("setor", array("id_setor" => $id_setor))->row_array();
  }

  public function salvaSetor($setor)
  {
    return $this->db->insert("setor", $setor);
  }

  public function editarsetor($setor)
  {
    $this->db->where(['id_setor' => $setor['id_setor']]);
    return $this->db->update('setor', $setor);
  }

  public function deleteSetor($id_setor)
  {
    $ramal = ['setor_id_setor' => 0]; 
    $this->db->where(['setor_id_setor' => $id_setor]);
    $this->db->update('ramal', $ramal);

    return $this->db->delete('setor', ['id_setor' => $id_setor]);
  }
}
