<form action="{{ route('projects.store') }}" method=POST class="form">
	{{ csrf_field() }}

	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<label for="name" class="control-label">Name</label>
		<input 
			id="name" 
			name="name" 
			type="text" 
			class="form-control" 
			value="{{ old('name') }}" 
			required 
			autofocus
		>

		@if ($errors->has('name'))
			<span class="help-block">
				<strong>{{ $errors->first('name') }}</strong>
			</span>
		@endif
	</div>

	<div class="form-group">
		<button class="btn btn-primary" type="submit">
			Create project
		</button>
	</div>
</form>