 // Get the mobile input element
 var mobileInput = document.getElementById("mobile");

 // Add event listener for input event
 mobileInput.addEventListener("input", function(event) {
     // Get the input value
     var inputValue = event.target.value;

     // Remove non-numeric characters
     var numericValue = inputValue.replace(/\D/g, '');

     // Ensure that the input does not exceed 10 digits
     if (numericValue.length > 10) {
     numericValue = numericValue.slice(0, 10);
     }

     // Update the input value
     event.target.value = numericValue;
 });