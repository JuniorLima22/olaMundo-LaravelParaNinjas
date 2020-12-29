$(document).ready(function() {
    $(".alert-dismissible").fadeTo(5000, 500).slideUp(500, function(){
        $(".alert-dismissible").alert('close');
    });
});
