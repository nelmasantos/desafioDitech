<?php
/** @package Salareuniaodb::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("AgendaMap.php");

/**
 * AgendaDAO provides object-oriented access to the agenda table.  This
 * class is automatically generated by ClassBuilder.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the Model class which is extended from this DAO class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Salareuniaodb::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class AgendaDAO extends Phreezable
{
	/** @var int */
	public $IdAgendamento;

	/** @var int */
	public $IdUsuario;

	/** @var int */
	public $IdSala;

	/** @var date */
	public $Data;

	/** @var string */
	public $Horario;

	/** @var string */
	public $Situacao;

	/** @var float */
	public $Valor;

	/** @var string */
	public $Observacoes;

	/** @var int */
	public $IdTipoAgendamento;



}
?>