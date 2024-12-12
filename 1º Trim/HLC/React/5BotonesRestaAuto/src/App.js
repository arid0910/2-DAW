import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';
import { Component } from 'react'

class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      // DEFINE AQUÍ TU ESTADO
      // Creando un array de objetos btn
      botones : [
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

    

    this.setState({
     
    })
  }

  render() {
    return (
      <div className="App">
        <header className="App-header">
          {/* // RENDERIZA AQUÍ LO QUE NECESITES */}
          {/* Pasar callback a botoncillo */}
          {/* Le tenemos ue pasar a Botonciilo que numBtn es */}
          <Botoncillo color={this.state.listaBtn[0]} cont={this.state.listaCont[0]} pos={0} click={(n) => this.clickBtn(n)} />
          <Botoncillo color={this.state.listaBtn[1]} cont={this.state.listaCont[1]} pos={1} click={(n) => this.clickBtn(n)} />
          <Botoncillo color={this.state.listaBtn[2]} cont={this.state.listaCont[2]} pos={2} click={(n) => this.clickBtn(n)} />
          <Botoncillo color={this.state.listaBtn[3]} cont={this.state.listaCont[3]} pos={3} click={(n) => this.clickBtn(n)} />
          <Botoncillo color={this.state.listaBtn[4]} cont={this.state.listaCont[4]} pos={4} click={(n) => this.clickBtn(n)} />

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