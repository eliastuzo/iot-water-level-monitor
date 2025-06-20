$(".recuperar").click(myFunction);
$(".correo").click(mandarConfirmacion);
$(".ham-menu").click(abrirMenu);

$("a").mouseover(function() {
    $(this).css("textDecoration","underline")
}).mouseleave(function() {
    $(this).css("textDecoration", "none");
})

function mostrarEnlace() {
    $(".recuperar-pwsd").fadeToggle().css("display", "block");
    $(".recuperar-pwsd .form").css("margin-top", "46px");
}

function myFunction() {
    $(".login").fadeToggle();
    $(".prompts").fadeToggle();
    $(".error").text("")
    $(".recuperar").text("")
    setTimeout(mostrarEnlace,700);
}

function hidePrompts() {
    $(".prompts").fadeToggle();
}

function mandarConfirmacion(){
    $(".prompts").fadeToggle().css("position", "absolute !important");
    setTimeout(hidePrompts, 4000);
}

function abrirMenu(){
    console.log("prueba");
    $(".ham-menu").toggleClass('active');
    $(".off-screen-menu").toggleClass('active');
} 

