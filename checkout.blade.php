<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<!------ Include the above in your HEAD tag ---------->
@extends('layouts.front')
@section('title')
    Checkout
@endsection
@section('content')
    <div class="container wrapper">
        <div class="row cart-head">
            <div class="container">
                <div class="row">

                </div>
                <div class="row">
                    <p></p>
                </div>
            </div>
        </div>
        <div class="row cart-body">
            @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <form action="{{ url('place-order') }}" class="form-horizontal" method="POST"
                class="require-validation form-card " data-cc-on-file="false" id="makePaymentForm">
                {{-- {{ csrf_field() }} --}}
                @csrf
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Review Order <div class="pull-right"><small><a class="afix-1" href="cart">Edit
                                        Cart</a></small></div>
                        </div>
                        @if ($cartItems->count() > 0)
                            <div class="panel-body">
                                @php $total = 0; @endphp
                                @forelse ($cartItems as $item)
                                    @if ($item->product)
                                        <div class="form-group">
                                            <div class="col-sm-3 col-xs-3">
                                                <a
                                                    href=" {{ url('collections/' . $item->product->category->slug . '/' . $item->product->slug) }}">
                                                    @if ($item->product->productImages)
                                                        <img src="{{ asset($item->product->productImages[0]->image) }}"
                                                            class="img-fluid rounded-3" alt="{{ $item->product->name }}">
                                                    @else
                                                        <img src="" class="img-fluid rounded-3"
                                                            alt="{{ $item->product->name }}">
                                                    @endif
                                                </a>
                                            </div>

                                            <div class="col-sm-6 col-xs-6">
                                                <a
                                                    href=" {{ url('collections/' . $item->product->category->slug . '/' . $item->product->slug) }}">
                                                    <div class="col-xs-12">{{ $item->product->name }}</div>
                                                </a>
                                                <div class="col-xs-12">
                                                    <small>Quantity:<span>{{ $item->prod_qty }}</span></small>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-3 text-right">
                                                <h6><span>NARIA;</span>{{ $item->product->selling_price }}</h6>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <hr />
                                        </div>
                                        @php $total += $item->product->selling_price * $item->prod_qty ;  @endphp
                                    @endif
                                @empty
                                @endforelse
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <strong>Order Total</strong>
                                        <b>
                                            <div class="pull-right"><span>$</span><span>{{ $total }}</span>
                                            </div>
                                        </b>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <hr />
                                </div>
                                <button type="submit" class="btn btn-primary btn-submit-fix float-end">Place Order</button>
                                <br />


                            </div>
                        @else
                            <div class="card-body">
                                <h5>Nothing was added <i class="fa-solid fa-cart-shopping"></i></h5>
                                <a href="{{ url('/') }}">
                                    <button type="button" class="btn btn-danger btn-block btn-lg">Go back and place
                                        order</button>
                                </a>
                            </div>
                        @endif
                    </div>
                    <!--REVIEW ORDER END-->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading">Address</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Shipping Address</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label hidden for="name">Name</label>
                                    <strong>First Name:</strong>
                                    <input type="text" name="firstname" name="name" required id="name"
                                        placeholder="Enter name" class="form-control firstname"
                                        value="{{ Auth::user()->firstname }}" />
                                </div>
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" required
                                            placeholder="Enter full name">
                                    </div>
                                </div> --}}
                                <div class="span1"></div>
                                <div class="col-md-12">
                                    <strong>Last Name:</strong>
                                    <input type="text" name="lastname" required class="form-control lastname"
                                        value="{{ Auth::user()->lastname }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label hidden for="email">Email</label>
                                <div class="col-md-12"><strong>Email Address:</strong></div>
                                <div class="col-md-12"><input type="email" placeholder="Enter email" required
                                        name="email" id="email" class="form-control email"
                                        value="{{ Auth::user()->email }}" /></div>
                            </div>
                            {{-- <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" required class="form-control" id="email"
                                        placeholder="Enter email">
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <div class="col-md-12"><strong>Country:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control country" required name="country"
                                        value="{{ Auth::user()->country }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Address:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address1" required class="form-control address1"
                                        value="{{ Auth::user()->address1 }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>City:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="city" required class="form-control city"
                                        value="{{ Auth::user()->city }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>State:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="state" required class="form-control state"
                                        value="{{ Auth::user()->state }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Zip / Postal Code:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="zipcode" required class="form-control zipcode"
                                        value="{{ Auth::user()->zipcode }}" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label hidden for="number">Phone Number</label>
                                <div class="col-md-12"><strong>Phone Number:</strong></div>
                                <div class="col-md-12"><input type="number" placeholder="Enter number" required
                                        id="number" name="phone" class="form-control number"
                                        value="{{ Auth::user()->phone }}" /></div>
                            </div>
                            <div class="col-6" hidden>
                                <label for="amount">Amount</label>
                                <input type="number" name="amount" placeholder="Enter amount" id="amount"
                                    class="form-control" value="{{ $total }}">
                            </div>
                            {{-- <div class="col-6">
                                <label for="number">Phone Number</label>
                                <input type="number" name="number" placeholder="Enter number" id="number"
                                    class="form-control">
                            </div> --}}
                        </div>
                    </div>
                </div>

            </form>
            {{-- <a href="{{ url('payout') }}">  <button type="type" class="btn btn-primary btn-submit-fix float-end"> Order</button></a> --}}
        </div>
    </div>
    </a>
    <style>
        .steps {
            margin-top: -41px;
            display: inline-block;
            float: right;
            font-size: 16px
        }

        .step {
            float: left;
            background: white;
            padding: 7px 13px;
            border-radius: 1px;
            text-align: center;
            width: 100px;
            position: relative
        }

        .step_line {
            margin: 0;
            width: 0;
            height: 0;
            border-left: 16px solid #fff;
            border-top: 16px solid transparent;
            border-bottom: 16px solid transparent;
            z-index: 1008;
            position: absolute;
            left: 99px;
            top: 1px
        }

        .step_line.backline {
            border-left: 20px solid #f7f7f7;
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            z-index: 1006;
            position: absolute;
            left: 99px;
            top: -3px
        }

        .step_complete {
            background: #357ebd
        }

        .step_complete a.check-bc,
        .step_complete a.check-bc:hover,
        .afix-1,
        .afix-1:hover {
            color: #eee;
        }

        .step_line.step_complete {
            background: 0;
            border-left: 16px solid #357ebd
        }

        .step_thankyou {
            float: left;
            background: white;
            padding: 7px 13px;
            border-radius: 1px;
            text-align: center;
            width: 100px;
        }

        .step.check_step {
            margin-left: 5px;
        }

        .ch_pp {
            text-decoration: underline;
        }

        .ch_pp.sip {
            margin-left: 10px;
        }

        .check-bc,
        .check-bc:hover {
            color: #222;
        }

        .SuccessField {
            border-color: #458845 !important;
            -webkit-box-shadow: 0 0 7px #9acc9a !important;
            -moz-box-shadow: 0 0 7px #9acc9a !important;
            box-shadow: 0 0 7px #9acc9a !important;
            background: #f9f9f9 url(../images/valid.png) no-repeat 98% center !important
        }

        .btn-xs {
            line-height: 28px;
        }

        /*login form*/
        .login-container {
            margin-top: 30px;
        }

        .login-container input[type=submit] {
            width: 100%;
            display: block;
            margin-bottom: 10px;
            position: relative;
        }

        .login-container input[type=text],
        input[type=password] {
            height: 44px;
            font-size: 16px;
            width: 100%;
            margin-bottom: 10px;
            -webkit-appearance: none;
            background: #fff;
            border: 1px solid #d9d9d9;
            border-top: 1px solid #c0c0c0;
            /* border-radius: 2px; */
            padding: 0 8px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .login-container input[type=text]:hover,
        input[type=password]:hover {
            border: 1px solid #b9b9b9;
            border-top: 1px solid #a0a0a0;
            -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .login-container-submit {
            /* border: 1px solid #3079ed; */
            border: 0px;
            color: #fff;
            text-shadow: 0 1px rgba(0, 0, 0, 0.1);
            background-color: #357ebd;
            /*#4d90fe;*/
            padding: 17px 0px;
            font-family: roboto;
            font-size: 14px;
            /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
        }

        .login-container-submit:hover {
            /* border: 1px solid #2f5bb7; */
            border: 0px;
            text-shadow: 0 1px rgba(0, 0, 0, 0.3);
            background-color: #357ae8;
            /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
        }

        .login-help {
            font-size: 12px;
        }

        .asterix {
            background: #f9f9f9 url(../images/red_asterisk.png) no-repeat 98% center !important;
        }

        /* images*/
        ol,
        ul {
            list-style: none;
        }

        .hand {
            cursor: pointer;
            cursor: pointer;
        }

        .cards {
            padding-left: 0;
        }

        .cards li {
            -webkit-transition: all .2s;
            -moz-transition: all .2s;
            -ms-transition: all .2s;
            -o-transition: all .2s;
            transition: all .2s;
            background-image: url('//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg');
            background-position: 0 0;
            float: left;
            height: 32px;
            margin-right: 8px;
            text-indent: -9999px;
            width: 51px;
        }

        .cards .mastercard {
            background-position: -51px 0;
        }

        .cards li {
            -webkit-transition: all .2s;
            -moz-transition: all .2s;
            -ms-transition: all .2s;
            -o-transition: all .2s;
            transition: all .2s;
            background-image: url('//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg');
            background-position: 0 0;
            float: left;
            height: 32px;
            margin-right: 8px;
            text-indent: -9999px;
            width: 51px;
        }

        .cards .amex {
            background-position: -102px 0;
        }

        .cards li {
            -webkit-transition: all .2s;
            -moz-transition: all .2s;
            -ms-transition: all .2s;
            -o-transition: all .2s;
            transition: all .2s;
            background-image: url('//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg');
            background-position: 0 0;
            float: left;
            height: 32px;
            margin-right: 8px;
            text-indent: -9999px;
            width: 51px;
        }

        .cards li:last-child {
            margin-right: 0;
        }

        /* images end */



        /*
                                                                 * BOOTSTRAP
                                                                 */
        .container {
            border: none;
        }

        .panel-footer {
            background: #fff;
        }

        .btn {
            border-radius: 1px;
        }

        .btn-sm,
        .btn-group-sm>.btn {
            border-radius: 1px;
        }

        .input-sm,
        .form-horizontal .form-group-sm .form-control {
            border-radius: 1px;
        }

        .panel-info {
            border-color: #999;
        }

        .panel-heading {
            border-top-left-radius: 1px;
            border-top-right-radius: 1px;
        }

        .panel {
            border-radius: 1px;
        }

        .panel-info>.panel-heading {
            color: #eee;
            border-color: #999;
        }

        .panel-info>.panel-heading {
            background-image: linear-gradient(to bottom, #555 0px, #888 100%);
        }

        hr {
            border-color: #999 -moz-use-text-color -moz-use-text-color;
        }

        .panel-footer {
            border-bottom-left-radius: 1px;
            border-bottom-right-radius: 1px;
            border-top: 1px solid #999;
        }

        .btn-link {
            color: #888;
        }

        hr {
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .navbar-brand {
            display: none;
        }

        /** MEDIA QUERIES **/
        @media only screen and (max-width: 989px) {
            .span1 {
                margin-bottom: 15px;
                clear: both;
            }
        }

        @media only screen and (max-width: 764px) {
            .inverse-1 {
                float: right;
            }
        }

        @media only screen and (max-width: 586px) {
            .cart-titles {
                display: none;
            }

            .panel {
                margin-bottom: 1px;
            }
        }

        .form-control {
            border-radius: 1px;
        }

        @media only screen and (max-width: 486px) {
            .col-xss-12 {
                width: 100%;
            }

            .cart-img-show {
                display: none;
            }

            .btn-submit-fix {
                width: 100%;
            }

        }

        /*
                                                                @media only screen and (max-width: 777px){
                                                                    .container{
                                                                        overflow-x: hidden;
                                                                    }
                                                                }*/
    </style>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script>
        $(function() {
            $("#makePaymentForm").submit(function(e) {
                e.preventDefault();
                var name = $("#name").val();
                var email = $("#email").val();
                var phone = $("#number").val();
                var amount = $("#amount").val();
                //make our payment
                makePayment(amount, email, phone, name);
            });
        });

        function makePayment(amount, email, phone_number, name) {
            FlutterwaveCheckout({
                public_key: "FLWPUBK_TEST-78fa1a603a6be122aa8a26e2cee1c3d4-X",
                tx_ref: "RX1_{{ substr(rand(0, time()), 0, 7) }}",
                amount,
                currency: "USD",
                country: "US",
                payment_options: " ",
                customer: {
                    email,
                    phone_number,
                    name,
                },
                callback: function(data) {
                    var transaction_id = data.transaction_id;
                    // Make ajax request
                    var _token = $("input[name='_token']").val();
                    //         'payment_mode': "paid with flutterwave",
                    //         'payment_id': transaction_id,
                    //         'tx_ref': _token,
                    //         transaction_id,
                    //         _token
                    //     },
                    // var firstname = $('.firstname').val();
                    // var lastname = $('.lastname').val();
                    // var email = $('.email').val();
                    // var phone = $('.number').val();
                    // var address1 = $('.address1').val();
                    // var city = $('.city').val();
                    // var state = $('.state').val();
                    // var zipcode = $('.zipcode').val();
                    // var country = $('.country').val();

                    $.ajax({
                        method: "POST",
                        url: "/place-order",
                        data: {
                            // 'firstname': firstname,
                            // 'lastname': lastname,
                            // 'email': email,
                            // 'phone': number,
                            // 'address': address1,
                            // 'city': city,
                            // 'state': state,
                            // 'zipcode': zipcode,
                            // 'country': country,
                            'payment_mode': "paid with flutterwave",
                            'payment_id': transaction_id,
                            // 'tx_ref': _token,
                        },
                        success: function(response) {
                            alert(response.status);
                            // window.location.href = "/my-orders";
                            console.log(data);

                        }

                    });
                },
                onclose: function() {
                    // close modal
                },
                customizations: {
                    title: "My store",
                    description: "Payment for items in cart",
                    logo: "https://s3-us-west-2.amazonaws.com/hp-cdn-01/uploads/orgs/flutterwave_logo.jpg?69",
                },
            });
        }
    </script>
@endsection
