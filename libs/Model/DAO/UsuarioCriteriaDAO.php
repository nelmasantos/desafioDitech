<?php
/** @package    Salareuniaodb::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Criteria.php");

/**
 * UsuarioCriteria allows custom querying for the Usuario object.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the ModelCriteria class which is extended from this class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @inheritdocs
 * @package Salareuniaodb::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class UsuarioCriteriaDAO extends Criteria
{

	public $IdUsuario_Equals;
	public $IdUsuario_NotEquals;
	public $IdUsuario_IsLike;
	public $IdUsuario_IsNotLike;
	public $IdUsuario_BeginsWith;
	public $IdUsuario_EndsWith;
	public $IdUsuario_GreaterThan;
	public $IdUsuario_GreaterThanOrEqual;
	public $IdUsuario_LessThan;
	public $IdUsuario_LessThanOrEqual;
	public $IdUsuario_In;
	public $IdUsuario_IsNotEmpty;
	public $IdUsuario_IsEmpty;
	public $IdUsuario_BitwiseOr;
	public $IdUsuario_BitwiseAnd;
	public $Nome_Equals;
	public $Nome_NotEquals;
	public $Nome_IsLike;
	public $Nome_IsNotLike;
	public $Nome_BeginsWith;
	public $Nome_EndsWith;
	public $Nome_GreaterThan;
	public $Nome_GreaterThanOrEqual;
	public $Nome_LessThan;
	public $Nome_LessThanOrEqual;
	public $Nome_In;
	public $Nome_IsNotEmpty;
	public $Nome_IsEmpty;
	public $Nome_BitwiseOr;
	public $Nome_BitwiseAnd;
	public $Senha_Equals;
	public $Senha_NotEquals;
	public $Senha_IsLike;
	public $Senha_IsNotLike;
	public $Senha_BeginsWith;
	public $Senha_EndsWith;
	public $Senha_GreaterThan;
	public $Senha_GreaterThanOrEqual;
	public $Senha_LessThan;
	public $Senha_LessThanOrEqual;
	public $Senha_In;
	public $Senha_IsNotEmpty;
	public $Senha_IsEmpty;
	public $Senha_BitwiseOr;
	public $Senha_BitwiseAnd;
	public $Aniversario_Equals;
	public $Aniversario_NotEquals;
	public $Aniversario_IsLike;
	public $Aniversario_IsNotLike;
	public $Aniversario_BeginsWith;
	public $Aniversario_EndsWith;
	public $Aniversario_GreaterThan;
	public $Aniversario_GreaterThanOrEqual;
	public $Aniversario_LessThan;
	public $Aniversario_LessThanOrEqual;
	public $Aniversario_In;
	public $Aniversario_IsNotEmpty;
	public $Aniversario_IsEmpty;
	public $Aniversario_BitwiseOr;
	public $Aniversario_BitwiseAnd;
	public $DataDeCadastro_Equals;
	public $DataDeCadastro_NotEquals;
	public $DataDeCadastro_IsLike;
	public $DataDeCadastro_IsNotLike;
	public $DataDeCadastro_BeginsWith;
	public $DataDeCadastro_EndsWith;
	public $DataDeCadastro_GreaterThan;
	public $DataDeCadastro_GreaterThanOrEqual;
	public $DataDeCadastro_LessThan;
	public $DataDeCadastro_LessThanOrEqual;
	public $DataDeCadastro_In;
	public $DataDeCadastro_IsNotEmpty;
	public $DataDeCadastro_IsEmpty;
	public $DataDeCadastro_BitwiseOr;
	public $DataDeCadastro_BitwiseAnd;
	public $Apelido_Equals;
	public $Apelido_NotEquals;
	public $Apelido_IsLike;
	public $Apelido_IsNotLike;
	public $Apelido_BeginsWith;
	public $Apelido_EndsWith;
	public $Apelido_GreaterThan;
	public $Apelido_GreaterThanOrEqual;
	public $Apelido_LessThan;
	public $Apelido_LessThanOrEqual;
	public $Apelido_In;
	public $Apelido_IsNotEmpty;
	public $Apelido_IsEmpty;
	public $Apelido_BitwiseOr;
	public $Apelido_BitwiseAnd;
	public $Empresa_Equals;
	public $Empresa_NotEquals;
	public $Empresa_IsLike;
	public $Empresa_IsNotLike;
	public $Empresa_BeginsWith;
	public $Empresa_EndsWith;
	public $Empresa_GreaterThan;
	public $Empresa_GreaterThanOrEqual;
	public $Empresa_LessThan;
	public $Empresa_LessThanOrEqual;
	public $Empresa_In;
	public $Empresa_IsNotEmpty;
	public $Empresa_IsEmpty;
	public $Empresa_BitwiseOr;
	public $Empresa_BitwiseAnd;
	public $Observacoes_Equals;
	public $Observacoes_NotEquals;
	public $Observacoes_IsLike;
	public $Observacoes_IsNotLike;
	public $Observacoes_BeginsWith;
	public $Observacoes_EndsWith;
	public $Observacoes_GreaterThan;
	public $Observacoes_GreaterThanOrEqual;
	public $Observacoes_LessThan;
	public $Observacoes_LessThanOrEqual;
	public $Observacoes_In;
	public $Observacoes_IsNotEmpty;
	public $Observacoes_IsEmpty;
	public $Observacoes_BitwiseOr;
	public $Observacoes_BitwiseAnd;
	public $Endereco_Equals;
	public $Endereco_NotEquals;
	public $Endereco_IsLike;
	public $Endereco_IsNotLike;
	public $Endereco_BeginsWith;
	public $Endereco_EndsWith;
	public $Endereco_GreaterThan;
	public $Endereco_GreaterThanOrEqual;
	public $Endereco_LessThan;
	public $Endereco_LessThanOrEqual;
	public $Endereco_In;
	public $Endereco_IsNotEmpty;
	public $Endereco_IsEmpty;
	public $Endereco_BitwiseOr;
	public $Endereco_BitwiseAnd;
	public $Email_Equals;
	public $Email_NotEquals;
	public $Email_IsLike;
	public $Email_IsNotLike;
	public $Email_BeginsWith;
	public $Email_EndsWith;
	public $Email_GreaterThan;
	public $Email_GreaterThanOrEqual;
	public $Email_LessThan;
	public $Email_LessThanOrEqual;
	public $Email_In;
	public $Email_IsNotEmpty;
	public $Email_IsEmpty;
	public $Email_BitwiseOr;
	public $Email_BitwiseAnd;
	public $Fone_Equals;
	public $Fone_NotEquals;
	public $Fone_IsLike;
	public $Fone_IsNotLike;
	public $Fone_BeginsWith;
	public $Fone_EndsWith;
	public $Fone_GreaterThan;
	public $Fone_GreaterThanOrEqual;
	public $Fone_LessThan;
	public $Fone_LessThanOrEqual;
	public $Fone_In;
	public $Fone_IsNotEmpty;
	public $Fone_IsEmpty;
	public $Fone_BitwiseOr;
	public $Fone_BitwiseAnd;
	public $Fone1_Equals;
	public $Fone1_NotEquals;
	public $Fone1_IsLike;
	public $Fone1_IsNotLike;
	public $Fone1_BeginsWith;
	public $Fone1_EndsWith;
	public $Fone1_GreaterThan;
	public $Fone1_GreaterThanOrEqual;
	public $Fone1_LessThan;
	public $Fone1_LessThanOrEqual;
	public $Fone1_In;
	public $Fone1_IsNotEmpty;
	public $Fone1_IsEmpty;
	public $Fone1_BitwiseOr;
	public $Fone1_BitwiseAnd;
	public $Fone2_Equals;
	public $Fone2_NotEquals;
	public $Fone2_IsLike;
	public $Fone2_IsNotLike;
	public $Fone2_BeginsWith;
	public $Fone2_EndsWith;
	public $Fone2_GreaterThan;
	public $Fone2_GreaterThanOrEqual;
	public $Fone2_LessThan;
	public $Fone2_LessThanOrEqual;
	public $Fone2_In;
	public $Fone2_IsNotEmpty;
	public $Fone2_IsEmpty;
	public $Fone2_BitwiseOr;
	public $Fone2_BitwiseAnd;
	public $Imagem_Equals;
	public $Imagem_NotEquals;
	public $Imagem_IsLike;
	public $Imagem_IsNotLike;
	public $Imagem_BeginsWith;
	public $Imagem_EndsWith;
	public $Imagem_GreaterThan;
	public $Imagem_GreaterThanOrEqual;
	public $Imagem_LessThan;
	public $Imagem_LessThanOrEqual;
	public $Imagem_In;
	public $Imagem_IsNotEmpty;
	public $Imagem_IsEmpty;
	public $Imagem_BitwiseOr;
	public $Imagem_BitwiseAnd;
	public $IdAdmin_Equals;
	public $IdAdmin_NotEquals;
	public $IdAdmin_IsLike;
	public $IdAdmin_IsNotLike;
	public $IdAdmin_BeginsWith;
	public $IdAdmin_EndsWith;
	public $IdAdmin_GreaterThan;
	public $IdAdmin_GreaterThanOrEqual;
	public $IdAdmin_LessThan;
	public $IdAdmin_LessThanOrEqual;
	public $IdAdmin_In;
	public $IdAdmin_IsNotEmpty;
	public $IdAdmin_IsEmpty;
	public $IdAdmin_BitwiseOr;
	public $IdAdmin_BitwiseAnd;

}

?>