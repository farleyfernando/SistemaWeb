const BASE_URL = "http://localhost/ordem-servico/";
//const BASE_URL = "https://solutionsistemas.000webhostapp.com/";




$(function() {
    function blinker() {
        $('.blink_me').fadeOut(1000);
        $('.blink_me').fadeIn(1000);
    }
    setInterval(blinker, 1000);
}); //]]>