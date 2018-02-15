
function multiplicarInputs(text){
      var num = document.getElementById("numero").value;
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
    var select = document.getElementById("inputState").value;
    if (select=="niño") {
      document.getElementById("formniño").style.visibility = "visible";
    }else if (select=="adulto") {
      document.getElementById("formniño").style.visibility = "collapse";
    }
}

function sumarPrecio(text) {
  var precio = document.getElementById('precio').value;
  console.log(precio);
}
