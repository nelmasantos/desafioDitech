<?php
/** @package    Salareuniaodb::Reporter */

/** import supporting libraries */
require_once("verysimple/Phreeze/Reporter.php");

/**
 * This is an example Reporter based on the Agenda object.  The reporter object
 * allows you to run arbitrary queries that return data which may or may not fith within
 * the data access API.  This can include aggregate data or subsets of data.
 *
 * Note that Reporters are read-only and cannot be used for saving data.
 *
 * @package Salareuniaodb::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class AgendaReporter extends Reporter
{

	// the properties in this class must match the columns returned by GetCustomQuery().
	// 'CustomFieldExample' is an example that is not part of the `agenda` table
	public $CustomFieldExample;

	public $IdAgendamento;
	public $IdUsuario;
	public $IdSala;
	public $Data;
	public $Horario;
	public $Situacao;
	public $Valor;
	public $Observacoes;
	public $IdTipoAgendamento;

	/*
	* GetCustomQuery returns a fully formed SQL statement.  The result columns
	* must match with the properties of this reporter object.
	*
	* @see Reporter::GetCustomQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomQuery($criteria)
	{
		$sql = "select
			'custom value here...' as CustomFieldExample
			,`agenda`.`id_agendamento` as IdAgendamento
			,`agenda`.`id_usuario` as IdUsuario
			,`agenda`.`id_sala` as IdSala
			,`agenda`.`data` as Data
			,`agenda`.`horario` as Horario
			,`agenda`.`situacao` as Situacao
			,`agenda`.`valor` as Valor
			,`agenda`.`observacoes` as Observacoes
			,`agenda`.`id_tipo_agendamento` as IdTipoAgendamento
		from `agenda`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();
		$sql .= $criteria->GetOrder();

		return $sql;
	}
	
	/*
	* GetCustomCountQuery returns a fully formed SQL statement that will count
	* the results.  This query must return the correct number of results that
	* GetCustomQuery would, given the same criteria
	*
	* @see Reporter::GetCustomCountQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomCountQuery($criteria)
	{
		$sql = "select count(1) as counter from `agenda`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();

		return $sql;
	}
}

?>