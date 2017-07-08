<?php
/** @package    desafioDitech::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Suspensoes.php");

/**
 * SuspensoesController is the controller class for the Suspensoes object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package desafioDitech::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class SuspensoesController extends AppBaseController
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
	 * Displays a list view of Suspensoes objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Suspensoes records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new SuspensoesCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('IdSuspensao,DataInicio,DataFinal,Descricao,Inclusao'
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

				$suspensoeses = $this->Phreezer->Query('Suspensoes',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $suspensoeses->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $suspensoeses->TotalResults;
				$output->totalPages = $suspensoeses->TotalPages;
				$output->pageSize = $suspensoeses->PageSize;
				$output->currentPage = $suspensoeses->CurrentPage;
			}
			else
			{
				// return all results
				$suspensoeses = $this->Phreezer->Query('Suspensoes',$criteria);
				$output->rows = $suspensoeses->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Suspensoes record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idSuspensao');
			$suspensoes = $this->Phreezer->Get('Suspensoes',$pk);
			$this->RenderJSON($suspensoes, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Suspensoes record and render response as JSON
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

			$suspensoes = new Suspensoes($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $suspensoes->IdSuspensao = $this->SafeGetVal($json, 'idSuspensao');

			$suspensoes->DataInicio = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataInicio')));
			$suspensoes->DataFinal = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataFinal')));
			$suspensoes->Descricao = $this->SafeGetVal($json, 'descricao');
			$suspensoes->Inclusao = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'inclusao')));

			$suspensoes->Validate();
			$errors = $suspensoes->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Por Favor, verifique os erros',$errors);
			}
			else
			{
				$suspensoes->Save();
				$this->RenderJSON($suspensoes, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Suspensoes record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idSuspensao');
			$suspensoes = $this->Phreezer->Get('Suspensoes',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $suspensoes->IdSuspensao = $this->SafeGetVal($json, 'idSuspensao', $suspensoes->IdSuspensao);

			$suspensoes->DataInicio = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataInicio', $suspensoes->DataInicio)));
			$suspensoes->DataFinal = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataFinal', $suspensoes->DataFinal)));
			$suspensoes->Descricao = $this->SafeGetVal($json, 'descricao', $suspensoes->Descricao);
			$suspensoes->Inclusao = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'inclusao', $suspensoes->Inclusao)));

			$suspensoes->Validate();
			$errors = $suspensoes->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Por Favor, verifique os erros',$errors);
			}
			else
			{
				$suspensoes->Save();
				$this->RenderJSON($suspensoes, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Suspensoes record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idSuspensao');
			$suspensoes = $this->Phreezer->Get('Suspensoes',$pk);

			$suspensoes->Delete();

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
