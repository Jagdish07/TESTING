(function ($) {
  'use strict';

  $(document).ready(function () {
    // Shop Slider
    var shopSlider = $('#shopSlider');
    if (shopSlider.length > 0) {
      shopSlider.owlCarousel({
        loop: true,
        margin: 0,
        items: 6,
        nav: true,
        dots: false
      })
    }

    //Fixed Header
    $(function () {
      var header = $("header");
      $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 500) {
          header.addClass("animated fadeInDown fixed");
        } else {
          header.removeClass("animated fadeInDown fixed");
        }
      });
    });


    //File Upload
    $(function () {
      $('body').find("input[type='file']").on('change', function () {
        var fileName = $(this).val();
        // if (fileName.length > 0) {
        //   $(this).parent().children('span').html(fileName);
        // } else {
        //   $(this).parent().children('span').html("Add");
        // }
      });
      //file input preview
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('body').find('.logoContainer img').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $('body').find("input[type='file']").on('change', function () {
        readURL(this);
      });
    });

    // Custom Scroll
    var ChatBox = $('.chat-box-sec');
    if (ChatBox.length > 0) {
      ChatBox.mCustomScrollbar({
        axis: "y"
      });
    }

    //Check Number
    var inputTel = $("body").find('input[type="tel"]');
    if (inputTel.length > 0) {
      var inputTelField = $('#tel'),
        inputTelField2 = $('#tel2');
      inputTelField.mobilePhoneNumber({
        allowPhoneWithoutPrefix: '+1'
      });
      inputTelField2.mobilePhoneNumber({
        allowPhoneWithoutPrefix: '+1'
      });

    }


    // Custom popup
    $(function () {
      //----- OPEN
      $('[pd-popup-open]').on('click', function (e) {
        var targeted_popup_class = jQuery(this).attr('pd-popup-open');
        $('[pd-popup="' + targeted_popup_class + '"]').fadeIn(100);
        $("body").addClass("open");
        e.preventDefault();
      });

      //----- CLOSE
      $('[pd-popup-close]').on('click', function (e) {
        var targeted_popup_class = jQuery(this).attr('pd-popup-close');
        $('[pd-popup="' + targeted_popup_class + '"]').fadeOut(200);
        $("body").removeClass("open");
        e.preventDefault();
      });
    });

    //Avoid pinch zoom on iOS
    document.addEventListener('touchmove', function (event) {
      if (event.scale !== 1) {
        event.preventDefault();
      }
    }, false);
  });
})

$(document).ready(function() {
  $('.get_id_value').on('click',function(){
    var id_val = $(this).attr('id');
    var prod_id = id_val.substr(11,11);
    $('.product_ids').val(prod_id);
  });

  $('#generate_qr_codes_values').on('click',function(){
    var id = $('.product_ids').val();
    var quantity = $('.qr_codes_quantity').val();
    var url = $('.site_url_values').val();
    $.ajax({
      type:"POST",
      url: url+"/download_qr_codes",
      data:{'id':id,'quantity':quantity,'_token':$('meta[name="csrf-token"]').attr('content')},
      dataType: "json",
      success:function(data) {
        window.location.href= url+"/downloadPDF";
      }
    });
  });

  $('.generate_code').on('click',function(){
  	$('#modalResponse').modal('hide');
  	$('#reponseValues').submit();
    location.reload(true);
  });

  $('#example1').DataTable();
  $('.showImage').hide();
  $(".addImage").change(function (e) {
  $('.uploaded_image').hide();
   $('.showImage').show();
    for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
    var file = e.originalEvent.srcElement.files[i];
    var img = document.createElement("img");
    var reader = new FileReader();
    reader.onloadend = function () {
    img.src = reader.result;
    $('.showImage').attr('src', img.src);
    }
    reader.readAsDataURL(file);
    e.preventDefault();
    }
});
  $('#product_ids').select2({
    closeOnSelect: false,
    allowClear: true
  });
  $('#brands').select2({
    closeOnSelect: false,
    allowClear: true
  });
  $('#brand').select2({
    closeOnSelect: false,
    allowClear: true
  });
  $('#locations').select2({
    closeOnSelect: false,
    allowClear: true
  });
  $('#gift_cards').select2({
    closeOnSelect: false,
    allowClear: true
  });
  $( ".date" ).datetimepicker({
      format: 'L'
  });
  // $( "#end_date" ).datetimepicker({
  //   changeMonth: true,
  //   changeYear: true,
  // });

  $("#brands").on("change", function(){
    var value = $('#brands').val();
    var url = $('#site_url').val();
    if(value != null){
      var outputText = '';
      $.each(value,function(key,value){
        var values = value+',';
        outputText += values;
        $.ajax({
          type:"POST",
          url: url+"/getLocations",
          data:{'brand_names':outputText,'_token':$('meta[name="csrf-token"]').attr('content')},
          dataType: "json",
          success:function(data) {
            $('#product_ids').select2('val',[data['products']]);
            $('#locations').select2('val',[data['locations']]);
          }
        });
      });
    } else{
      $("#product_ids").val(null).trigger('change');
      $("#locations").val(null).trigger('change');
    }
  });

  var windowURL = window.location.href;
  pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
  var x= $('a[href="'+pageURL+'"]');
    x.addClass('active');
    x.parent().addClass('active');
  var y= $('a[href="'+windowURL+'"]');
    y.addClass('active');
    y.parent().addClass('active');
});

$(document).ready(function() {
    salesPoints();
    sales();
    pointsWeekly();
});

function salesPoints() {
    var ctx = $('#salesPointChart');
    let label = [];
    let points = [];
    let sales = [];
    $.getJSON( "http://68.183.74.38:8008/joao/salesPointChart", function( data ) {

        $.each(data, function (key, val) {
            label.push(val['month_name']);
            points.push(val['points']);
            sales.push(val['sales']);

        });
        var data = {
            labels: label,
            datasets: [
                {
                    label: "Sales",
                    backgroundColor: ["#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd"],
                    data: sales
                },
                {
                    label: "Points",
                    backgroundColor: ["#8e5ea2", "#8e5ea2", "#8e5ea2", "#8e5ea2", "#8e5ea2", "#8e5ea2", "#8e5ea2", "#8e5ea2", "#8e5ea2", "#8e5ea2", "#8e5ea2", "#8e5ea2"],
                    data: points
                }
            ]
        };
        var options = {
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        };

        var stackedBar = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
}

function sales() {
    var ctx = $('#salesChart');
    let label = [];

    let sales = [];
    $.getJSON( "http://68.183.74.38:8008/joao/userActive", function( data ) {
        var items = [];
        $.each(data, function (key, val) {
            label.push(val['MonthName']);
            sales.push(val['user_count']);

        });
        var data = {
            labels: label,
            datasets: [
                {
                    label: "User Growth",
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)'
                    ],
                    data: sales
                },
            ]
        };
        var options = {
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        };

        var stackedBar = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    });
}

function pointsWeekly(){
    var ctx = $('#pointsWeekly');
    let label = [];
    let points = [];
    $.getJSON( "http://68.183.74.38:8008/joao/weeklyPoints", function( data ) {

        $.each(data, function (key, val) {
            label.push(val['weekname']);
            points.push(val['sum_points_clamied']);

        });
        var d = new Date();
        var month = new Array();
        month[0] = "January";
        month[1] = "February";
        month[2] = "March";
        month[3] = "April";
        month[4] = "May";
        month[5] = "June";
        month[6] = "July";
        month[7] = "August";
        month[8] = "September";
        month[9] = "October";
        month[10] = "November";
        month[11] = "December";
        var n = month[d.getMonth()];
        var data = {
            labels: label,
            datasets: [{
                label: "Points distributed in "+ n,
                backgroundColor: ["#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd"],
                borderColor: ["#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd"],
                data: points,
                fill: false
            }]
        };
        var options = {
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        };

        var stackedBar = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    });
}
