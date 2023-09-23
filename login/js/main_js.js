// Function for validation of product submission
function validate_pro_submission()
{
    var title         = document.getElementById('product-name').value;
    var desc          = document.getElementById('product-desc').value;
    var brand         = document.getElementById('select-brand-for-product').value;
    var cat           = document.getElementById('select-category-for-product').value;
    var product_img1  = document.getElementById('product-img1').files;
    var product_img2  = document.getElementById('product-img2').files;
    var product_img3  = document.getElementById('product-img3').files;
    var product_price = document.getElementById('product-price').value;
    var quantity      = document.getElementById('product-quan').value;

    var title_length  = title.length;
    var desc_length   = desc.length;
    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]/;

    var validation;

    if(title_length<1)
    {
        var pro_error = document.getElementById('pro-name-error');
        pro_error.innerHTML = "Please fill the product name field";
        pro_error.display = "block";
        validation = false;
    }

    else if(title_length>100)
    {
        var pro_error = document.getElementById('pro-name-error');
        pro_error.innerHTML = "Product name field limit exceeded";
        pro_error.display = "block";
        validation = false;
    }

    if(desc_length<1)
    {
        var pro_error = document.getElementById('pro-desc-error');
        pro_error.innerHTML = "Please fill the product description field";
        pro_error.display = "block";
        validation = false;
    }


    else if(desc_length>500)
    {
        var pro_error = document.getElementById('pro-desc-error');
        pro_error.innerHTML = "Product name field limit exceeded";
        pro_error.display = "block";
        validation = false;
    }

    if(brand == "null")
    {
        var pro_error = document.getElementById('pro-brands-error');
        pro_error.innerHTML = "Please select a brand";
        pro_error.display = "block";
        validation = false;
    }

    if(cat== "null")
    {
        var pro_error = document.getElementById('pro-cats-error');
        pro_error.innerHTML = "Please select a category";
        pro_error.display = "block";
        validation = false;
    }

    if(product_img1.length == 0)
    {
        var pro_error = document.getElementById('pro-img1-error');
        pro_error.innerHTML = "Please select an image";
        pro_error.display = "block";
        validation = false;
    }

    if(product_img2.length == 0)
    {
        var pro_error = document.getElementById('pro-img2-error');
        pro_error.innerHTML = "Please select an image";
        pro_error.display = "block";
        validation = false;
    }

    if(product_img3.length == 0)
    {
        var pro_error = document.getElementById('pro-img3-error');
        pro_error.innerHTML = "Please select an image";
        pro_error.display = "block";
        validation = false;
    }

    if(product_price<0)
    {
        var pro_error = document.getElementById('pro-price-error');
        pro_error.innerHTML = "Price cannot be less than zero";
        pro_error.display = "block";
        validation = false;
    }

    else if(product_price.length == 0)
    {
        var pro_error = document.getElementById('pro-price-error');
        pro_error.innerHTML = "Please fill the price input";
        pro_error.display = "block";
        validation = false;
    }

    if(quantity<1)
    {
        var pro_error = document.getElementById('pro-quan-error');
        pro_error.innerHTML = "Quantity cannot be less than 1";
        pro_error.display = "block";
        validation = false;
    }

    if(quantity.length == 0)
    {
        var pro_error = document.getElementById('pro-quan-error');
        pro_error.innerHTML = "Please fill the quantity input";
        pro_error.display = "block";
        validation = false;
    }

    if(format.test(title))
    {
        var pro_error = document.getElementById('pro-name-error');
        pro_error.innerHTML = "Title cannot contain special characters";
        pro_error.display = "block";
        validation = false;
    }

    if(format.test(desc))
    {
        var pro_error = document.getElementById('pro-desc-error');
        pro_error.innerHTML = "Description cannot contain special characters";
        pro_error.display = "block";
        validation = false;
    }

    return validation;
}

// Function for front-end validation of category submission 
function validate_cat_submission()
{
    var title = document.getElementById("cat-name").value;
    var desc = document.getElementById("cat-desc").value;
    var error = document.getElementById("cat-err");
    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]/;

    var title_length = title.length;
    var desc_length = desc.length;

    if(title_length<1 || desc_length<1)
    {
        document.getElementById('cat-err').innerHTML = 'Cannot leave the fields empty';
        error.style.display = "block";
        return false;
    }

    else if(title_length>100 || desc_length>500)
    {
        document.getElementById('cat-err').innerHTML = 'Fields character limit exceeded';
        error.style.display = "block";
        return false;
    }

    else if(format.test(title))
    {
        document.getElementById('cat-err').innerHTML = 'Title cannot contain special characters';
        error.style.display = "block";
        return false;
    }

    else if(format.test(desc))
    {
        document.getElementById('cat-err').innerHTML = 'Description cannot contain special characters';
        error.style.display = "block";
        return false;
    }

    else
    {
        return true;
    }
}

// Function for front-end validation of brand submission
function validate_brand_submission()
{
    var title = document.getElementById("brand-name").value;
    var desc = document.getElementById("brand-desc").value;
    var error = document.getElementById("brand-err");
    var format = /[!@#$%^&*()_+\-=\[\]{}'"\\|<>\/?]/;

    var title_length = title.length;
    var desc_length = desc.length;

    if(title_length<1 || desc_length<1)
    {
        document.getElementById('brand-err').innerHTML = 'Cannot leave the fields empty';
        error.style.display = "block";
        return false;
    }

    else if(title_length>100 || desc_length>500)
    {
        document.getElementById('brand-err').innerHTML = 'Fields character limit exceeded';
        error.style.display = "block";
        return false;
    }

    else if(format.test(title))
    {
        document.getElementById('brand-err').innerHTML = 'Title cannot contain special characters';
        error.style.display = "block";
        return false;
    }

    else if(format.test(desc))
    {
        document.getElementById('brand-err').innerHTML = 'Description cannot contain special characters';
        error.style.display = "block";
        return false;
    }

    else
    {
        return true;
    }
}

// Function for fron-end validation of brand removal
function validate_brand_removal()
{
    
    var validate = false;

    var checkboxes = document.getElementsByClassName('brand-remove-checkbox');

    for(var i=0; i<checkboxes.length; i++)
    {
        if(checkboxes[i].checked == true)
        {
            validate = true;
            break;
        }

        else
        {
            validate = false;
        }
    }

    if(validate == false)
    {
        var err = document.getElementById('brand-remove-err');
        err.innerHTML = "Please select a brand";
        err.style.display = "block";

    }

    return validate;

}

// Function for fron-end validation of category removal
function validate_cat_removal()
{
    
    var validate = false;

    var checkboxes = document.getElementsByClassName('cat-remove-checkbox');

    for(var i=0; i<checkboxes.length; i++)
    {
        if(checkboxes[i].checked == true)
        {
            validate = true;
            break;
        }

        else
        {
            validate = false;
        }
    }

    if(validate == false)
    {
        var err = document.getElementById('cat-remove-err');
        err.innerHTML = "Please select a category";
        err.style.display = "block";

    }

    return validate;

}

// / Function for fron-end validation of product removal
function validate_pro_removal()
{
    
    var validate = false;

    var checkboxes = document.getElementsByClassName('pro-remove-checkbox');

    for(var i=0; i<checkboxes.length; i++)
    {
        if(checkboxes[i].checked == true)
        {
            validate = true;
            break;
        }

        else
        {
            validate = false;
        }
    }

    if(validate == false)
    {
        var err = document.getElementById('pro-remove-err');
        err.innerHTML = "Please select a product";
        err.style.display = "block";

    }

    return validate;

}

// Function for front-end validation of category updation 
function validate_cat_updation()
{
    var title = document.getElementById("cat-name").value;
    var desc = document.getElementById("cat-desc").value;
    var error = document.getElementById("cat-err");
    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]/;

    var title_length = title.length;
    var desc_length = desc.length;

    if(title_length<1 || desc_length<1)
    {
        document.getElementById('cat-err').innerHTML = 'Cannot leave the fields empty';
        error.style.display = "block";
        return false;
    }

    else if(title_length>100 || desc_length>500)
    {
        document.getElementById('cat-err').innerHTML = 'Fields character limit exceeded';
        error.style.display = "block";
        return false;
    }

    else if(format.test(title))
    {
        document.getElementById('cat-err').innerHTML = 'Title cannot contain special characters';
        error.style.display = "block";
        return false;
    }

    else if(format.test(desc))
    {
        document.getElementById('cat-err').innerHTML = 'Description cannot contain special characters';
        error.style.display = "block";
        return false;
    }

    else
    {
        return true;
    }
}

// Function for front-end validation of brand updation
function validate_brand_updation()
{
    var title = document.getElementById("brand-name").value;
    var desc = document.getElementById("brand-desc").value;
    var error = document.getElementById("brand-err");
    var format = /[!@#$%^&*()_+\-=\[\]{}'"\\|<>\/?]/;

    var title_length = title.length;
    var desc_length = desc.length;

    if(title_length<1 || desc_length<1)
    {
        document.getElementById('brand-err').innerHTML = 'Cannot leave the fields empty';
        error.style.display = "block";
        return false;
    }

    else if(title_length>100 || desc_length>500)
    {
        document.getElementById('brand-err').innerHTML = 'Fields character limit exceeded';
        error.style.display = "block";
        return false;
    }

    else if(format.test(title))
    {
        document.getElementById('brand-err').innerHTML = 'Title cannot contain special characters';
        error.style.display = "block";
        return false;
    }

    else if(format.test(desc))
    {
        document.getElementById('brand-err').innerHTML = 'Description cannot contain special characters';
        error.style.display = "block";
        return false;
    }

    else
    {
        return true;
    }
}

// Function for front-end validation of product updation
function validate_pro_updation()
{
    var title         = document.getElementById('product-name').value;
    var desc          = document.getElementById('product-desc').value;
    var brand         = document.getElementById('select-brand-for-product').value;
    var cat           = document.getElementById('select-category-for-product').value;
    var product_img1  = document.getElementById('product-img1').files;
    var product_img2  = document.getElementById('product-img2').files;
    var product_img3  = document.getElementById('product-img3').files;
    var product_price = document.getElementById('product-price').value;
    var quantity      = document.getElementById('product-quan').value;

    var title_length  = title.length;
    var desc_length   = desc.length;
    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]/;

    var validation;

    if(title_length<1)
    {
        var pro_error = document.getElementById('pro-name-error');
        pro_error.innerHTML = "Please fill the product name field";
        pro_error.display = "block";
        validation = false;
    }

    else if(title_length>100)
    {
        var pro_error = document.getElementById('pro-name-error');
        pro_error.innerHTML = "Product name field limit exceeded";
        pro_error.display = "block";
        validation = false;
    }

    if(desc_length<1)
    {
        var pro_error = document.getElementById('pro-desc-error');
        pro_error.innerHTML = "Please fill the product description field";
        pro_error.display = "block";
        validation = false;
    }


    else if(desc_length>500)
    {
        var pro_error = document.getElementById('pro-desc-error');
        pro_error.innerHTML = "Product name field limit exceeded";
        pro_error.display = "block";
        validation = false;
    }

    if(brand == "null")
    {
        var pro_error = document.getElementById('pro-brands-error');
        pro_error.innerHTML = "Please select a brand";
        pro_error.display = "block";
        validation = false;
    }

    if(cat== "null")
    {
        var pro_error = document.getElementById('pro-cats-error');
        pro_error.innerHTML = "Please select a category";
        pro_error.display = "block";
        validation = false;
    }

    if(product_img1.length == 0)
    {
        var pro_error = document.getElementById('pro-img1-error');
        pro_error.innerHTML = "Please select an image";
        pro_error.display = "block";
        validation = false;
    }

    if(product_img2.length == 0)
    {
        var pro_error = document.getElementById('pro-img2-error');
        pro_error.innerHTML = "Please select an image";
        pro_error.display = "block";
        validation = false;
    }

    if(product_img3.length == 0)
    {
        var pro_error = document.getElementById('pro-img3-error');
        pro_error.innerHTML = "Please select an image";
        pro_error.display = "block";
        validation = false;
    }

    if(product_price<0)
    {
        var pro_error = document.getElementById('pro-price-error');
        pro_error.innerHTML = "Price cannot be less than zero";
        pro_error.display = "block";
        validation = false;
    }

    else if(product_price.length == 0)
    {
        var pro_error = document.getElementById('pro-price-error');
        pro_error.innerHTML = "Please fill the price input";
        pro_error.display = "block";
        validation = false;
    }

    if(quantity<1)
    {
        var pro_error = document.getElementById('pro-quan-error');
        pro_error.innerHTML = "Quantity cannot be less than 1";
        pro_error.display = "block";
        validation = false;
    }

    if(quantity.length == 0)
    {
        var pro_error = document.getElementById('pro-quan-error');
        pro_error.innerHTML = "Please fill the quantity input";
        pro_error.display = "block";
        validation = false;
    }

    if(format.test(title))
    {
        var pro_error = document.getElementById('pro-name-error');
        pro_error.innerHTML = "Title cannot contain special characters";
        pro_error.display = "block";
        validation = false;
    }

    if(format.test(desc))
    {
        var pro_error = document.getElementById('pro-desc-error');
        pro_error.innerHTML = "Description cannot contain special characters";
        pro_error.display = "block";
        validation = false;
    }

    return validation;
}

