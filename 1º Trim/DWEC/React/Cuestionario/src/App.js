import 'bootstrap/dist/css/bootstrap.min.css';
// import { Button } from 'reactstrap';
import { Component } from 'react'
import Cuestionario from './components/comp_cuestionario';
import './App.css';
import { Alert } from 'reactstrap';

class App extends Component {

  constructor(props) {
    super(props);

    this.state = {
      preguntas: [
        { id: "1", pregunta: "Cuando mandas un mensaje por whatsapp esperas siempre al doble check. Si no aparece vuelves a abrir el terminal para revisarlo al rato." },
        { id: "2", pregunta: "Antes de acostarte siempre miras el móvil a ver si tienes mensajes o notificaciones." },
        { id: "3", pregunta: "Te despiertas antes de tiempo para jugar, mandar mensajes, actualizar perfiles,… con el teléfono móvil." },
        { id: "4", pregunta: "Si sales de casa sin el móvil volverías a cogerlo aunque llegues tarde a tu cita." },
        { id: "5", pregunta: "Tienes miedo a quedarte sin batería." },
        { id: "6", pregunta: "Cuando tienes la batería baja desactivas ciertas aplicaciones u opciones del teléfono como la WiFi, bluetooth para no quedarte sin batería." },
        { id: "7", pregunta: "Tienes ansiedad cuando tienes llamadas perdidas. Llamas a los números y te preocupas si no responden." },
        { id: "8", pregunta: " Miras la cobertura cuando estas en algún sitio con los amigos, esperando, etc." },
        { id: "9", pregunta: "Sueles hacer alguna otra cosa mientras que miras al móvil como comer, lavarte los dientes, etc." },
        { id: "10", pregunta: "Vas al baño siempre con el móvil." },
      ],

      contador : 0,
    }
  }

  handlerOnClick(Btn, id){
    let auxCont = this.state.contador
    let auxLista = this.state.preguntas

    if(Btn === "Si"){
      auxCont += 1
    }

    let liLimpio = auxLista.filter(l => l.id !== id)

    if(liLimpio.length === 0){
      
    }

    console.log(auxLista.filter(l => l.id !== id))
    this.setState({
      preguntas : liLimpio,
      contador : auxCont
    })
  }

  render() {
    return (
      <div className="App">
        <Cuestionario listaPre = {this.state.preguntas} click={(Btn, id)=>this.handlerOnClick(Btn, id)}/>
      </div>
    );
  }
}
export default App;