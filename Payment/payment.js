//https://stackoverflow.com/questions/60973630/why-will-paypal-smart-buttons-not-recognise-my-items-array
//https://stackoverflow.com/questions/54640821/specific-line-items-in-paypal-checkout

 
 function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'pill',
          color: 'blue',
          layout: 'horizontal',
          label: 'paypal',
          
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              "soft_descriptor": "ACODEMIA",
              amount: {
                  value: getTotalPrice(),
                  currency_code: 'MXN',
                  breakdown: {
                      item_total: {value: getTotalPrice(), currency_code: 'MXN'}
                  }
              },
              items: [{
                  name: getNameProducts(),
                  unit_amount: {value: getTotalPrice(), currency_code: 'MXN'},
                  quantity: '1'
              }]
          }]
                
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            
            // Full available details
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-payment-button');
            element.innerHTML = '';
            element.innerHTML = '<h3>GRACIAS POR SU PAGO</h3>';

            var jwt = getCookie('jwt');
            $.post("api/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result) {
        
 
              var email = result.data.email;
              var temp = localStorage.getItem("tipoCompra");
              var id = localStorage.getItem("id");

              if(temp=="Curso")
              {
                $.ajax({
                  url: "Payment/comprarCurso.php",
                  type : "POST",
                  data: {'idCurso': id,'mail': email, 'metodo': 2 }, 
                  success : function(result) {

                    //console.log(result);  

                    localStorage.clear();                      
                      
                  },
                  error: function(xhr, resp, text){
                      
                    if(text == "Gone")
                    {
                        alert("Error al hacer el pago, intente de nuevo");
                    }

                    console.log("Error al crear cuenta  " + text);
                    console.log("Response text  " + xhr.responseText);
                    localStorage.clear();  
               
                  }
                });
              }
              else
              { 
                $.ajax({
                  url: "Payment/comprarNivel.php",
                  type : "POST",
                  data: {'idNivel': id,'mail': email, 'metodo': 2 }, 
                  success : function(result) {

          
                    //console.log(result); 
                          
                    localStorage.clear();                  
                      
                  },
                  error: function(xhr, resp, text){
                    if(text == "Gone")
                    {
                        alert("Error al hacer el pago, intente de nuevo");
                    }

                    console.log("Error al crear cuenta  " + text);
                    console.log("Response text  " + xhr.responseText);
                    localStorage.clear(); 
                  }
                });

              }
              
            })


            // Or go to another URL:  actions.redirect('thank_you.html');
            
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-payment-button');
    }

    initPayPalButton();



  function getTotalPrice() {
    //var Price = $(this).parent().find('#CursoPrecio').html();
    var temp = localStorage.getItem("precio");
    return(temp);
  }

  function getNameProducts() {
    var temp = localStorage.getItem("name");
    return(temp);
  }



