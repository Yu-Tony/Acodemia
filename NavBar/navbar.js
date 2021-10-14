
function validatePassword(){

    var re =  /^(?=.*.\d)(?=.*[@$!%*?&])(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
    /*(?=.*[@$!%*?&])
    (?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\])*/


    var password = document.getElementById("password");
    var confirm_password = document.getElementById("passwordSign2");
  
    if( !password.value ) 
    {
        password.setCustomValidity("Completa este campo");
    }
    else
    {
        if(!re.test(password.value))
        {
            password.setCustomValidity("La contraseña debe contener al menos 8 caracteres, 1 numero, 1 letra minuscula, 1 letra mayuscula y 1 caracter especial");
        }
        else 
        {
    
            password.setCustomValidity('');
        
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Las contraseñas no coinciden");
            } else {
                confirm_password.setCustomValidity('');
            }
    
        }
   
    }
 
  }

  function validatePasswordEdit(){

    var re =  /^(?=.*.\d)(?=.*[@$!%*?&])(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
    /*(?=.*[@$!%*?&])
    (?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\])*/


    var password = document.getElementById("passwordP");
  
  
    if( !password.value ) 
    {
        password.setCustomValidity("Completa este campo");
    }
    else
    {
        if(!re.test(password.value))
        {
            password.setCustomValidity("La contraseña debe contener al menos 8 caracteres, 1 numero, 1 letra minuscula, 1 letra mayuscula y 1 caracter especial");
        }
        else 
        {
    
            password.setCustomValidity('');
        
           
    
        }
   
    }
 
  }

  function validateFName()
{
  var re = /^[ñA-Za-z _]*[ñA-Za-z][ñA-Za-z _]*$/;
  var firstName = document.getElementById("firstname");

  if( !firstName.value ) 
  {
    firstName.setCustomValidity("Completa este campo");
  }
  else
  {
    if(!re.test(firstName.value))
    {
      firstName.setCustomValidity("El nombre debe de incluir solo letras");
    }
    else {
      firstName.setCustomValidity('');
    }
  }



}

function validateLName()
{
  var re = /^[ñA-Za-z _]*[ñA-Za-z][ñA-Za-z _]*$/;
  var lastName = document.getElementById("lastname");

  if( !lastName.value ) 
  {
    lastName.setCustomValidity("Completa este campo");
  }
  else
  {
    if(!re.test(lastName.value))
    {
      lastName.setCustomValidity("Los apellidos deben incluir solo letras");
      
    }
    else {
      lastName.setCustomValidity('');
    }
  }


}

function validateMail()
{
  var re = /([a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]{1,30})@([a-zA-Z0-9-]{2,30})\.([a-zA-Z0-9-]{2,3})/;
  var mail = document.getElementById("email");

  if( !mail.value ) 
  {
    mail.setCustomValidity("Completa este campo");
  }
  else
  {
    if(!re.test(mail.value))
    {
      mail.setCustomValidity("poner un correo valido como example@gmail.com");
    }
    else {
      mail.setCustomValidity('');
    }
  }


}



