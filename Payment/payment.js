//https://stackoverflow.com/questions/60973630/why-will-paypal-smart-buttons-not-recognise-my-items-array
//https://stackoverflow.com/questions/54640821/specific-line-items-in-paypal-checkout

 
 function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'pill',
          color: 'blue',
          layout: 'vertical',
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
                  name: 'Hafer',
                  unit_amount: {value: getTotalPrice(), currency_code: 'MXN'},
                  quantity: '1',
                  sku: 'haf001'
              }]
          }]
            /*purchase_units: [{
              reference_id: "ACDMA",
              description: "Cursos Acodemia",
              "amount":{ "currency_code": 'MXN',"value": 32},
                  "items": [{
                      "name": 'Hola'
                  }]
            }]*/

            
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            
            // Full available details
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-payment-button');
            element.innerHTML = '';
            element.innerHTML = '<h3>Thank you for your payment!</h3>';

            var jwt = getCookie('jwt');
            $.post("api/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result) {
        
 
              document.getElementById("emailP").value = result.data.email;

    

    

       
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

  return($('#PrecioObjetoComprado').html());
  //var Price=document.getElementById("number").value;  

  }

  /*      createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              reference_id: "ACDMA",
              description: "Cursos Acodemia",
              "amount":{ currency_code: 'MXN',value: getTotalPrice()},
                  items: [{
                      name: getName()
                  }]
            }]
          });
        }*/



