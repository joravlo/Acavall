function filterForDate(routeApi) {
  $(function(){
                $.ajax({
                  type: 'GET',
                  url: 'http://localhost:8000/api/' + routeApi,
                  success: function(data) {
                    console.log(data);
                     document.getElementById("cardListContainer").innerHTML = "";
                     if(data.code != 400) {
                       $.each(data, function(i) {
                         createCard(data[i].eventId,data[i].image,convertTimestamp(data[i].date.timestamp),data[i].name,data[i].address,data[i].price)
                        });
                     }
                  }
                })
              });
}

function convertTimestamp(timestamp) {
  var monthNames = [
    "Jan", "Feb", "Mar",
    "Apr", "May", "Jun", "Jul",
    "Aug", "Sept", "Oct",
    "Nov", "Dec"
  ];

  var d = new Date(timestamp * 1000),	// Convert the passed timestamp to milliseconds
		yyyy = d.getFullYear(),
		mm = monthNames[d.getMonth()],	// Months are zero based. Add leading 0.
		dd = ('0' + d.getDate()).slice(-2),			// Add leading 0.
		time;

  time = {
    month:mm,
    day:dd,
  }

	return time;
}

function createCard(eventId, eventImg, dateEvent, nameEvent, addressEvent, priceEvent) {
  var cardContainer = document.createElement("div");
  cardContainer.className += 'card cardFormat';
  var divImage = document.createElement("div");
  divImage.className += 'contImg';
  var imageCard = document.createElement("IMG");
   imageCard.setAttribute("class", "card-img-top");
   imageCard.setAttribute("src", "img_pulpit.jpg");
   imageCard.setAttribute("width", "100p");
   imageCard.setAttribute("height", "130");
   imageCard.setAttribute("alt", "Imagen card evento");
   imageCard.onerror = function() {imageCard.setAttribute("src", "/img/acavall.jpg")};
   divImage.appendChild(imageCard);
   cardContainer.appendChild(divImage);
   var cardBlock = document.createElement("div");
   cardBlock.className += 'card-block';
   var eventName = document.createElement("p");
   eventName.setAttribute("id", "eveName");
   eventName.style.fontWeight = "bold";
   eventName.innerHTML = nameEvent;
   cardBlock.appendChild(eventName);
   var contCard = document.createElement("div");
   contCard.className += 'container';
   contCard.setAttribute("id", "contCard");
   var rowConCard = document.createElement("div");
   rowConCard.className += 'row';
   rowConCard.style.marginBottom = "5px"
   var col4ConCard = document.createElement("div");
   col4ConCard.className += 'col-md-4 text-center';
   var divMonth = document.createElement("div");
   divMonth.setAttribute("id", "month");
   divMonth.innerHTML = dateEvent.month;
   col4ConCard.appendChild(divMonth);
   var divDay = document.createElement("div");
   divDay.setAttribute("id", "day");
   divDay.innerHTML = dateEvent.day;
   col4ConCard.appendChild(divDay);
   rowConCard.appendChild(col4ConCard);
   var col8ConCard = document.createElement("div");
   col8ConCard.className += 'col-md-8';
   col8ConCard.style.fontSize = "14px";
   var pPrice = document.createElement("p");
   pPrice.style.marginBottom = "0px";
   pPrice.innerHTML = '<i style="color:grey;" class="far fa-money-bill-alt"></i> &nbsp; desde <b>'+priceEvent+' €</b>';
   col8ConCard.appendChild(pPrice);
   var pMarker = document.createElement("p");
   pMarker.innerHTML = '<i style="color:grey;" class="fas fa-map-marker"></i> &nbsp;' + addressEvent;
   col8ConCard.appendChild(pMarker);
   rowConCard.appendChild(col8ConCard);
   contCard.appendChild(rowConCard);
   var row2ConCard = document.createElement("div");
   row2ConCard.className += 'row';
   var colmd5 = document.createElement("div");
   colmd5.className += 'col-md-5 text-center';
   colmd5.style.paddingTop = "8px";
   colmd5.innerHTML = '<a style="color:#c8c22f; text-decoration:none;" href="/event/'+eventId+'"> VER MAS </a>'//Poner link
   row2ConCard.appendChild(colmd5);
   var colmd7 = document.createElement("div");
   colmd7.className += 'col-md-7 text-center';
   colmd7.innerHTML = '<a href="/buy" class="btn btnC" width="100px">COMPRAR</a>'//Poner link
   row2ConCard.appendChild(colmd7);
   contCard.appendChild(row2ConCard);
   cardBlock.appendChild(contCard);
   cardContainer.appendChild(cardBlock);

   document.getElementById("cardListContainer").appendChild(cardContainer);
}
