// alert("Page working");

function validate()
{
	var name =  document.getElementById('full-name');
    var add1 = document.getElementById('add1').value;
    var add2 = document.getElementById('add2').value
    var number = document.getElementById('ph-num').value;

    var name_regex = /^[a-zA-Z ]{2,30}$/;
    var num_reg = /^[0][\d]{3}[\d]{7}$/;

    var num_reg_1 = /^[\+92]\d{3}\d{7}$/;

    var validate = true;

 	if(name_regex.test(name.value)==false)
    {
    	document.getElementById('name-err').innerHTML = "Please enter name in valid format";
        document.getElementById('name-err').style.display = 'block';
    	validate = false;
    }

    if(add1=="")
    {
        document.getElementById('add1-err').innerHTML = "Please enter address here";
        document.getElementById('add1-err').style.display = 'block';
        validate = false;
    }

    if(add2=="")
    {
        document.getElementById('add2-err').innerHTML = "Please enter address here";
        document.getElementById('add2-err').style.display = 'block';
        validate = false;
    }

    if(num_reg.test(number)==false)
    {
        document.getElementById('ph-err').innerHTML = "Please enter number in valid format";
        document.getElementById('ph-err').style.display = 'block';
        validate = false;
    }

    return validate;
}

function validate_search()
{
    var validate = true;
    var search = document.getElementById('search-query').value;

    if(search=="")
    {
        validate = false;
    }

    else
    {
        validate = true;
    }

    return validate;
}