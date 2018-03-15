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
@endif