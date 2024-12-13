import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';
import { Component } from 'react'

class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      // DEFINE AQUÍ TU ESTADO
      // Creando un array de objetos btn
      botones: [
        { color: "primary", cont: 0 },
        { color: "primary", cont: 0 },
        { color: "primary", cont: 0 },
        { color: "primary", cont: 0 },
        { color: "primary", cont: 0 },
      ],
    }
  }

  //Esto es mi call back
  clickBtn(numBtn) {
    let auxBotones = this.state.botones

    auxBotones[numBtn].cont += 1
    if (auxBotones[numBtn].cont >= 1) {
      auxBotones[numBtn].color = "primary";
    }

    auxBotones.filter(c => c.cont === 0).map(x => x.color = "secondary")
    
    this.setState({
      botones: auxBotones
    })

    const resta = () =>{
      if(auxBotones[numBtn].cont > 0){
        auxBotones[numBtn].cont--

        if(auxBotones[numBtn].cont === 0){
          auxBotones[numBtn].color = "secondary"
        }

        if(auxBotones.filter(c => c.cont === 0).length === 5){
          auxBotones.map(x => x.color = "primary")
        }

        this.setState({botones:auxBotones})
        setTimeout(()=>resta(),3000)
      }
    }

    setTimeout(()=>resta(),3000)
  }

  render() {
    return (
      <div className="App">
        <header className="App-header">
          {/* // RENDERIZA AQUÍ LO QUE NECESITES */}
          {/* Pasar callback a botoncillo */}
          {/* Le tenemos ue pasar a Botonciilo que numBtn es */}
          <Botoncillo color={this.state.botones[0].color} cont={this.state.botones[0].cont} pos={0} click={(n) => this.clickBtn(n)} />
          <Botoncillo color={this.state.botones[1].color} cont={this.state.botones[1].cont} pos={1} click={(n) => this.clickBtn(n)} />
          <Botoncillo color={this.state.botones[2].color} cont={this.state.botones[2].cont} pos={2} click={(n) => this.clickBtn(n)} />
          <Botoncillo color={this.state.botones[3].color} cont={this.state.botones[3].cont} pos={3} click={(n) => this.clickBtn(n)} />
          <Botoncillo color={this.state.botones[4].color} cont={this.state.botones[4].cont} pos={4} click={(n) => this.clickBtn(n)} />

        </header>
      </div>
    );
  }
}

function Botoncillo(props) {
  return (
    // MUESTRA AQUÍ EL BOTÓN CON EL COLOR
    //Llamar callback en el onclick
    <Button color={props.color} onClick={() => props.click(props.pos)}>{props.cont}</Button>
  );
}
export default App;