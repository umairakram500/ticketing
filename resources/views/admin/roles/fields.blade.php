
    <div class="form-group">
        {{ Form::label('name', 'Role Name *') }}
        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name'])}}
    </div><!--form-group-->
    {{ Form::hidden('slug', null, ['class' => 'form-control', 'id' => 'slug'])}}

    <?php
        $permissions = \App\Models\Roles\Permission::All();
    ?>
    <div class="form-group">
        <b>Permissions</b>
        <ul>
            @forelse($permissions as $permission)
                <?php
                $sel = isset($role_permssions) && in_array($permission->id, $role_permssions) ? 'checked' : '';
                ?>
                <li>
                    <lable><input name="permissions[]" type="checkbox" value="{{ $permission->id }}" {{ $sel }}> {{ $permission->name }}</lable></li>
            @empty
            @endforelse
        </ul>
    </div>
    <div class="form-group mb-0 clearfix">
        {{ Form::submit( 'Save', ['class' => 'btn btn-success btn-block']) }}
    </div><!--form-group-->


    @push('after-js')
    <script>
        $(document).ready(function(){
            $('#name').keyup(function(){
                var name = $(this).val();
                $('#slug').val(toSlug(name));
            })
        })
    </script>
    @endpush


