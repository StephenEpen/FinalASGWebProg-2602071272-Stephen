@extends('layouts.main')

@section('title', 'Register Payment')

@section('container')
    <div class="container mt-5">
        <h1>@lang('payment.complete')</h1>
        <p>@lang('payment.regis_price') {{ $price }}</p>

        <form id="payment-form" method="POST" action="{{ route('payment.process') }}">
            @csrf
            <div>
                <label for="balance">@lang('payment.enter_balance')</label>
                <input type="number" id="balance" name="balance" required>
            </div>

            <input type="hidden" id="store_balance" name="store_balance" value="0">

            <button type="button" id="pay-button" class="btn btn-primary">@lang('payment.pay_now')</button>
        </form>

        <div id="confirmation-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:white; padding:20px; border:1px solid black;">
            <p>@lang('payment.confirm')</p>
            <button id="confirm-store" class="btn btn-success">@lang('payment.yes')</button>
            <button id="decline-store" class="btn btn-danger">@lang('payment.no')</button>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        <div id="toast-notification" class="toast align-items-center text-bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true" style="display: none;">
            <div class="d-flex">
                <div id="toast-message" class="toast-body"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        const showToast = (message, type) => {
            const toastNotification = document.getElementById('toast-notification');
            const toastMessage = document.getElementById('toast-message');

            toastMessage.innerText = message;
            toastNotification.classList.remove('text-bg-success', 'text-bg-danger', 'text-bg-warning');
            toastNotification.classList.add(`text-bg-${type}`);

            toastNotification.style.display = 'block';
            const toast = new bootstrap.Toast(toastNotification);
            toast.show();
        };

        document.getElementById('pay-button').addEventListener('click', function () {
            const balance = parseFloat(document.getElementById('balance').value) || 0;
            const price = {{ $price }};

            if (balance >= price) {
                if (balance > price) {
                    document.getElementById('confirmation-modal').style.display = 'block';
                } else {
                    document.getElementById('payment-form').submit();
                }
            } else {
                showToast('Your balance is insufficient to complete the registration.', 'danger');
            }
        });

        document.getElementById('confirm-store').addEventListener('click', function () {
            document.getElementById('store_balance').value = 1;
            document.getElementById('confirmation-modal').style.display = 'none';
            document.getElementById('payment-form').submit();
        });

        document.getElementById('decline-store').addEventListener('click', function () {
            document.getElementById('confirmation-modal').style.display = 'none';
            showToast('Payment canceled. Redirecting to login page.', 'warning');
            setTimeout(() => {
                window.location.href = '{{ route("loginPage") }}';
            }, 2000);
        });
    </script>
@endsection
