const alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ";
const nums = "0123456789";

window.addEventListener('load', () => { //when page loads add all listeners to elements

    if (document.getElementById("index")) { //if u find this, you are on index.php
        document.getElementById("signin").addEventListener("click", () => Validator(loginForm));
    } else if (document.getElementById("new")) {
        document.getElementById("add").addEventListener("click", () => newStudent(form2));
    } else if (document.getElementById("add")) {
        document.getElementById("create").addEventListener("click", () => Validator2(createForm));
    } else if (document.getElementById("addDoctor")) {
        document.getElementById("AddDoctorBtn").addEventListener("click", () => Validator3(addDoctorForm));
    } else if (document.getElementById("discharge")) {
        document.getElementById("dischargeEnterBtn").addEventListener("click", () => Validator4(dischargeForm));
    }

    if (document.getElementById("searchBtn")) // search button on view patients page
        document.getElementById("searchBtn").addEventListener("click", () => checkSearch());
});

function isEmailValid(email) {
    var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;
    if (!email.match(reEmail))
        return false;
    else return true;
}

function isPasswordValid(passwd) {
    if (passwd.length < 8)
        return false;

    let countA = 0, countN = 0;  // count alpha chars and nums
    for(let i = 0; i < passwd.length; i++) {
        if (alphabet.indexOf(passwd[i]) != -1)
            countA++;
        if (nums.indexOf(passwd[i]) != -1)
            countN++;
    }

    if ((countA < 1) || (countN < 1))
        return false;
    return true; //if you made it this far, requirements met
}

function isValidID(str) {
    if (str.length != 10)
        return false;
    for(let i = 0; i < str.length; i++)
        if (!nums.includes(str[i]))
            return false;
    return true;
}

function displayErrorMessages(msgs, section) {
    section.innerText = msgs;
}

function isUserValid(name) {
    for(let i = 0; i < name.length; i++) 
        if (!alphabet.includes(name[i]))
            if (!nums.includes(name[i]))
                return false;
    return name.length > 0;
}

function checkSearch() {
    if (isUserValid(document.getElementById("SearchInput")))
        event.preventDefault();
}

function Validator(data) {
    var success = false;
    if (!isUserValid(data.username.value)) //validate username
        displayErrorMessages("Invalid Username", document.getElementById("error"));
    else if (!isPasswordValid(data.pass.value)) //validate password
        displayErrorMessages("Invalid Password", document.getElementById("error"));
    else  {
        success = true; //let php determine if user exists
        document.getElementsByName("index")[0].value = "true";
    }
    if (!success)
        event.preventDefault();
}

function Validator2(data) {
    var success = false;
    if (!isUserValid(data.Role.value)) //validate role
        displayErrorMessages("Invalid Role", document.getElementById("error"));
    else if (!isUserValid(data.FirstName.value)) //validate First Name
        displayErrorMessages("Invalid First Name", document.getElementById("error"));
    else if (!isUserValid(data.LastName.value)) //validate Last Name
        displayErrorMessages("Invalid Last Name", document.getElementById("error"));
    else if (!isPasswordValid(data.Pass.value)) //validate password
        displayErrorMessages("Password should be at least 8 chars and contain letters and numbers", document.getElementById("error"));
    else if (data.Pass.value != data.confirmPass.value)
        displayErrorMessages("Passwords do not match", document.getElementById("error"));
    else  {
        success = true; //let php handle the rest
        document.getElementsByName("add")[0].value = "true";
    }
    if (!success)
        event.preventDefault();
}

function Validator3(data) {
    var success = false;
    if (!isUserValid(data.Role.value)) //validate role
        displayErrorMessages("Invalid Role", document.getElementById("error"));
    else if (!isUserValid(data.FirstName.value)) //validate First Name
        displayErrorMessages("Invalid First Name", document.getElementById("error"));
    else if (!isUserValid(data.LastName.value)) //validate Last Name
        displayErrorMessages("Invalid Last Name", document.getElementById("error"));
    else {
        success = true; //let php handle the rest
        document.getElementsByName("addDoctor")[0].value = "true";
    }
    if (!success)
        event.preventDefault();
}

function Validator4(data) {
    var success = false;
    if (!isValidID(data.id.value)) //validate id
        displayErrorMessages("Invalid National ID", document.getElementById("error"));
    else {
        success = true; //let php handle the rest
        document.getElementsByName("discharge")[0].value = "true";
    }
    if (!success)
        event.preventDefault();
}