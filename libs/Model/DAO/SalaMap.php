<?php
/** @package    Salareuniaodb::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * SalaMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the SalaDAO to the sala datastore.
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
class SalaMap implements IDaoMap, IDaoMap2
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
			self::$FM["IdSala"] = new FieldMap("IdSala","sala","id_sala",true,FM_TYPE_INT,11,null,true,true);
			self::$FM["Numero"] = new FieldMap("Numero","sala","numero",false,FM_TYPE_VARCHAR,100,null,false,false);
			self::$FM["Tamanho"] = new FieldMap("Tamanho","sala","tamanho",false,FM_TYPE_VARCHAR,10,null,false,false);
			self::$FM["IdAdmin"] = new FieldMap("IdAdmin","sala","id_admin",false,FM_TYPE_INT,11,"46",false,true);
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