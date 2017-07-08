<?php
/** @package    desafioDitech::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Sala.php");

/**
 * SalaController is the controller class for the Sala object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package desafioDitech::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class SalaController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();
		
		/**
		 * Informe o tipo de permissao
		 */
		$this->RequirePermission(User::$PERMISSION_READ, 
			'Secure.LoginForm', 
			'Login requerido para acessar esta pagina',
			'Permissao de leitura e obrigatoria');
	}

	/**
	 * Displays a list view of Sala objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Sala records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new SalaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('IdSala,Numero,Tamanho,IdAdmin'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$salas = $this->Phreezer->Query('Sala',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $salas->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $salas->TotalResults;
				$output->totalPages = $salas->TotalPages;
				$output->pageSize = $salas->PageSize;
				$output->currentPage = $salas->CurrentPage;
			}
			else
			{
				// return all results
				$salas = $this->Phreezer->Query('Sala',$criteria);
				$output->rows = $salas->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single Sala record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idSala');
			$sala = $this->Phreezer->Get('Sala',$pk);
			$this->RenderJSON($sala, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Sala record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$sala = new Sala($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $sala->IdSala = $this->SafeGetVal($json, 'idSala');

			$sala->Numero = $this->SafeGetVal($json, 'numero');
			$sala->Tamanho = $this->SafeGetVal($json, 'tamanho');
			$sala->IdAdmin = $this->SafeGetVal($json, 'idAdmin');

			$sala->Validate();
			$errors = $sala->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Por Favor, verifique os erros',$errors);
			}
			else
			{
				$sala->Save();
				$this->RenderJSON($sala, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Sala record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('idSala');
			$sala = $this->Phreezer->Get('Sala',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $sala->IdSala = $this->SafeGetVal($json, 'idSala', $sala->IdSala);

			$sala->Numero = $this->SafeGetVal($json, 'numero', $sala->Numero);
			$sala->Tamanho = $this->SafeGetVal($json, 'tamanho', $sala->Tamanho);
			$sala->IdAdmin = $this->SafeGetVal($json, 'idAdmin', $sala->IdAdmin);

			$sala->Validate();
			$errors = $sala->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Por Favor, verifique os erros',$errors);
			}
			else
			{
				$sala->Save();
				$this->RenderJSON($sala, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Sala record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idSala');
			$sala = $this->Phreezer->Get('Sala',$pk);

			$sala->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
