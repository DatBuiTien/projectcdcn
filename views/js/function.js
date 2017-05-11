/**
 * Created by Bui Tien Dat on 28-Apr-17.
 */
function showOrder(){
    document.getElementById("showorder").style.display="block";
}

function checkInfoOrder() {
    var name = document.forms['form-order']['username'].value;
    var email = document.forms['form-order']['useremail'].value;

    var filter = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;


    var phone = document.forms['form-order']['userphone'].value;
    var address = document.forms['form-order']['useraddress'].value;
    var daterequire = document.forms['form-order']['date_required'].value;
    if(name == ""){
        document.getElementById('err-username').style.display = 'block';
        return false;
    }else {
        document.getElementById('err-username').style.display = 'none';
    }

    if(email == ""){
        document.getElementById('err-useremail').style.display = 'block';
        return false;
    }else {
        document.getElementById('err-useremail').style.display = 'none';
        if (!filter.test(email)) {
            document.getElementById('err-useremail-type').style.display = 'block';
            return false;
        }else{
            document.getElementById('err-useremail-type').style.display = 'none';
        }

    }

    if(phone == ""){
        document.getElementById("err-phone").style.display="block";
        return false;
    }else{
        document.getElementById("err-phone").style.display="none";
    }

    if(isNaN(phone)){
        document.getElementById("err-phone-type").style.display="block";
        return false;
    }else{
        document.getElementById("err-phone-type").style.display="none";
    }

    if(address == ""){
        document.getElementById('err-address').style.display = 'block';
        return false;
    }else {
        document.getElementById('err-address').style.display = 'none';
    }

    if(daterequire == ""){
        document.getElementById('err-date').style.display = 'block';
        return false;
    }else {
        document.getElementById('err-date').style.display = 'none';
    }
}