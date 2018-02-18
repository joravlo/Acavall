
function multiplicarInputs(text){
      var num = document.getElementById("numero").value;
      console.log(num);
      var div=document.getElementById("todo").innerHTML;
      if (num>1) {
        for (var i=2;i<num;i++){
          div+=document.getElementById("todo").innerHTML;
        }
        document.getElementById("divMultiInputs").innerHTML=div;
      }else if (num=="1") {
        document.getElementById("divMultiInputs").innerHTML='';
      }
}

function nuevoCampo() {
    var select = document.getElementById("gender").value;
    if (select=="niño") {
      $('#formchildage').fadeIn("slow");
    }else if (select=="adulto") {
      $('#formchildage').fadeOut("slow");
    }
}
