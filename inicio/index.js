$(".ham-menu").click(abrirMenu);

function abrirMenu(){
    console.log("prueba");
    $(".ham-menu").toggleClass('active');
    $(".off-screen-menu").toggleClass('active');
} 

$("a").mouseover(function() {
    $(this).css("textDecoration","underline")
}).mouseleave(function() {
    $(this).css("textDecoration", "none");
})

