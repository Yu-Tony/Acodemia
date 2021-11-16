

function validateCardName()
{
  var re = /^[a-zA-Z\s]*$/;
  var cvv = document.getElementById("cardName");

  if( !cvv.value ) 
  {
    cvv.setCustomValidity("Completa este campo");
  }
  else
  {
    if(!re.test(cvv.value))
    {
        cvv.setCustomValidity("El nombre debe de contener solo letras y espacios");
    }
    else {
        cvv.setCustomValidity('');
    }
  }


}

function validateCardCVV()
{
  var re = /^[0-9]*$/;
  var cvv = document.getElementById("CVV");

  if( !cvv.value ) 
  {
    cvv.setCustomValidity("Completa este campo");
  }
  else
  {
    if(!re.test(cvv.value))
    {
        cvv.setCustomValidity("El codigo de seguridad debe contener solo numeros");
    }
    else {
        cvv.setCustomValidity('');
    }
  }


}

function validateCardNumber()
{
  var re = /^\d{16}$/;
  var cvv = document.getElementById("cardNumber");

  if( !cvv.value ) 
  {
    cvv.setCustomValidity("Completa este campo");
  }
  else
  {
    if(!re.test(cvv.value))
    {
        cvv.setCustomValidity("El numero de tarjeta debe contener 16 numeros");
    }
    else {
        cvv.setCustomValidity('');
    }
  }


}


