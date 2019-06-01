@extends('layouts.dashboard.app')

@section('content')

    <div class="p-4 px-3 py-10 bg-grey-lighter flex justify-center flex-1">

        <div class="w-full max-w-lg self-center">

            <h2 class="mb-4">Create an Account</h2>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-4 mb-4">
                {!! Former::open_vertical(route('register'))->method('POST') !!}
                <div class="mb-4">
                    {!! Former::text('first_name','First Name')->required() !!}
                    {!! Former::text('last_name','Last Name')->required() !!}
                    {!! Former::email('email','Email Address')->required() !!}
                    {!! Former::password('password','Password')->required() !!}
                    {!! Former::password('password_confirmation','Confirm Password')->required() !!}
                    {!! Former::checkbox('is_ccrc_manager','')->text('Register as a CCRC Manager')->setAttribute('onclick','updateCCRCManagerDisplay();') !!}
                    <div id="company_name_container">
                        {!! Former::text('company_name','Company Name') !!}
                    </div>
                    @component('components.buttons.submit')
                        Register
                    @endcomponent
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    updateCCRCManagerDisplay();
    function updateCCRCManagerDisplay(){
        let managerCheckbox = document.getElementById('is_ccrc_manager');
        let CCRCManagerContainer = document.getElementById('company_name_container');
        if(managerCheckbox.checked){
            CCRCManagerContainer.style.display = "block";
        }else{
            CCRCManagerContainer.style.display = "none";
        }
    }
</script>
@endsection