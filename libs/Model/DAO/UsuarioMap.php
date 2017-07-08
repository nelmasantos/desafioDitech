<?php
/** @package    Salareuniaodb::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * UsuarioMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the UsuarioDAO to the usuario datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Salareuniaodb::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class UsuarioMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["IdUsuario"] = new FieldMap("IdUsuario","usuario","id_usuario",true,FM_TYPE_INT,11,null,true,true);
			self::$FM["Nome"] = new FieldMap("Nome","usuario","nome",false,FM_TYPE_VARCHAR,100,null,false,false);
			self::$FM["Senha"] = new FieldMap("Senha","usuario","senha",false,FM_TYPE_VARCHAR,10,null,false,false);
			self::$FM["Aniversario"] = new FieldMap("Aniversario","usuario","aniversario",false,FM_TYPE_DATE,null,null,false,false);
			self::$FM["DataDeCadastro"] = new FieldMap("DataDeCadastro","usuario","data_de_cadastro",false,FM_TYPE_DATETIME,null,null,false,true);
			self::$FM["Apelido"] = new FieldMap("Apelido","usuario","apelido",false,FM_TYPE_VARCHAR,100,null,false,false);
			self::$FM["Empresa"] = new FieldMap("Empresa","usuario","empresa",false,FM_TYPE_VARCHAR,100,null,false,false);
			self::$FM["Observacoes"] = new FieldMap("Observacoes","usuario","observacoes",false,FM_TYPE_VARCHAR,500,null,false,false);
			self::$FM["Endereco"] = new FieldMap("Endereco","usuario","endereco",false,FM_TYPE_VARCHAR,100,null,false,false);
			self::$FM["Email"] = new FieldMap("Email","usuario","email",false,FM_TYPE_VARCHAR,50,null,false,false);
			self::$FM["Fone"] = new FieldMap("Fone","usuario","fone",false,FM_TYPE_VARCHAR,50,null,false,true);
			self::$FM["Fone1"] = new FieldMap("Fone1","usuario","fone1",false,FM_TYPE_VARCHAR,50,null,false,false);
			self::$FM["Fone2"] = new FieldMap("Fone2","usuario","fone2",false,FM_TYPE_VARCHAR,50,null,false,false);
			self::$FM["Imagem"] = new FieldMap("Imagem","usuario","imagem",false,FM_TYPE_VARCHAR,100,"images/clientes/semfoto.png",false,false);
			self::$FM["IdAdmin"] = new FieldMap("IdAdmin","usuario","id_admin",false,FM_TYPE_INT,11,"46",false,true);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
		}
		return self::$KM;
	}

}

?>