$(function () {
    let SliderModule = (function () {
        let pb = {}

        pb.elslider = $("#slider")

        pb.items = {
            panels: pb.elslider.find(".slider-wrapper > li")
        }

        let SliderInterval,
            currentSlider = 0,
            nextSlider = 1,
            lengthSlider = pb.items.panels.length;

        pb.init = function(settings){
            this.settings = settings || {duration:5000}
            let loscontroles = ''
            
            SliderInit();

            for (let i = 0; i < lengthSlider; i++) {
                if(i == 0){
                    loscontroles += "<li class='active'></li>"
                } else {
                    loscontroles += "<li></li>"
                }
            }

            //Insertamos en el html
            $('#control-buttons').html(loscontroles)

            $('#control-buttons > li').on('click', function(){
                if(currentSlider !== $(this).index()){
                    cambiarPanel($(this).index())
                }
                
            })
        }

        let SliderInit = function(){
            SliderInterval = setInterval(pb.startSlider, 3000)
        }

        pb.startSlider = function(){
            let paneles = pb.items.panels;
            let controles = $('#control-buttons li')

            if(nextSlider >= lengthSlider){
                nextSlider = 0
                currentSlider = lengthSlider -1
            }

            controles.removeClass('active')
            controles.eq(nextSlider).addClass('active')

            paneles.eq(currentSlider).fadeOut('slow')
            paneles.eq(nextSlider).fadeIn('slow')

            currentSlider = nextSlider
            nextSlider += 1
        }

        let cambiarPanel = function(indice){
            //Limpiamos el intervalo de ejecución
            clearInterval(SliderInterval);

            let paneles = pb.items.panels
            let controles = $('#control-buttons li')

            //Comprbamos que indice este dispo dentro del paneles
            if(indice >= lengthSlider){
                indice = 0; //No se salga de los paneles dispo
            } else if (indice < 0){
                indice = lengthSlider -1 // Para que no haga overflow
            }

            controles.removeClass('active')
            controles.eq(indice).addClass('active')

            paneles.eq(currentSlider).fadeOut('slow')
            paneles.eq(indice).fadeIn('slow')

            currentSlider = indice
            nextSlider = indice + 1

            //Reactivar slider
            SliderInit()
        }

        return pb;    
    }());

    SliderModule.init({duration:2000});
})