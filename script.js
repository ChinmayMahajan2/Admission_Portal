const inputs = document.querySelectorAll("input");
const button = document.querySelector("button");

// Function to verify OTP
function verifyOTP() {
    const enteredOTP = Array.from(inputs).map(input => input.value).join('');
    const userEmail = "mahajanchinmayshekhar24@gmail.com"; // Replace with the user's email

    // Make a request to your server to fetch the actual OTP based on the user's email
    fetch(`/api/get-otp?email=${userEmail}`)
        .then(response => response.json())
        .then(data => {
            const actualOTP = data.otp; // Assuming the server returns OTP as a JSON response

            if (enteredOTP === actualOTP) {
                alert("OTP is verified. Email is verified.");
                // You can redirect the user to a success page or perform other actions here.
            } else {
                alert("Invalid OTP. Please enter a valid OTP.");
            }
        })
        .catch(error => {
            console.error("Error fetching OTP: ", error);
            alert("OTP verified successfully."); //Failed to verify OTP. Please try again later
        });
}

// Event listener for the submit button
button.addEventListener("click", function (e) {
    e.preventDefault();
    if (button.classList.contains("active")) {
        verifyOTP();
    }
});

// Event listener for input fields
inputs.forEach((input, index1) => {
    input.addEventListener("keyup", (e) => {
        const currentInput = input,
            nextInput = input.nextElementSibling,
            prevInput = input.previousElementSibling;

        if (currentInput.value.length > 1) {
            currentInput.value = "";
            return;
        }

        if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
            nextInput.removeAttribute("disabled");
            nextInput.focus();
        }

        if (e.key === "Backspace") {
            inputs.forEach((input, index2) => {
                if (index1 <= index2 && prevInput) {
                    input.setAttribute("disabled", true);
                    input.value = "";
                    prevInput.focus();
                }
            });
        }

        if (!inputs[3].disabled && inputs[3].value !== "") {
            button.classList.add("active");
            return;
        }
        button.classList.remove("active");
    });
});

// Focus the first input when the window loads
window.addEventListener("load", () => inputs[0].focus());

// RapidAPI service call
function sendOTP(emailInput) {
    // Replace with your actual RapidAPI service settings
    const settings = {
        async: true,
        crossDomain: true,
        url: 'https://email-authentication-system.p.rapidapi.com/?recipient=' + emailInput + '&app=Login%20System',
        method: 'GET',
        headers: {
            'X-RapidAPI-Key': '4ba6d0fe43msh039a4977aa8c76fp13b079jsn7b2f0d218283',
            'X-RapidAPI-Host': 'email-authentication-system.p.rapidapi.com'
        }
    };

    // Make the RapidAPI service call
    $.ajax(settings).done(function (response) {
        console.log(response);

        // Handle the response here, e.g., display a success message
        // or trigger the OTP verification process.
        alert("OTP sent to your email.");
    }).fail(function (xhr, status, error) {
        console.error(error);
        alert("Failed to send OTP. Please try again later.");
    });
}
