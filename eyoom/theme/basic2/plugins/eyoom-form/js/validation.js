var Validation = function () {

    return {

        initValidation: function () {
	        $("#validation-form-ex").validate({
	            // Rules for form validation
	            rules:
	            {
	                required:
	                {
	                    required: true
	                },
	                email:
	                {
	                    required: true,
	                    email: true
	                },
	                url:
	                {
	                    required: true,
	                    url: true
	                },
	                date:
	                {
	                    required: true,
	                    date: true
	                },
	                min:
	                {
	                    required: true,
	                    minlength: 5
	                },
	                max:
	                {
	                    required: true,
	                    maxlength: 10
	                },
	                range:
	                {
	                    required: true,
	                    rangelength: [5, 10]
	                },
	                digits:
	                {
	                    required: true,
	                    digits: true
	                },
	                number:
	                {
	                    required: true,
	                    number: true
	                },
	                minVal:
	                {
	                    required: true,
	                    min: 10
	                },
	                maxVal:
	                {
	                    required: true,
	                    max: 20
	                },
	                rangeVal:
	                {
	                    required: true,
	                    range: [10, 20]
	                }
	            },

	            // Messages for form validation
	            messages:
	            {
	                required:
	                {
	                    required: 'Please enter something'
	                },
	                email:
	                {
	                    required: 'Please enter a valid email address'
	                },
	                url:
	                {
	                    required: 'Please enter a valid URL address'
	                },
	                date:
	                {
	                    required: 'Please enter a valid date'
	                },
	                min:
	                {
	                    required: 'Please enter a valid text'
	                },
	                max:
	                {
	                    required: 'Please enter a valid text'
	                },
	                range:
	                {
	                    required: 'Please enter a valid text'
	                },
	                digits:
	                {
	                    required: 'Please enter a valid digits'
	                },
	                number:
	                {
	                    required: 'Please enter a valid number'
	                },
	                minVal:
	                {
	                    required: 'Please enter a valid value'
	                },
	                maxVal:
	                {
	                    required: 'Please enter a valid value'
	                },
	                rangeVal:
	                {
	                    required: 'Please enter a valid value'
	                }
	            },

	            // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
        }

    };
}();