@extends('layout', ['title'=> 'Home'])

@section('page-content')
<div style="width:80%; margin:auto;">
    <br>
    <br>
    <br>
    <br>
    <h1>Your order amount is ৳{{$total}}</h1><br>
    <h2 style="color:#FB5849">Choose a payment method</h2><br>
    <input ng-model="myVar" type="radio" id="cod" name="cod" value="cod" checked>
    <label for="cod"><img style="max-width:150px;" src="{{ asset('assets/images/cod.png')}}"></label><br>

    <div ng-switch="myVar">
        @if (Auth::check())
            <div ng-switch-when="cod">
             
                <form style="display:inline"  method="post" action="{{route('mails.shipped', $total)}}">
                @csrf
                    <input class="btn btn-success" type="submit" value="Place Order">
                </form>
            </div>
        @else
            <div ng-switch-when="cod">
               
            </div>
        @endif
    </div>
</form>
</div>
@endsection
