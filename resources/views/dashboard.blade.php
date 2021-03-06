@extends('layouts.main')

@section('content')
<div class="jumbotron"></div>

<div class="container dasboard-frotor">
{!! Form::open(['url'=>'/save','method'=>'post', 'class'=>'form-horizontal', 'role'=>'form','id'=>'dashboardForm','name'=>'dashboardForm']) !!}

	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">

				<label for="faucet_id" class="col-sm-4 control-label id-dasboard-frotor-label">Id </label>
				<div class="col-sm-5">
					<div id="faucet_id" class="badge id-dasboard-frotor-div">{!! $faucet->id ? $faucet->id : 'New faucet' !!}</div>
				</div>
				<div class="col-sm-3 tools-btn">
					<div class="btn-group btn-group-xs pull-right" role="group">
						{!! Html::link('/','',['class'=>'btn btn-default glyphicon glyphicon-home','title'=>'Home']) !!}
						{!! Form::button('',['id'=>'btn_reset','class'=>'btn btn-default glyphicon glyphicon-refresh','title'=>'Reset all untils']) !!}
						{!! Form::button('',['id'=>'btn_add','class'=>'btn btn-default glyphicon glyphicon-plus-sign','title'=>'Add faucet']) !!}
						{!! Form::button('',['id'=>'btn_del','class'=>'btn btn-default glyphicon glyphicon-trash','title'=>'Delete faucet']) !!}
					</div>
				</div>

			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>

	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<label for="url" class="col-sm-4 control-label">Url</label>
				<div class="col-sm-8">
					{!! Form::text('url', $faucet->url, ['class'=>'form-control','id'=>'url','placeholder'=>'Url']) !!}
				</div>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>

	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<label for="info" class="col-sm-4 control-label">Description</label>
				<div class="col-sm-8">
					{!! Form::text('info', $faucet->info, ['class'=>'form-control','id'=>'info','placeholder'=>'Description']) !!}
				</div>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>

	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<label for="wait_time" class="col-sm-4 control-label">Priority</label>
				<div class="col-sm-8">
					{!! Form::text('priority', $faucet->priority, ['class'=>'form-control','id'=>'priority','placeholder'=>'Priority']) !!}
				</div>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>

	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<label for="wait_time" class="col-sm-4 control-label">Minutes to wait</label>
				<div class="col-sm-8">
					{!! Form::text('duration', $faucet->duration, ['class'=>'form-control','id'=>'duration','placeholder'=>'Time']) !!}
				</div>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>

	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<label for="wait_time" class="col-sm-4 control-label">Days to ban</label>
				<div class="col-sm-8">
					{!! Form::text('bandays', $faucet->bandays, ['class'=>'form-control','id'=>'bandays','placeholder'=>'Number of days']) !!}
				</div>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>

	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<div class="col-sm-offset-9 col-sm-3">
					<div class="btn-group pull-right" role="group">
						{!! Form::submit( 'Save', ['class'=>'btn btn-default']) !!}
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>


{!! Form::close() !!}
</div>

@stop

@section('js_extra')
<script type="text/javascript">
$(document).ready(function(){

	faucet_id = {!! $faucet->id !!};

	$("#btn_add").click(function(event){
		faucet_id = 0;

		$("#url").val("");
		$("#info").val("");
		$("#duration").val(60);
		$("#priority").val(1);
		$("#faucet_id").html("New faucet");

		$("#url").focus();
	});

	$('#dashboardForm').submit(function(event){
		event.preventDefault();
		postDashboardData($(this).attr('action'));
		return false;
	});

	$("#btn_del").click(function(event){
		affirm( "Confirmation required", "Are you sure you want to delete this faucet?", function(){
			faucet_id = -faucet_id;
			$('#dashboardForm').submit();
		});
	});

	$("#btn_reset").click(function(event){
		$("#dashboardForm").attr("action","{!! url('/') !!}/resetall");
		$('#dashboardForm').submit();
	});




});
</script>
@stop