$(document).ready(function(){
  var date_input=$('#dateEvent');
  $("#dateEvent").datetimepicker({
    icons: {
      time: "fa fa-clock-o",
      date: "fa fa-calendar",
      up: "fa fa-chevron-up",
      down: "fa fa-chevron-down",
      next: "fa fa-chevron-right",
      previous: "fa fa-chevron-left"
    }
  });
});

$("#imageEvent").change(function(){
       readURL(this);
   });

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').attr('src', e.target.result)
            .width('100%')
            .height('200px')
            .css("margin-top", "10px");

            $('.imageContainer').fadeIn("slow");
        }

        reader.readAsDataURL(input.files[0]);
    } else {
      $('.imageContainer').fadeOut("slow");
    }
}
