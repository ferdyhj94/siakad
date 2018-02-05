    window.setTimeout(function() {
    $(".alert").fadeTo(200, 0).slideUp(300, function(){
        $(this).remove(); 
    });
}, 4000);
