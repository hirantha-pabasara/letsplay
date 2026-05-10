function changeView(){
    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");
}

function signUp(){
    var f = document.getElementById("f");
    var l = document.getElementById("l");
    var e = document.getElementById("e");
    var p = document.getElementById("p");
    var m = document.getElementById("m");
    var g = document.getElementById("g");

    var form = new FormData;
    form.append("f", f.value);
    form.append("l", l.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("m", m.value);
    form.append("g", g.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.readyState == 4){
            var text = request.responseText;
            if(text=="success"){
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msg").className = "bi bi-check2-circle fs-5";
                document.getElementById("alertdiv").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
            }else{
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    };

    request.open("POST","signUpProcess.php",true);
    request.send(form);
}

function signIn(){
    var email = document.getElementById("su_email");
    var password = document.getElementById("su_password");
    var rememberme = document.getElementById("rememberme");

    var form = new FormData;
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("r", rememberme.value);

    var request = new XMLHttpRequest ();

    request.onreadystatechange = function(){
        if(request.readyState == 4){
            var t = request.responseText;
            if(t == "success" ){
                window.location ="home.php";
            }else{
                alert("Done");
                document.getElementById("msg2").innerHTML = t;
            }
        }
    };

    request.open("POST","signInProcess.php",true);
    request.send(form)

}



var bm;
function forgotPassword() {

    var email = document.getElementById("su_email");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Verification code has sent to your email. Please check your inbox");
                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET","forgotPasswordProcess.php?e="+email.value,true);
    r.send();

}

function showPassword1() {

    var i = document.getElementById("npi");
    var eye = document.getElementById("e1");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function showPassword2() {

    var i = document.getElementById("rnp");
    var eye = document.getElementById("e2");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function resetpw() {

    var email = document.getElementById("su_email");
    var np = document.getElementById("new_pass");
    var rnp = document.getElementById("re_pass");
    var vcode = document.getElementById("verify");

    var f = new FormData();
    f.append("e", email.value);
    f.append("n", np.value);
    f.append("r", rnp.value);
    f.append("v", vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {

                bm.hide();
                alert("Password reset success");

            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "resetPassword.php", true);
    r.send(f);
}

function signout() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            if (t = "success") {
                window.location = "home.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "signoutProcess.php", true);
    r.send();
}

function changeImage() {

    var view = document.getElementById("viewImg");
    var file = document.getElementById("profileImg");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function addtoCart(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("GET,addtoCartProcess.php?id="+id, true);
    r.send();

}

function changeImage() {

    var view = document.getElementById("viewImg");
    var file = document.getElementById("profileImg");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function updateProfile() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var image = document.getElementById("profileImg");


    var f = new FormData();
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("m", mobile.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);

    if (image.files.length == 0) {

        var confirmation = confirm("Are you sure you don't want to update Profile Image ?");

        if (confirmation) {
            alert("You have not selected any Image.");
        }

    } else {
        f.append("image", image.files[0]);
    }


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {

            var t = r.responseText;
            alert(t);

        }
    }
    r.open("POST", "updateProcess.php", true);
    r.send(f);

}

function payNow(id) {
    var qty = document.getElementById("qty2").value;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
         
            var obj = JSON.parse(t);

            var mail = obj["umail"];
            var amount = obj["amount"];
            var orderId = obj["id"];
            var hash = obj["hash"];

        

            if (t == 1) {
                alert("Please login.");
                window.location = "join.php";
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    saveInvoice(orderId, id, mail, amount, qty);
                    //window.location = "invoice.php";


                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1227460",    // Replace your Merchant ID
                    "hash": hash,
                    "return_url": "http://localhost/letsplay2/singleProductView.php?id=" + id,     // Important
                    "cancel_url": "http://localhost/letsplay2/singleProductView.php?id=" + id,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": "",
                    "city": "",
                    "country": "",
                    "delivery_address": "",
                    "delivery_city": "",
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }
        }
    }

    r.open("GET","buyNowProcess.php?id="+id+"&qty="+qty,true);
    r.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);
    f.append("q", qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?oid="+orderId;
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveInvoice.php", true);
    r.send(f);

}

