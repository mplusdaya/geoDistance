<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        $('#shipping_addr_form').validate({
            rules: {
                customer_name: {
                    required: true
                },
                customer_mobile_number: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true
                },
                customer_email: {
                    required: true,
                    email: true
                },
                customer_state_id: {
                    required: true
                },
                customer_city_id: {
                    required: true
                },
                customer_pincode: {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                    digits: true
                },
                customer_address: {
                    required: true
                }
            },
            messages: {
                customer_name: {
                    required: "Please enter your full name"
                },
                customer_mobile_number: {
                    required: "Please enter your mobile number",
                    minlength: "Mobile number must be 10 digits",
                    maxlength: "Mobile number must be 10 digits",
                    digits: "Please enter only digits"
                },
                customer_email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                customer_state_id: {
                    required: "Please select your state"
                },
                customer_city_id: {
                    required: "Please select your city"
                },
                customer_pincode: {
                    required: "Please enter your pincode",
                    minlength: "Pincode must be 6 digits",
                    maxlength: "Pincode must be 6 digits",
                    digits: "Please enter only digits"
                },
                customer_address: {
                    required: "Please enter your address"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });
    });
</script>
