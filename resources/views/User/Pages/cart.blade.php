@extends('User.Layouts.Master')
@section('title', 'Keranjang Belanja')
@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <section class="w-full pt-20 ">
        <!-- breadcrumb -->
        <div class="container py-4 flex items-center gap-3 ps-6 lg:ps-20 dark:bg-gray-700">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-dark-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Home
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('post-product-detail', $product->id) }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-dark-600 dark:text-gray-400 dark:hover:text-white">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            Postingan product detail
                        </div>
                    </a>
                </li> --}}
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Keranjang</span>
                    </div>
                </li>
            </ol>
        </div>
        <!-- ./breadcrumb -->

        <div class="container px-6 mx-auto mt-6 mb-20 flex justify-center ">
            <div class="flex flex-col w-full lg:w-5/6 md:flex-row justify-between md:gap-4">
                <div class=" md:w-3/6 lg:w-2/3">
                    <div class="flex flex-col gap-4">
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg">
                            <div
                                class="flex items
                                -center justify-between px-6 py-4 border-b dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Keranjang</h3>
                            </div>

                            <div id="pesanan" class="px-6 py-4">
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($product_tersedia as $ps)
                                    <div class="flex items-center content-center justify-between w-full">
                                        <div class="flex items-center w-fit gap-4 h-20">
                                            <div class="flex items-center">
                                                <input id="default-checkbox" type="checkbox" value=""
                                                    name="checkout[]"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <input type="hidden" id="product_id" value="{{ $ps['product_id'] }}">
                                                <input type="hidden" id="product_qty" value="{{ $ps['qty'] }}">
                                                <input type="hidden" id="price_cart" value="{{ $ps['price'] }}">
                                                <input type="hidden" id="qty_cart" value="{{ $ps['qty'] }}">
                                            </div>
                                        </div>
                                        <div class="flex items-center w-5/12 gap-4 h-20">
                                            <a href="{{ route('post-product-detail', $ps['product_id']) }}" target="_blank"
                                                class="flex items-center aspect-square w-20 h-20 shrink-0">
                                                <img class="h-auto w-full max-h-full" src="https://placehold.co/600x400" />
                                            </a>
                                            <a href="{{ route('post-product-detail', $ps['product_id']) }}"
                                                class="hover:underline text-gray-700 dark:text-gray-200">{{ $ps['name'] }}</a>
                                        </div>
                                        <div class="flex flex-col  items-center w-6/12">
                                            <div class="flex items-center justify-between content-center">
                                                <span
                                                    class="text-sm font-semibold text-gray-700 dark:text-gray-200 me-4">Rp.
                                                    {{ number_format($ps['price']) }}</span>
                                                </span>
                                                <div class="relative flex items-center max-w-[8rem] me-4">
                                                    <!-- Decrement Button -->
                                                    <button type="button" id="decrement-button-{{ $i }}"
                                                        data-input-counter-decrement="quantity-input-{{ $i }}"
                                                        class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none"
                                                        onclick="submitformQty(this.form)"
                                                        form="qty-form-{{ $i }}">
                                                        <svg class="w-3 h-3 text-gray-900 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 18 2">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                        </svg>
                                                    </button>

                                                    <!-- Quantity Input -->
                                                    <input type="text" input-qty="quantity-input-{{ $i }}"
                                                        form="qty-form-{{ $i }}" onchange="this.form.submit()"
                                                        name="qty" id = "quantity-input-{{ $i }}"
                                                        data-input-counter data-input-counter-min="1"
                                                        class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        value="{{ $ps['qty'] }}" min="1" required />
                                                    <input type="hidden" name="cart-id" value="{{ $ps['cart_id'] }}"
                                                        form="qty-form-{{ $i }}" />
                                                    <form action="{{ route('user.update.cart.qty') }}" method="post"
                                                        id="qty-form-{{ $i }}" class="hidden">
                                                        @csrf
                                                    </form>

                                                    <!-- Increment Button -->
                                                    <button type="button" id="increment-button-{{ $i }}"
                                                        data-input-counter-increment="quantity-input-{{ $i }}"
                                                        class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none"
                                                        onclick="submitformQty(this.form)"
                                                        form="qty-form-{{ $i }}">
                                                        <svg class="w-3 h-3 text-gray-900 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 18 18">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d=" M9 1v16M1 9h16" />
                                                        </svg>
                                                    </button>
                                                    <script>
                                                        function submitformQty(form) {
                                                            setTimeout(function() {
                                                                form.submit();
                                                            }, 400);
                                                        }
                                                    </script>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                </div> <span
                                                    class="text-sm font-semibold text-gray-700 dark:text-gray-200">Rp.
                                                    {{ number_format($ps['price'] * $ps['qty']) }}</span>
                                                </span>

                                            </div>
                                        </div>
                                        <div class="flex items-center content-center w-fit gap-4 h-20">
                                            <div class="flex items-center">
                                                <form action="{{ route('user.remove.from.cart') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{ $ps['cart_id'] }}">
                                                    <button type="submit" class="text-red-500 hover:text-red-600"><i
                                                            class="fa-solid fa-trash-can"></i></button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg">
                            <div
                                class="flex items
                                -center justify-between px-6 py-4 border-b dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Produk Tidak Tersedia
                                </h3>
                            </div>

                            <div id="pesanan" class="px-6 py-4">
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($product_habis as $ph)
                                    <div class="flex items-center content-center justify-between w-full">
                                        <div class="flex items-center w-5/12 gap-4 h-20">
                                            <a href="{{ route('post-product-detail', $ph['product_id']) }}"
                                                target="_blank"
                                                class="flex items-center aspect-square w-20 h-20 shrink-0">
                                                <img class="h-auto w-full max-h-full"
                                                    src="https://placehold.co/600x400" />
                                            </a>
                                            <a href="{{ route('post-product-detail', $ph['product_id']) }}"
                                                class="hover:underline text-gray-700 dark:text-gray-200">{{ $ph['name'] }}</a>
                                        </div>
                                        <div class="flex flex-col items-end w-6/12">
                                            <div class="flex items-end justify-between">
                                                <span
                                                    class="text-sm font-semibold text-gray-700 dark:text-gray-200 me-4">Rp.
                                                    {{ number_format($ph['price']) }}</span>
                                                </span>

                                            </div>
                                        </div>
                                        <div class="flex items-center content-center w-fit gap-4 h-20">
                                            <div class="flex items-center">
                                                <form action="{{ route('user.remove.from.cart') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{ $ph['cart_id'] }}">
                                                    <button type="submit" class="text-red-500 hover:text-red-600"><i
                                                            class="fa-solid fa-trash-can"></i></button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-3/6 lg:w-1/3">
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg sticky top-24">
                        <div class="px-6 py-4 border-b dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Checkout</h3>
                        </div>
                        <div class="px-6 py-4">
                            <div class="flex items
                                -center justify-between">
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">Total Harga</span>
                                <span id="price" class="text-sm font-semibold text-gray-700 dark:text-gray-200">Rp.
                                    {{ number_format('0') }}</span>
                            </div>
                            <form action="{{ route('checkout') }}" method="post" id="checkout-form">
                                @csrf
                                <button type="button" id="checkout-button"
                                    class="w-full py-2 mt-4 text-sm font-semibold text-white bg-blue-600 dark:bg-blue-500 rounded-lg hover:bg-blue-500 dark:hover:bg-blue-400">Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                function calculateTotal() {
                    let total = 0;
                    $('input[name="checkout[]"]:checked').each(function() {
                        let price = $(this).closest('.flex').find('input#price_cart').val();
                        let qty = $(this).closest('.flex').find('input#qty_cart').val();
                        total += parseInt(price) * parseInt(qty);
                    });
                    $('#price').text('Rp. ' + total.toLocaleString());
                    console.log(total);
                }
                $('input[name="checkout[]"]').change(function() {
                    calculateTotal();
                });
                calculateTotal();

                $('#checkout-button').click(function() {
                    let product_id = [];
                    let product_qty = [];
                    $('input[name="checkout[]"]:checked').each(function() {
                        let id = $(this).closest('.flex').find('input#product_id').val();
                        let qty = $(this).closest('.flex').find('input#product_qty').val();
                        product_id.push(id);
                        product_qty.push(qty);
                    });
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'productId[]',
                        value: product_id
                    }).appendTo('#checkout-form');
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'qty[]',
                        value: product_qty
                    }).appendTo('#checkout-form');
                    $('#checkout-form').submit();
                });


            });
        </script>

    @endsection
