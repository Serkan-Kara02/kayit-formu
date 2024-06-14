function validateForm() {

    let firstName = document.getElementById("firstName").value;
    let lastName = document.getElementById("lastName").value;
    if (firstName.trim() === "" || lastName.trim() === "") {
        alert("İsim ve Soyisim alanları boş bırakılamaz.");
        return false;
    }


    let email = document.getElementById("email").value;
    let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        alert("Geçerli bir e-posta adresi giriniz.");
        return false;
    }


    let password = document.getElementById("password").value;
    if (password.length < 6) {
        alert("Şifreniz en az 6 karakter uzunluğunda olmalıdır.");
        return false;
    }


    let birthDate = document.getElementById("birthDate").value;
    if (birthDate === "") {
        alert("Doğum tarihi alanı boş bırakılamaz.");
        return false;
    }


    let gender = document.getElementById("gender").value;
    if (gender === "") {
        alert("Cinsiyet alanı boş bırakılamaz.");
        return false;
    }


    return true;
}
