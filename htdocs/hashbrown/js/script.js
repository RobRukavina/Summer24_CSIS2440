changeFile = (e) => {
    if($('#spies').prop('checked')){
        $('#t1').hide();
        $('#t2').removeAttr("hidden")
        $('main').removeClass("fbi")
        $('main').removeClass("green-bkg")
        $('main').addClass("spies")
        $('#t2').show();
    } else {
        $('#t1').show();
        $('#t2').hide();
        $('main').removeClass("spies")
        $('main').removeClass("green-bkg")
        $('main').addClass("fbi")
    }
}