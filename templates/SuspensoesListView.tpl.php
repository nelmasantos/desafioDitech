<?php
	$this->assign('title','desafioDitech | Suspensoeses');
	$this->assign('nav','suspensoeses');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/suspensoeses.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> Suspensoeses
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Buscar..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="suspensoesCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdSuspensao">Id Suspensao<% if (page.orderBy == 'IdSuspensao') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DataInicio">Data Inicio<% if (page.orderBy == 'DataInicio') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DataFinal">Data Final<% if (page.orderBy == 'DataFinal') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Descricao">Descricao<% if (page.orderBy == 'Descricao') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Inclusao">Inclusao<% if (page.orderBy == 'Inclusao') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idSuspensao')) %>">
				<td><%= _.escape(item.get('idSuspensao') || '') %></td>
				<td><%if (item.get('dataInicio')) { %><%= _date(app.parseDate(item.get('dataInicio'))).format('MMM D, YYYY h:mm A') %><% } else { %>NULL<% } %></td>
				<td><%if (item.get('dataFinal')) { %><%= _date(app.parseDate(item.get('dataFinal'))).format('MMM D, YYYY h:mm A') %><% } else { %>NULL<% } %></td>
				<td><%= _.escape(item.get('descricao') || '') %></td>
				<td><%if (item.get('inclusao')) { %><%= _date(app.parseDate(item.get('inclusao'))).format('MMM D, YYYY h:mm A') %><% } else { %>NULL<% } %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="suspensoesModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idSuspensaoInputContainer" class="control-group">
					<label class="control-label" for="idSuspensao">Id Suspensao</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idSuspensao"><%= _.escape(item.get('idSuspensao') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dataInicioInputContainer" class="control-group">
					<label class="control-label" for="dataInicio">Data Inicio</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dataInicio" type="text" value="<%= _date(app.parseDate(item.get('dataInicio'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<div class="input-append bootstrap-timepicker-component">
							<input id="dataInicio-time" type="text" class="timepicker-default input-small" value="<%= _date(app.parseDate(item.get('dataInicio'))).format('h:mm A') %>" />
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dataFinalInputContainer" class="control-group">
					<label class="control-label" for="dataFinal">Data Final</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dataFinal" type="text" value="<%= _date(app.parseDate(item.get('dataFinal'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<div class="input-append bootstrap-timepicker-component">
							<input id="dataFinal-time" type="text" class="timepicker-default input-small" value="<%= _date(app.parseDate(item.get('dataFinal'))).format('h:mm A') %>" />
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="descricaoInputContainer" class="control-group">
					<label class="control-label" for="descricao">Descricao</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="descricao" placeholder="Descricao" value="<%= _.escape(item.get('descricao') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="inclusaoInputContainer" class="control-group">
					<label class="control-label" for="inclusao">Inclusao</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="inclusao" type="text" value="<%= _date(app.parseDate(item.get('inclusao'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<div class="input-append bootstrap-timepicker-component">
							<input id="inclusao-time" type="text" class="timepicker-default input-small" value="<%= _date(app.parseDate(item.get('inclusao'))).format('h:mm A') %>" />
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteSuspensoesButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteSuspensoesButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Remover Suspensoes</button>
						<span id="confirmDeleteSuspensoesContainer" class="hide">
							<button id="cancelDeleteSuspensoesButton" class="btn btn-mini">Cancelar</button>
							<button id="confirmDeleteSuspensoesButton" class="btn btn-mini btn-danger">Confirmar</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="suspensoesDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Editar Suspensoes
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="suspensoesModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveSuspensoesButton" class="btn btn-primary">Salvar Altera&ccedil;&otilde;es</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="suspensoesCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newSuspensoesButton" class="btn btn-primary">Adicionar Suspensoes</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
