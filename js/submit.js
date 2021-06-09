function submitOrder() {
    $.post("order.php", function(data) {
        if(data == "true") {
            $('.toast-success').toast({delay:1800});
            $('.toast-success').toast('show');
            document.getElementById("submit-order").disabled = true;
            window.setInterval('refresh()', 1300);
             	

        } else {
            $('.toast-fail').toast({delay:1800});
            $('.toast-fail').toast('show');
        }
    });
    
  }
function refresh() {
    window.open('index.php','_self')
}
document.querySelector('#submit-order').addEventListener("click", function(){
    submitOrder()
   });