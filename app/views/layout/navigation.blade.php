<header class="navbar navbar-fixed-top navbar-inverse" role="banner">
	<div class="container">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	    <span class="sr-only">Toggle navigation</span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="#">BimaReports</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			 <?php $userGroup = Sentry::findGroupByName('User'); ?> 
			 <?php $user = Sentry::getUser(); ?>
			@if (Sentry::check() && !$user->inGroup($userGroup))
		    	<li><a class="" href="{{ URL::route('home') }}" >Home</a></li>
		    	<li><a href="{{ URL::route('registrations-get') }}">Registration</a></li>
		    	<li><a href="{{ URL::route('patients-get') }}">Patients</a></li>
		    	<li><a href="{{ URL::route('registrations-get') }}">Doctor</a></li>
		    	<li class="dropdown">
			  		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Billing<span class="caret"></span></a>
				 	<ul class="dropdown-menu">
				 		<li><a href="{{ URL::route('transaction-create-get') }}">Cashier</a></li>
						<li><a class="" href="{{ URL::route('billings-item-get') }}" >Configurations</a></li>
				  	</ul>
				</li>
				
				<?php $adminGroup = Sentry::findGroupByName('Administrator'); ?>
				@if ($user->inGroup($adminGroup))
					<li class="dropdown">
				  		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings<span class="caret"></span></a>
					 	<ul class="dropdown-menu">
					 		<li><a href="{{ URL::route('roles') }}">Roles</a></li>
							<li><a class="" href="{{ URL::route('users') }}" >Users</a></li>
					  	</ul>
					</li>
					<li><a href="{{ URL::route('bimas-get') }}">Bimas</a></li>
				@endif

			@else
				<li><a class="" href="{{ URL::route('home') }}" >Home</a></li>
			@endif
		</ul>

		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
			    @if (!Sentry::check())
				    <li><a href="{{ URL::route('account-log-in') }}">Login</a></li>
				    <li><a href="{{ URL::route('account-register') }}">Register</a></li>
				@else
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $user->first_name }}<span class="glyphicon glyphicon-user pull-right"></span></a>
				    <ul class="dropdown-menu">
					    <li><a href="{{ URL::route('user-update-get', $user->id) }}">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
					    <li class="divider"></li>
					    <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
					    <li class="divider"></li>
					    <li><a class="" href="{{ URL::route('account-log-out') }}" >Logout <span class="glyphicon glyphicon-log-out pull-right"></a></li>
				    </ul>
				@endif
			</li>
		</ul>      
	</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</header>