{{-- See snipeit_modals.js for what powers this --}}

<script nonce="{{ csrf_token() }}">
    window.setTimeout(function () {
        $('#modal-genPassword').pGenerator({
            'bind': 'click',
            'passwordElement': '#modal-password',
            'displayElement': '#modal-generated-password',
            'passwordLength': 16,
            'uppercase': true,
            'lowercase': true,
            'numbers': true,
            'specialChars': true,
            'onPasswordGenerated': function (generatedPassword) {
                $('#modal-password_confirmation').val($('#modal-password').val());
            }
        });
    }, 1000);
</script>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title">{{ trans('admin/users/table.createuser') }}</h2>
        </div>
        <div class="modal-body" style="width:100%; display:block;">
            <form action="{{ route('api.users.store') }}" onsubmit="return false">
                <div class="alert alert-danger" id="modal_error_msg" style="display:none">
                </div>

                @if ($user->company)
                    <input type="hidden" name="company_id" id='modal-company' value='{{ $user->company->id }}' class="form-control">
                @endif

                <div class="dynamic-form-row">
                    @include ('partials.forms.edit.company-select', ['translated_name' => trans('general.company'), 'fieldname' => 'company_id'])
                </div>

                <div class="dynamic-form-row">
                    @include ('partials.forms.edit.location-profile-select', ['translated_name' => trans('general.location'), 'fieldname' => 'location_id'])
                </div>

                <div class="dynamic-form-row">
                    @include('partials.forms.edit.name-first', ['value' => '', 'required' => 'true', 'class' => 'col-md-8 col-xs-12-pull', 'style' => 'width:67%;'])
                </div>

                <div class="dynamic-form-row">
                    @include('partials.forms.edit.name-last', ['value' => '', 'required' => 'true', 'class' => 'col-md-8 col-xs-12-pull', 'style' => 'width:67%;'])
                </div>

                <div class="dynamic-form-row">
                    @include('partials.forms.edit.email')
                </div>

                <div class="dynamic-form-row">
                    @include('partials.forms.edit.username', [ 'required' => 'true'])
                </div>

                {{-- Custom Fields --}}
                <div class="dynamic-form-row">
                    <div class="form-group col-md-8 col-xs-12">
                        <label for="owner_type">Owner Type</label>
                        <select name="owner_type" id="modal-owner_type" class="form-control">
                            <option value="">Select Type</option>
                            <option value="student" {{ (old('owner_type', $item->owner_type ?? '') == 'student') ? 'selected' : '' }}>Student</option>
                            <option value="staff" {{ (old('owner_type', $item->owner_type ?? '') == 'staff') ? 'selected' : '' }}>Staff</option>
                            <option value="group" {{ (old('owner_type', $item->owner_type ?? '') == 'group') ? 'selected' : '' }}>Group</option>
                        </select>
                    </div>
                </div>

                <div class="dynamic-form-row">
                    <div class="form-group col-md-8 col-xs-12">
                        <label for="identifier">Identifier (Student ID)</label>
                        <input type="text" name="identifier" id="modal-identifier" class="form-control" value="{{ old('identifier', $item->identifier ?? '') }}">
                    </div>
                </div>

                <div class="dynamic-form-row">
                    <div class="form-group col-md-8 col-xs-12">
                        <label for="grade_level">Grade Level</label>
                        <input type="text" name="grade_level" id="modal-grade_level" class="form-control" value="{{ old('grade_level', $item->grade_level ?? '') }}">
                    </div>
                </div>

                <div class="dynamic-form-row">
                    <div class="form-group col-md-8 col-xs-12">
                        <label for="homeroom">Homeroom</label>
                        <input type="text" name="homeroom" id="modal-homeroom" class="form-control" value="{{ old('homeroom', $item->homeroom ?? '') }}">
                    </div>
                </div>

                <div class="dynamic-form-row">
                    <div class="form-group col-md-8 col-xs-12">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" id="modal-dob" class="form-control" value="{{ old('dob', $item->dob ?? '') }}">
                    </div>
                </div>

                <div class="dynamic-form-row">
                    <div class="form-group col-md-8 col-xs-12">
                        <label for="building">Building</label>
                        <input type="text" name="building" id="modal-building" class="form-control" value="{{ old('building', $item->building ?? '') }}">
                    </div>
                </div>
                {{-- End Custom Fields --}}

                <div class="dynamic-form-row">
                    <div class="form-group">
                        <div class="col-md-3 col-xs-12">
                            <label class="control-label" for="modal-password">{{ trans('admin/users/table.password') }}:</label>
                        </div>
                        <div class="col-md-8 col-xs-12 " style="margin-bottom:5px;">
                            <input type='password' name="password" id='modal-password' class="form-control" required>
                            <a href="#" class="left" id="modal-genPassword">Generate</a>
                            <div id="modal-generated-password"></div>
                        </div>
                    </div>
                </div>

                <div class="dynamic-form-row">
                    <div class="form-group">
                        <div class="col-md-3 col-xs-12 ">
                            <label class="control-label" for="modal-password_confirmation">{{ trans('admin/users/table.password_confirm') }}:</label>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <input class="form-control" type='password' name="password_confirmation" id='modal-password_confirmation' required>
                        </div>
                    </div>
                </div>

                <div class="dynamic-form-row">
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-8 col-xs-12">
                            <label class="form-control">
                                <input type="checkbox" value="1" name="activated" id="modal-activated" {{ (old('activated', $user->activated)) == '1' ? ' checked="checked"' : '' }} aria-label="activated">
                                {{ trans('general.login_enabled') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="dynamic-form-row">
                    @include('modals.partials.footer')
                </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
    $(document).ready(function(){
        $('#modal-first_name').focus();
    });
</script>
