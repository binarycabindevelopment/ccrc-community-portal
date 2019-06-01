<style type="text/css">
    /**
* The CSS shown here will not be introduced in the Quickstart guide, but shows
* how you can use CSS to style your Element's container.
*/
    .StripeElement {
        background-color: white;
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }

    .card-errors{
        color:#FF0000;
        padding:0px 0px 15px 0px;
    }
</style>
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ config('services.stripe.key') }}');
    var stripeElements = stripe.elements();

    var stripeElementFieldStyle = {
        base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            lineHeight: '24px',
            '::placeholder': {
                color: '#BBBBBB',
            }
        }
    };

    var stripeCardNumber = stripeElements.create('cardNumber', {
        style: stripeElementFieldStyle,
        placeholder: '**** **** **** ****'
    });

    var stripeCardExpiration = stripeElements.create('cardExpiry', {
        style: stripeElementFieldStyle,
        placeholder: 'MM/YY'
    });

    var stripeCCV = stripeElements.create('cardCvc', {
        style: stripeElementFieldStyle,
        placeholder: ''
    });

    stripeCardNumber.mount('#cardNumberElement');
    stripeCardExpiration.mount('#expirationDateElement');
    stripeCCV.mount('#ccvElement');

    var stripeCheckoutForm = document.getElementById('payForm');

    stripeCheckoutForm.addEventListener('submit', function(event) {

        event.preventDefault();

        stripe.createToken(stripeCardNumber).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error
                var errorElement = document.getElementById('cardErrors');
                errorElement.textContent = result.error.message;
                $('button[type=submit], input[type=submit]').removeAttr('disabled');
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });

    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payForm');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>
