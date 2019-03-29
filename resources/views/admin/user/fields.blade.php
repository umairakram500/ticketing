<div class="row gutter">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::label('name', 'Name *') }}
                </div>
                <div class="col-sm-6 text-right">
                    @lang('urdu.name')
                </div>
            </div>

            {{ Form::text('name', null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::label('email', 'Email *') }}
                </div>
                <div class="col-sm-6 text-right">
                    @lang('urdu.email')
                </div>
            </div>

            {{ Form::text('email', null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
</div>

<div class="row gutter">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::label('phone', 'Phone *') }}
                </div>
                <div class="col-sm-6 text-right">
                    @lang('urdu.phone')
                </div>
            </div>

            {{ Form::text('phone', null, ['class' => 'form-control', 'data-phone', 'placeholder' => '03xx-xxxxxx'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::label('cnic', 'CNIC') }}
                </div>
                <div class="col-sm-6 text-right">
                    @lang('urdu.cnic')
                </div>
            </div>

            {{ Form::text('cnic', null, ['class' => 'form-control', 'data-cnic', 'placeholder' => 'XXXX-XXXXXX-X'])}}
        </div><!--form-group-->
    </div>
</div>

<div class="row gutter">
    <div class="col-md-6">
        <div class="form-group">

            {{ Form::label('city_id', 'City *') }}
            <label class="text-right">@lang('urdu.city')</label>
            <?php $cities = \App\Models\City::Selection('name'); ?>
            {{ Form::select('city_id', $cities, null, ['class' => 'form-control', 'data-phone', 'placeholder' => '- Select City -'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::label('terminal_id', 'Terminal*') }}
                </div>
                <div class="col-sm-6 text-right">
                    @lang('urdu.terminal')
                </div>
            </div>
            <?php $termials = \App\Models\Terminal::Selection() ?>
            {{ Form::select('terminal_id', $termials, null, ['class' => 'form-control', 'data-cnic', 'placeholder' => '- Select Terminal -'])}}
        </div><!--form-group-->
    </div>
</div>


<div class="row gutter">

    <div class="col-sm-6">
        <?php $roles = \App\Models\Roles\Role::Selection('name', 'id'); ?>
        {{ Form::label('role', 'Role *') }}
        {{Form::select('role_id', $roles, null, ['class' => 'form-control', 'id' =>'roleid'])}}
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {{Form::label('Avatar', 'Upload Profile Picture')}}
            {{Form::file('avatar', ['class' => 'btn'])}}
        </div>
    </div>

</div>


@if(!isset($user))
    <div class="row gutter">
        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::label('password', 'Password *') }}
                    </div>
                    <div class="col-sm-6 text-right">
                        @lang('urdu.password')
                    </div>
                </div>

                {{ Form::password('password', ['class' => 'form-control'])}}
                <small class="text-muted">Minimum 6 charters</small>
            </div><!--form-group-->
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::label('repass', 'Repeat Password *') }}
                    </div>
                    <div class="col-sm-6 text-right">
                        @lang('urdu.repeat') @lang('urdu.password')
                    </div>
                </div>

                {{ Form::password('repass', ['class' => 'form-control', 'type' =>'password'])}}
            </div><!--form-group-->
        </div>
    </div>
@endif

<div class="row gutter">

    <div class="col-sm-6">
        <?php
        $routes = \App\Models\Route\Route::all();
        $user_routes = isset($user) ? $user->routes->pluck('id')->toArray() : array();
        ?>

        <label class="form-group mb-2"><b>Route</b></label>
        @forelse($routes as $route)
            <?php $checked = isset($user) && in_array($route->id, $user_routes) ? 'checked' : '' ?>
            <div class="form-group mb-1">
                <input name="routes[]" value="{{ $route->id }}" type="checkbox" id="route-{{ $route->id }}" {{ $checked }}>
                <label for="route-{{ $route->id }}">{{ $route->title }}</label>
            </div>
        @empty
        @endforelse
        <?php //dd($routes->toArray()) ?>
    </div>

</div>



<div class="row gutter mt-5">
    <div class="col-md-6">
        <div class="form-group mb-0">

            <button type="submit" class="btn btn-success btn-lg btn-block">
                Save &nbsp;
                @lang('urdu.save')
            </button>

        </div><!--form-group-->
    </div>
    <div class="col-md-6">
        <div class="form-group mb-0">
            <a href="{{ route('admin.users.index') }}" class="btn btn-lg btn-block btn-primary">
                Cancel  &nbsp;
                @lang('urdu.cancel')
            </a>
        </div><!--form-group-->
    </div>

</div>











