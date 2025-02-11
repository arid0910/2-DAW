$(function () {
    $("section div.texto").css("display", "none")

    $("section > div").on("click", function() {
        $(this).next().stop(true).slideToggle()
        // $(this).children().children().next().toggle()
        $(this).find("svg:nth-child(2)").toggle()
    })
})