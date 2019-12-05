$(".eachdept").click(function() {
  var id = this.id;
  // alert(id);
  $(".department").css("display", "none");
  $(".imagelink").css("display", "none");
  $("." + id).css("display", "block");
  $(".backbutton").attr("id", id);
  $(".backbutton").css("display", "block");
});

$(".backbutton").click(function() {
  var id = this.id;
  $(".department").css("display", "block");
  $(".imagelink").css("display", "block");
  $("." + id).css("display", "none");
  $(".backbutton").css("display", "none");
  $(".backbutton").attr("id", "");
});

// month1 & month2
$(document).ready(function() {
  $("#ml1").click(function() {
    $("#ml2").slideToggle("slow");
  });
  $("#ml3").click(function() {
    $("#ml4").slideToggle("slow");
  });
});

$(document).ready(function() {
  $("#wb1").click(function() {
    $("#wb2").slideToggle("slow");
  });
  $("#wb3").click(function() {
    $("#wb4").slideToggle("slow");
  });
});

$(document).ready(function() {
  $("#ai1").click(function() {
    $("#ai2").slideToggle("slow");
  });
  $("#ai3").click(function() {
    $("#ai4").slideToggle("slow");
  });
});

$(document).ready(function() {
  $("#ds1").click(function() {
    $("#ds2").slideToggle("slow");
  });
  $("#ds3").click(function() {
    $("#ds4").slideToggle("slow");
  });
});

$(document).ready(function() {
  $("#es1").click(function() {
    $("#es2").slideToggle("slow");
  });
  $("#es3").click(function() {
    $("#es4").slideToggle("slow");
  });
});

$(document).ready(function() {
  $("#dm1").click(function() {
    $("#dm2").slideToggle("slow");
  });
  $("#dm3").click(function() {
    $("#dm4").slideToggle("slow");
  });
});

$(document).ready(function() {
  $("#bc1").click(function() {
    $("#bc2").slideToggle("slow");
  });
  $("#bc3").click(function() {
    $("#bc4").slideToggle("slow");
  });
});

$(document).ready(function() {
  $("#it1").click(function() {
    $("#it2").slideToggle("slow");
  });
  $("#it3").click(function() {
    $("#it4").slideToggle("slow");
  });
});

$(document).ready(function() {
  $("#ro1").click(function() {
    $("#ro2").slideToggle("slow");
  });
  $("#ro3").click(function() {
    $("#ro4").slideToggle("slow");
  });
});

$(document).ready(function() {
  $("#he1").click(function() {
    $("#he2").slideToggle("slow");
  });
  $("#he3").click(function() {
    $("#he4").slideToggle("slow");
  });
});

$(document).ready(function() {
  $("#ca1").click(function() {
    $("#ca2").slideToggle("slow");
  });
  $("#ca3").click(function() {
    $("#ca4").slideToggle("slow");
  });
});

$(document).ready(function() {
  $("#cd1").click(function() {
    $("#cd2").slideToggle("slow");
  });
  $("#cd3").click(function() {
    $("#cd4").slideToggle("slow");
  });
});

$(document).ready(function() {
  $("#ic1").click(function() {
    $("#ic2").slideToggle("slow");
  });
  $("#ic3").click(function() {
    $("#ic4").slideToggle("slow");
  });
});