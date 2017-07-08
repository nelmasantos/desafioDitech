<?php
/** @package    Salareuniaodb::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * SuspensoesMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the SuspensoesDAO to the suspensoes datastore.
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
class SuspensoesMap implements IDaoMap, IDaoMap2
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
			self::$FM["IdSuspensao"] = new FieldMap("IdSuspensao","suspensoes","id_suspensao",true,FM_TYPE_INT,11,null,true,true);
			self::$FM["DataInicio"] = new FieldMap("DataInicio","suspensoes","data_inicio",false,FM_TYPE_DATETIME,null,null,false,true);
			self::$FM["DataFinal"] = new FieldMap("DataFinal","suspensoes","data_final",false,FM_TYPE_DATETIME,null,null,false,true);
			self::$FM["Descricao"] = new FieldMap("Descricao","suspensoes","descricao",false,FM_TYPE_VARCHAR,300,null,false,false);
			self::$FM["Inclusao"] = new FieldMap("Inclusao","suspensoes","inclusao",false,FM_TYPE_DATETIME,null,null,false,true);
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