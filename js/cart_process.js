function addCart(id) {
  $.post("CartProcess.php?",{'productID':id}, function(data, status){
    var result = data.split("-");

    $("#cart_amount").text(result[0]);
  });
  $('.toast').toast({delay:1850});
  $('.toast').toast('show');
}

function removeItem(id) {
  $.post("CartProcess.php?",{'removeID':id}, function(data, status){
    
  });

  $('.toast').toast({delay:1950});
  $('.toast').toast('show');
  window.open('cart.php','_self')
}

var total = 0;
var iprice = document.getElementsByClassName('iprice');
var iqty = document.getElementsByClassName('iquantity');
var itotal = document.getElementsByClassName('itotal');
var iproductID = document.getElementsByClassName('pID');
var gtotal = document.getElementById('total');

function subTotal() {
  total = 0;
  for(i = 0; i<iprice.length; i++) {
    var newsubTotal = (iprice[i].value)*(iqty[i].value);
    itotal[i].innerText = new Intl.NumberFormat(['ban', 'id']).format(newsubTotal);
    total = total + newsubTotal;
    $.post("CartProcess.php?",{'updateID':iproductID[i].value, 'quantity':iqty[i].value}, function(data, status){
      document.getElementById('cart_amount').innerText = data;
    });
  }
  gtotal.innerText=new Intl.NumberFormat(['ban', 'id']).format(total);
}
subTotal();
