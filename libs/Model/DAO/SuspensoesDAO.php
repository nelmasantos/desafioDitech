<?php
/** @package Salareuniaodb::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("SuspensoesMap.php");

/**
 * SuspensoesDAO provides object-oriented access to the suspensoes table.  This
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
class SuspensoesDAO extends Phreezable
{
	/** @var int */
	public $IdSuspensao;

	/** @var date */
	public $DataInicio;

	/** @var date */
	public $DataFinal;

	/** @var string */
	public $Descricao;

	/** @var date */
	public $Inclusao;



}
?>