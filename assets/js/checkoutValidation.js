document.getElementById("checkout").addEventListener("submit", e => {
    const firstName = document.getElementById("firstName").value.trim();
    const lastName = document.getElementById("lastName").value.trim();
    const address = document.getElementById("address").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const email = document.getElementById("email").value.trim();

    const cardNumber = document.getElementById("creditcard").value.trim();
    const nameOnCard = document.getElementById("nameOnCard").value.trim();
    const expiry = document.getElementById("expiry").value.trim();
    const csv = document.getElementById("csv").value.trim();

    let emailValidation = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let phoneValidation = /^((000|112|106)|((\+61[- ]?\(?|\(?0)[- ]?[23478]\)?([- ]?\d){8})|((13|180)([- ]?\d){4})|((1300|1800|190\d)([- ]?\d){6}))$/
    let dateValidation = /^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/

    if (firstName.length == 0 || firstName == null) {
        showError("firstNameError", "First Name is required")
        e.preventDefault();
    } else {
        hideError("firstNameError")
    }

    if (lastName.length == 0 || lastName == null) {
        showError("lastNameError", "Last name is required")
        e.preventDefault();
    } else {
        hideError("lastNameError")
    }

    if (address.length == 0 || address == null) {
        showError("addressError", "Address is required")
        e.preventDefault();
    } else {
        showError("addressError")
    }

    if (!phoneValidation.test(phone)) {
        showError("phoneError", "Phone Number is required")
        e.preventDefault();
    } else {
        hideError("phoneError")
    }

    if (!emailValidation.test(email)) {
        showError("emailError", "Email Address is required")
        e.preventDefault();
    } else {
        hideError("emailError")
    }

    if (cardNumber.split(" ").join("").length != 16) {
        showError("creditCardError", "Card number is invalid")
        e.preventDefault();
    } else {
        hideError("creditCardError")
    }

    if (nameOnCard.length == 0 || nameOnCard == null) {
        showError("nameOnCardError", "Name on the Card required")
        e.preventDefault();
    } else {
        hideError("nameOnCardError")
    }

    if (!dateValidation.test(expiry)) {
        showError("expiryError", "Expiration Date invalid. Must be mm/yy or mm/yyyy")
        e.preventDefault();
    } else {
        hideError("expiryError")
    }

    if (csv.length != 3 || csv == null) {
        showError("csvError", "Must be a valid csv")
        e.preventDefault();
    } else {
        hideError("csvError")
    }
})

function showError(field, errorMessage) {
    document.getElementById(field).innerHTML = errorMessage;
}

function hideError(field) {
    document.getElementById(field).innerHTML = "";
}
