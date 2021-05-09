function addCart(id) {
  $.post("addCart.php?",{'productID':id}, function(data, status){
    var result = data.split("-");

    $("#cart_amount").text(result[0]);
  });
  $('.toast').toast({delay:1850});
  $('.toast').toast('show');
  


}