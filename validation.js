
// Get the input element by its ID
const fnameInput = document.getElementById('fname');

// Add an event listener to the input element
fnameInput.addEventListener('input', function() {
// Get the entered value and remove any non-alphabet characters
const inputValue = this.value.replace(/[^a-zA-Z]/g, '');

// Update the input field with the cleaned value
this.value = inputValue;
});

// Add a blur event listener to check if the field is filled when it loses focus
fnameInput.addEventListener('blur', function() {
if (this.value.trim() === '') {
alert('Please enter your first name.');
}
});

function setupAadharValidation() {
const aadharInput = document.getElementById('add');

// Add an input event listener to allow only digits and limit to 12 digits
aadharInput.addEventListener('input', function() {
// Get the entered value and remove any non-digit characters
const inputValue = this.value.replace(/\D/g, '');

// Limit the length to 12 digits
this.value = inputValue.slice(0, 12);
});

// Add a blur event listener to check if the field is filled and has 12 digits when it loses focus
aadharInput.addEventListener('blur', function() {
if (this.value.trim() === '') {
  alert('Aadhar No. is required.');
} else if (this.value.length !== 12) {
  alert('Aadhar No. must be 12 digits.');
}
});
}

// Call the setupAadharValidation function to set up validation for the Aadhar No. field
setupAadharValidation();


function setupCPIValidation() {
  const cpiInput = document.getElementById('cpi');

  // Add an input event listener for CPI validation
  cpiInput.addEventListener('input', function() {
    // Get the entered value and remove any non-numeric or non-dot characters
    const inputValue = this.value.replace(/[^0-9.]/g, '');

    // Limit the length to 10 characters
    this.value = inputValue.slice(0, 10);

    // Parse the value as a float
    const cpiValue = parseFloat(this.value);

    // Check if the value is a valid float and within the range [0, 10]
    if (isNaN(cpiValue) || cpiValue < 0 || cpiValue > 10) {
      this.setCustomValidity('CPI must be a number between 0 and 10.');
    } else {
      this.setCustomValidity(''); // Clear any custom validity message
    }
  });

  // Add a blur event listener to check if the field is filled
  cpiInput.addEventListener('blur', function() {
    if (this.value.trim() === '') {
      this.setCustomValidity('CPI is required.');
    }
  });
}

// Call the setupCPIValidation function to set up validation for the CPI field
setupCPIValidation();



// Function to enforce character-only input and required validation
function setupFieldValidation(fieldId, fieldName) {
const fieldInput = document.getElementById(fieldId);

// Add an input event listener to allow only characters
fieldInput.addEventListener('input', function() {
// Get the entered value and remove any non-alphabet characters
const inputValue = this.value.replace(/[^a-zA-Z\s]/g, '');

// Update the input field with the cleaned value
this.value = inputValue;
});

// Add a blur event listener to check if the field is filled when it loses focus
fieldInput.addEventListener('blur', function() {
if (this.value.trim() === '') {
  alert(`Please enter your ${fieldName}.`);
}
});
}

// Call the setupFieldValidation function for each field
setupFieldValidation('lname', 'Last Name');
setupFieldValidation('address', 'Address');
setupFieldValidation('na', 'nationality');
setupFieldValidation('deg', 'Degree');
setupFieldValidation('cu', 'Course');


  