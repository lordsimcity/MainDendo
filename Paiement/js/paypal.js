var amount;

$(document).ready(
  () => {

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              amount = Number(this.responseText);
              console.log(amount);
          }
      };
      
      xmlhttp.open("GET", "./totalOrder.php", true);
      xmlhttp.send();

      paypal.Buttons({
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: amount
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            alert('Transaction effectuée!');
            window.location.replace("./basketDump.php");
          });
        }
      }).render('#paypal-button-container');

});
