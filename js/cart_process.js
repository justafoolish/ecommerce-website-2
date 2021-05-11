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

var btndec = document.getElementsByClassName('btn-dec');
var btninc = document.getElementsByClassName('btn-inc');

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

for (let i = 0; i < btninc.length; i++) {
  btninc[i].addEventListener("click", function() {
    incr(i);
  }, false);
}
for (let i = 0; i < btndec.length; i++) {
  btndec[i].addEventListener("click", function() {
    decr(i);
  }, false);
}

function incr(i) {
  var num = parseInt(iqty[i].value);
  num++;
  iqty[i].value = num;
  subTotal();
}
function decr(i) {
  var num = parseInt(iqty[i].value);
  num--;
  if(num == 0) {
    iqty[i].value = 1;
  }
  else {
    iqty[i].value = num;
  }
  subTotal();
}

function lockNoti() {
  alert("Tài khoản của bạn đang bị khóa. Vui lòng liên hệ quản trị viên.");
}
