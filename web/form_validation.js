function validateForm() {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    // E-posta formatı kontrolü
    let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        alert("Geçerli bir e-posta adresi giriniz.");
        return false;
    }

    // Şifre uzunluğu kontrolü
    if (password.length < 6) {
        alert("Şifreniz en az 6 karakter uzunluğunda olmalıdır.");
        return false;
    }

    return true;
}
