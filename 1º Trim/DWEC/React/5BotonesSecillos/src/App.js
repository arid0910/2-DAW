import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';
import { Component } from 'react'

class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      // DEFINE AQUÍ TU ESTADO
      listaBtn: Array(5).fill("secondary"),
      numBtnActivos: 0
    };
    
  }

  //Esto es mi call back
  clickBtn(numBtn) {
    let aux = this.state.listaBtn
    aux[numBtn] = "danger"
    
    this.setState({ 
      listaBtn: aux,
      numBtnActivos:aux.filter(e => e === "danger").length
    })
  }

  render() {
    return (
      <div className="App">
        <header className="App-header">
          {/* // RENDERIZA AQUÍ LO QUE NECESITES */}
          <h1>{this.state.numBtnActivos}</h1>
          <br />
          {/* Pasar callback a botoncillo */}
          {/* Le tenemos ue pasar a Botonciilo que numBtn es */}
          <Botoncillo color={this.state.listaBtn[0]} pos={0} click={(n)=>this.clickBtn(n)}/>
          <Botoncillo color={this.state.listaBtn[1]} pos={1} click={(n)=>this.clickBtn(n)}/>
          <Botoncillo color={this.state.listaBtn[2]} pos={2} click={(n)=>this.clickBtn(n)}/>
          <Botoncillo color={this.state.listaBtn[3]} pos={3} click={(n)=>this.clickBtn(n)}/>
          <Botoncillo color={this.state.listaBtn[4]} pos={4} click={(n)=>this.clickBtn(n)}/>

        </header>
      </div>
    );
  }
}

function Botoncillo(props) {
  return (
    // MUESTRA AQUÍ EL BOTÓN CON EL COLOR
    //Llamar callback en el onclick
    <Button color={props.color} onClick={()=>props.click(props.pos)}></Button>
  );
}
export default App;