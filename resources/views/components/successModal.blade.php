@if (session()->has('signUp'))
    @include('components.signUpSuccess')
    {{session()->forget('signUp')}}
@elseif(session()->has('registerUserSuccess'))
    @include('components.registerUserSuccess')
    {{session()->forget('registerUserSuccess')}}
@elseif(session()->has('updatePasswordSuccess'))
    @include('components.updatePasswordSuccess')
    {{session()->forget('updatePasswordSuccess')}}
@elseif(session()->has('lendSuccess'))
    @include('components.lendSuccess')
    {{session()->forget('lendSuccess')}}
@elseif (session()->has('studentSignUp'))
    @include('components.studentSignUpSuccess')
    {{session()->forget('studentSignUpSuccess')}}
@elseif(session()->has('studentRegisterUserSuccess'))
    @include('components.studentRegisterUserSuccess')
    {{session()->forget('studentRegisterUserSuccess')}}
@elseif(session()->has('forgetUser'))
    @include('components.forgetUser')
    {{session()->forget('forgetUser')}}
@elseif(session()->has('forgetUserSuccess'))
    @include('components.forgetUserSuccess')
    {{session()->forget('forgetUserSuccess')}}
@endif