@extends('front.layouts.header')

@section('content')
<main>
    <section class="section-9 pt-4">
        <div class="container-fluid px-0"> <!-- Container is fluid to span full width -->
            <div class="row">
                <!-- Cart Items -->
                <div class="col-12 col-md-8">
                    <div class="table-responsive">
                        <table class="table" id="cart">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp
                                @forelse ($cartItems as $item)
                                    <tr data-id="{{ $item['id'] }}">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('uploads/product/' . $item['image']) }}"
                                                    class="img-thumbnail" width="80" height="80">
                                                <h5 class="ml-2">{{ $item['name'] }}</h5>
                                            </div>
                                        </td>
                                        <td class="price">Rp{{ number_format($item['price'], 2) }}</td>
                                        <td>
                                            <div class="input-group quantity-control" style="width: 110px;">
                                                <button class="btn btn-outline-secondary btn-decrease"
                                                    type="button">-</button>
                                                <input type="number" class="form-control text-center quantity-input"
                                                    value="{{ $item['quantity'] }}" min="1"
                                                    max="{{ $item['stock'] ?? 100 }}">
                                                <button class="btn btn-outline-secondary btn-increase"
                                                    type="button">+</button>
                                            </div>
                                        </td>
                                        <td class="total">Rp{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php $grandTotal += $item['price'] * $item['quantity']; @endphp
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No items in cart.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Grand Total:</strong></td>
                                    <td colspan="2" id="grand-total">Rp{{ number_format($grandTotal) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- Checkout Summary -->
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Total Items:</strong> {{ count($cartItems) }}</p>
                            <p><strong>Total Price:</strong> Rp{{ number_format($grandTotal) }}</p>
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100">Proceed to Checkout</a>
                            <a href="{{ url('/') }}" class="btn btn-secondary w-100 mt-2">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartTable = document.getElementById('cart');

        // Event for changing quantity
        cartTable.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-decrease') || e.target.classList.contains('btn-increase')) {
                const row = e.target.closest('tr');
                const quantityInput = row.querySelector('.quantity-input');
                const price = parseFloat(row.querySelector('.price').innerText.replace(/[^0-9.-]+/g, ""));
                const totalCell = row.querySelector('.total');

                let quantity = parseInt(quantityInput.value);

                // Increase/Decrease quantity
                if (e.target.classList.contains('btn-decrease') && quantity > 1) {
                    quantity--;
                } else if (e.target.classList.contains('btn-increase')) {
                    quantity++;
                }

                // Update quantity input value
                quantityInput.value = quantity;
                const newTotal = price * quantity;
                totalCell.innerText = `Rp${newTotal.toLocaleString('id-ID', { minimumFractionDigits: 2 })}`;

                updateGrandTotal();
                updateQuantity(row.dataset.id, quantity);
            }
        });

        // Function to update Grand Total
        function updateGrandTotal() {
            let grandTotal = 0;

            document.querySelectorAll('#cart .total').forEach(function (totalCell) {
                let totalValue = totalCell.innerText.replace(/[^0-9.,-]/g, '');
                totalValue = totalValue.replace(',', '');
                grandTotal += parseFloat(totalValue) || 0;
            });

            document.getElementById('grand-total').innerText = `Rp${grandTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}`;
        }

        // Update quantity in the cart
        function updateQuantity(id, quantity) {
            fetch(`/cart/update/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: quantity })
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Cart updated:', data);
                })
                .catch(error => {
                    console.error('Error updating cart:', error);
                });
        }
    });
</script>

<!-- CSS to hide spinner on input number -->
<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield; /* For Firefox */
    }

    /* Responsive table */
    @media (max-width: 767px) {
        .table th, .table td {
            padding: 10px 5px;
        }
        .quantity-control {
            width: 100%;
        }
        .btn {
            font-size: 14px;
        }
    }
</style>

@endsection
