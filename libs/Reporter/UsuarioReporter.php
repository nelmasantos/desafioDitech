<?php
/** @package    Salareuniaodb::Reporter */

/** import supporting libraries */
require_once("verysimple/Phreeze/Reporter.php");

/**
 * This is an example Reporter based on the Usuario object.  The reporter object
 * allows you to run arbitrary queries that return data which may or may not fith within
 * the data access API.  This can include aggregate data or subsets of data.
 *
 * Note that Reporters are read-only and cannot be used for saving data.
 *
 * @package Salareuniaodb::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class UsuarioReporter extends Reporter
{

	// the properties in this class must match the columns returned by GetCustomQuery().
	// 'CustomFieldExample' is an example that is not part of the `usuario` table
	public $CustomFieldExample;

	public $IdUsuario;
	public $Nome;
	public $Senha;
	public $Aniversario;
	public $DataDeCadastro;
	public $Apelido;
	public $Empresa;
	public $Observacoes;
	public $Endereco;
	public $Email;
	public $Fone;
	public $Fone1;
	public $Fone2;
	public $Imagem;
	public $IdAdmin;

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
			,`usuario`.`id_usuario` as IdUsuario
			,`usuario`.`nome` as Nome
			,`usuario`.`senha` as Senha
			,`usuario`.`aniversario` as Aniversario
			,`usuario`.`data_de_cadastro` as DataDeCadastro
			,`usuario`.`apelido` as Apelido
			,`usuario`.`empresa` as Empresa
			,`usuario`.`observacoes` as Observacoes
			,`usuario`.`endereco` as Endereco
			,`usuario`.`email` as Email
			,`usuario`.`fone` as Fone
			,`usuario`.`fone1` as Fone1
			,`usuario`.`fone2` as Fone2
			,`usuario`.`imagem` as Imagem
			,`usuario`.`id_admin` as IdAdmin
		from `usuario`";

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
		$sql = "select count(1) as counter from `usuario`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();

		return $sql;
	}
}

?>