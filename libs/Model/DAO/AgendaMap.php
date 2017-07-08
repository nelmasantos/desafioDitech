<?php
/** @package    Salareuniaodb::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * AgendaMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the AgendaDAO to the agenda datastore.
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
class AgendaMap implements IDaoMap, IDaoMap2
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
			self::$FM["IdAgendamento"] = new FieldMap("IdAgendamento","agenda","id_agendamento",true,FM_TYPE_INT,11,null,true,true);
			self::$FM["IdUsuario"] = new FieldMap("IdUsuario","agenda","id_usuario",false,FM_TYPE_INT,11,null,false,true);
			self::$FM["IdSala"] = new FieldMap("IdSala","agenda","id_sala",false,FM_TYPE_INT,11,null,false,true);
			self::$FM["Data"] = new FieldMap("Data","agenda","data",false,FM_TYPE_DATE,null,null,false,true);
			self::$FM["Horario"] = new FieldMap("Horario","agenda","horario",false,FM_TYPE_VARCHAR,20,null,false,true);
			self::$FM["Situacao"] = new FieldMap("Situacao","agenda","situacao",false,FM_TYPE_VARCHAR,30,null,false,true);
			self::$FM["Valor"] = new FieldMap("Valor","agenda","valor",false,FM_TYPE_FLOAT,null,null,false,true);
			self::$FM["Observacoes"] = new FieldMap("Observacoes","agenda","observacoes",false,FM_TYPE_VARCHAR,500,null,false,true);
			self::$FM["IdTipoAgendamento"] = new FieldMap("IdTipoAgendamento","agenda","id_tipo_agendamento",false,FM_TYPE_INT,11,null,false,false);
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