@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-frontend.card>
                <x-slot name="header">
                    @lang('Dashboard')
                </x-slot>

                <x-slot name="body">
                    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
                    <div class="container padding-bottom-3x mb-1">
                        <!-- Alert-->
                        <div class="alert alert-info alert-dismissible fade show text-center" style="margin-bottom: 30px;"><span class="alert-close" data-dismiss="alert"></span><img class="d-inline align-center" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIuMDAzIDUxMi4wMDMiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMi4wMDMgNTEyLjAwMzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSIxNnB4IiBoZWlnaHQ9IjE2cHgiPgo8Zz4KCTxnPgoJCTxnPgoJCQk8cGF0aCBkPSJNMjU2LjAwMSw2NGMtNzAuNTkyLDAtMTI4LDU3LjQwOC0xMjgsMTI4czU3LjQwOCwxMjgsMTI4LDEyOHMxMjgtNTcuNDA4LDEyOC0xMjhTMzI2LjU5Myw2NCwyNTYuMDAxLDY0eiAgICAgIE0yNTYuMDAxLDI5OC42NjdjLTU4LjgxNiwwLTEwNi42NjctNDcuODUxLTEwNi42NjctMTA2LjY2N1MxOTcuMTg1LDg1LjMzMywyNTYuMDAxLDg1LjMzM1MzNjIuNjY4LDEzMy4xODQsMzYyLjY2OCwxOTIgICAgIFMzMTQuODE3LDI5OC42NjcsMjU2LjAwMSwyOTguNjY3eiIgZmlsbD0iIzUwYzZlOSIvPgoJCQk8cGF0aCBkPSJNMzg1LjY0NCwzMzMuMjA1YzM4LjIyOS0zNS4xMzYsNjIuMzU3LTg1LjMzMyw2Mi4zNTctMTQxLjIwNWMwLTEwNS44NTYtODYuMTIzLTE5Mi0xOTItMTkycy0xOTIsODYuMTQ0LTE5MiwxOTIgICAgIGMwLDU1Ljg1MSwyNC4xMjgsMTA2LjA2OSw2Mi4zMzYsMTQxLjE4NEw2NC42ODQsNDk3LjZjLTEuNTM2LDQuMTE3LTAuNDA1LDguNzI1LDIuODM3LDExLjY2OSAgICAgYzIuMDI3LDEuNzkyLDQuNTY1LDIuNzMxLDcuMTQ3LDIuNzMxYzEuNjIxLDAsMy4yNDMtMC4zNjMsNC43NzktMS4xMDlsNzkuNzg3LTM5Ljg5M2w1OC44NTksMzkuMjMyICAgICBjMi42ODgsMS43OTIsNi4xMDEsMi4yNCw5LjE5NSwxLjI4YzMuMDkzLTEuMDAzLDUuNTY4LTMuMzQ5LDYuNjk5LTYuNGwyMy4yOTYtNjIuMTQ0bDIwLjU4Nyw2MS43MzkgICAgIGMxLjA2NywzLjE1NywzLjU0MSw1LjYzMiw2LjY3Nyw2LjcyYzMuMTM2LDEuMDY3LDYuNTkyLDAuNjQsOS4zNjUtMS4yMTZsNTguODU5LTM5LjIzMmw3OS43ODcsMzkuODkzICAgICBjMS41MzYsMC43NjgsMy4xNTcsMS4xMzEsNC43NzksMS4xMzFjMi41ODEsMCw1LjEyLTAuOTM5LDcuMTI1LTIuNzUyYzMuMjY0LTIuOTIzLDQuMzczLTcuNTUyLDIuODM3LTExLjY2OUwzODUuNjQ0LDMzMy4yMDV6ICAgICAgTTI0Ni4wMTcsNDEyLjI2N2wtMjcuMjg1LDcyLjc0N2wtNTIuODIxLTM1LjJjLTMuMi0yLjExMi03LjMxNy0yLjM4OS0xMC42ODgtMC42NjFMOTQuMTg4LDQ3OS42OGw0OS41NzktMTMyLjIyNCAgICAgYzI2Ljg1OSwxOS40MzUsNTguNzk1LDMyLjIxMyw5My41NDcsMzUuNjA1TDI0Ni43LDQxMS4yQzI0Ni40ODcsNDExLjU2MywyNDYuMTY3LDQxMS44NCwyNDYuMDE3LDQxMi4yNjd6IE0yNTYuMDAxLDM2Mi42NjcgICAgIEMxNjEuOSwzNjIuNjY3LDg1LjMzNSwyODYuMTAxLDg1LjMzNSwxOTJTMTYxLjksMjEuMzMzLDI1Ni4wMDEsMjEuMzMzUzQyNi42NjgsOTcuODk5LDQyNi42NjgsMTkyICAgICBTMzUwLjEwMywzNjIuNjY3LDI1Ni4wMDEsMzYyLjY2N3ogTTM1Ni43NTksNDQ5LjEzMWMtMy40MTMtMS43MjgtNy41MDktMS40NzItMTAuNjg4LDAuNjYxbC01Mi4zNzMsMzQuOTIzbC0zMy42NDMtMTAwLjkyOCAgICAgYzQwLjM0MS0wLjg1Myw3Ny41ODktMTQuMTg3LDEwOC4xNi0zNi4zMzFsNDkuNTc5LDEzMi4yMDNMMzU2Ljc1OSw0NDkuMTMxeiIgZmlsbD0iIzUwYzZlOSIvPgoJCTwvZz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" width="18" height="18" alt="Medal icon">&nbsp;&nbsp;With this purchase you will earn <strong>290</strong> Reward Points.</div>
                        <!-- Shopping Cart-->
                        <div class="table-responsive shopping-cart">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Per head amount</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">
                                    
                                        <a class="remove-cart" href="{{ route('frontend.auth.removeitem', Auth::user()->id) }}" data-toggle="tooltip" title="" data-original-title="Clear user Cart" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this row?')) document.getElementById('remove-user-{{ Auth::user()->id}}').submit();">
                                        Clear Cart
                                            </a>
                                            <form id="remove-user-{{ Auth::user()->id }}" action="{{ route('frontend.auth.removecart',  Auth::user()->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                    
                                    </th>
                                    </tr>
                                </thead>

                                <tbody>
                                @php
                              
                               
                                if(!empty($userCart)){
                                  $total = 0;
                                @endphp       
                                @foreach($userCart as $cart)
                                @php
                                 
                                 foreach($userProduct as $productInfo){
                                       if($cart->product_id == $productInfo->id){
                                                $instock = $productInfo->inStock;
                                                $amount = $cart->quantity * $productInfo->price;
                                                $image = $productInfo->image;
                                                $proname = $productInfo->name;
                                                $total+= $amount;
                                           
                                  
                                @endphp
                                    <tr>
                                        <td>
                                            <div class="product-item">
                                                <a class="product-thumb" href="#"><img src="{{asset('storage/images/'.$image)}}" width="140px" alt="Product"></a>
                                                <div class="product-info">
                                                    <h4 class="product-title"><a href="#">{{$proname}}</a></h4>
                                                    <span><em>Size:</em> 10.5</span>
                                                    <span><em>Color:</em> Dark Blue</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="count-input d-flex">
                                                <span class="sub btn" id="sub-{{$cart->id}}">-</span>
                                                <input type="number" readonly id="quantity-{{$cart->id}}" class="form-control  text-center" min="0" max="{{$instock}}" value="{{$cart->quantity}}">
                                                <span class="add btn" id="add-{{$cart->id}}">+</span>
                                            </div>
                                        </td>
                                        <td class="perhead-{{$cart->id}}">{{$productInfo->price}}</td>
                                        <td class="text-center text-lg text-medium" id="amount-{{$cart->id}}">{{$amount}}</td>
                                        <td class="text-center">
                                            <a class="remove-from-cart" href="{{ route('frontend.auth.removeitem', $cart->id) }}" data-toggle="tooltip" title="" data-original-title="Remove item" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this row?')) document.getElementById('delete-form-{{$cart->id}}').submit();">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="delete-form-{{ $cart->id }}" action="{{ route('frontend.auth.removeitem', $cart->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="cart-id" value="{{$cart->id}}">
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                    }
                                }
                               @endphp
                                @endforeach
                                @php
                                    }
                               @endphp
                                @if (empty($userCart))
                                    <tr>
                                        <td colspan="12">
                                            <p class="text-center">Please Add Product To Your Cart</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                            </table>

                        </div>
                        <div class="shopping-cart-footer row">
                            <!-- <div class="col-12">
                                <div class="column text-right">Subtotal: 
                            </div> -->
                            <div class="col-4">

                                <a class="btn btn-outline-secondary" href="{{route('frontend.index')}}"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a>

                            </div>
                            <div class="col-8">
                                <div class="column text-right">&nbsp; &nbsp;<a class="btn btn-warning" href="{{ route('frontend.auth.placeorder') }}" data-toggle="tooltip" title="" data-original-title="Place Order" onclick="event.preventDefault(); if (confirm('Are you sure you want to Place Order?')) document.getElementById('checkout').submit();">Checkout Process Order By {{count($userCart)}} Items of Rs <span class="text-medium" id="total">{{$total}}</span>.</a></div>
                                <form id="checkout" action="{{ route('frontend.auth.placeorder') }}" method="POST" style="display: none;">
                                                @csrf
                                  </form>
                            </div>
                        </div>
                    </div>
                </x-slot>
            </x-frontend.card>
        </div><!--col-md-10-->
    </div><!--row-->
</div><!--container-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $(".add").click(function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var cartid = $(this).attr('id');
    
            cartid = cartid.split('-');
            var max = $('#quantity-'+cartid[1]).attr('max'); 

            var qu = $('#quantity-'+cartid[1]).val();
            var prqu=$('.perhead-'+cartid[1]).text();
            qu = qu * 1 + 1;
            var prqu = prqu * 1;
            var subtotal =prqu * qu;
            if (max >= qu) {
                $('#quantity-'+cartid[1]).val(qu);
                $data = {
                    "quantity": qu,
                    "subtotal":subtotal,
                    "perhead":prqu,
                    'id': cartid[1],
                    'type':"add",
                    _token: csrfToken
                };
                updateCart($data, "patch");
            }


        });
        $(".sub").click(function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var cartid = $(this).attr('id');
            cartid = cartid.split('-');
            var min = $('#quantity-'+cartid[1]).attr('min');
           
            var qu = $('#quantity-'+cartid[1]).val();
            var prqu=$('.perhead-'+cartid[1]).text();
            qu = qu * 1 - 1;
            var prqu = prqu * 1;
            var subtotal = prqu * qu;
            alert(cartid);
            if (min < qu) {
                $('#quantity-'+cartid[1]).val(qu);
                var data = {
                    "quantity": qu,
                    "subtotal":subtotal,
                    "perhead":prqu,
                    'id': cartid[1],
                    'type':"sub",
                    _token: csrfToken
                };
                updateCart(data, "patch");
            }
        });

        function updateCart(data = [], $method) {
            $.ajax({
                type: $method,
                url: "{{route('frontend.auth.updatecart')}}",
                data: data,
                success: function(result) {
                    var data = JSON.parse(result);
                    console.log(data);
                    $('#amount-' + data['id']).text(data['total']);
                    var total= $('#total').text()*1;
                    var diff = 0;
                    if(data['type']=="add"){
                        diff =data['perhead']*1;  
                        total+= diff;
                    }else{
                        diff = data['perhead']*1;                   
                        total= total - diff;
                    }

                    $('#total').text(total);
                }
            });
        }
    });
</script>
@endsection