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
      respuestas: [
        "En principio no tienes nada de que preocuparte.",
        "Empiezas a tener signos de dependencia del móvil. Puedes utilizar técnicas como apagar el móvil cuando no lo necesitas, cuando duermes, etc.",
        "Tienes una gran dependencia del móvil. Deberías seguir un plan de «desintoxicación» del móvil como por ejemplo dejar el móvil en casa cuando vas a comprar, apagarlo durante la noche, apagarlo durante horas de clase o trabajo, etc.",
        "Tus síntomas de dependencia son muy preocupantes. Además de todas las técnicas de los apartados anteriores deberías plantearte un plan de desintoxicación del móvil que consista en estar una o dos semanas sin utilizarlo. Si ves que no puedes hacerlo por ti mismo, pide ayuda a un profesional.",
      ],
      contador: 0,
      mostrarAlerta: false
    }
  }

  handlerOnClick(Btn, id) {
    let auxCont = this.state.contador
    let auxLista = this.state.preguntas

    if (Btn === "Si") {
      auxCont += 1
    }

    let liLimpio = auxLista.filter(l => l.id !== id)

    this.setState({
      preguntas: liLimpio,
      contador: auxCont,
      mostrarAlerta: liLimpio.length === 0
    })
  }

  alertas(){
    let alerta = ""
    let cont = this.state.contador

    if (this.state.mostrarAlerta) {
      if (cont >= 1 && cont <= 5) {
        alerta = <Alert color='success'>{this.state.respuestas[0]}</Alert>;
      } else if (cont >= 6 && cont <= 7) {
        alerta = <Alert color='primary'>{this.state.respuestas[1]}</Alert>;
      } else if (cont >= 8 && cont <= 9) {
        alerta = <Alert color='warning'>{this.state.respuestas[2]}</Alert>;
      } else {
        alerta = <Alert color='danger'>{this.state.respuestas[3]}</Alert>;
      }
    }

    return alerta
  }

  render() {
    return (
      <div className="App">
        <Cuestionario listaPre={this.state.preguntas} click={(Btn, id) => this.handlerOnClick(Btn, id)} />
        <>{this.alertas()}</>
      </div>
    );
  }
}
export default App;