import 'bootstrap/dist/css/bootstrap.min.css';
import { Component } from 'react';
import { Button } from 'reactstrap';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      tabla: [{},
      { nombre: "COCKED PISTOL", medida: "Guerra nuclear inminente", color: "secondary" },
      { nombre: "FAST PACE", medida: "Paso previo a la guerra nuclear", color: "danger" },
      { nombre: "ROUND HOUSE", medida: "Incremento en la preparación y movilización de tropas", color: "warning" },
      { nombre: "DOUBLE TAKE", medida: "Incremento de la vigilacia por inteligencia y extremar las medidas de seguridad", color: "success" },
      { nombre: "FADE OUT", medida: "Estado más bajo", color: "primary" }
      ],
      sumador: 0,
      numDefcon: "",
      txtDefcon:"Nada de momento",
      color:"primary"
    };
  }

  handlerOnClick(numBtn) {
    let auxSum = this.state.sumador
    let auxNumDef = this.state.numDefcon
    let auxTxtDef = this.state.txtDefcon
    let auxCol = this.state.color

    if(numBtn === 1){
      auxSum += 50
    }

    if(numBtn === 2){
      auxSum += 200
    }

    if(numBtn === 3){
      auxSum += 25
    }
    
    if(auxSum >= 0 && auxSum <= 200){
       auxNumDef = 5
       auxCol = this.state.tabla[5].color
       auxTxtDef = this.state.tabla[5].nombre + " - " + this.state.tabla[5].medida
    }

    if(auxSum >= 201 && auxSum <= 299){
      auxNumDef = 4
      auxCol = this.state.tabla[4].color
      auxTxtDef = this.state.tabla[4].nombre + " - " + this.state.tabla[4].medida
    }

    if(auxSum >= 300 && auxSum <= 399){
      auxNumDef = 3
      auxCol = this.state.tabla[3].color
      auxTxtDef = this.state.tabla[3].nombre + " - " + this.state.tabla[3].medida
    }

    if(auxSum >= 400 && auxSum <= 499){
      auxNumDef = 2
      auxCol = this.state.tabla[2].color
      auxTxtDef = this.state.tabla[2].nombre + " - " + this.state.tabla[2].medida
    }

    if(auxSum > 500){
      auxNumDef = 1
      auxCol = this.state.tabla[1].color
      auxTxtDef = this.state.tabla[1].nombre + " - " + this.state.tabla[1].medida
    }

    this.setState({
      sumador:auxSum,
      numDefcon:auxNumDef,
      txtDefcon:auxTxtDef,
      color:auxCol
    })

  }

  render() {
    return (
      <div className="App">
        <Defcon textoDef={this.state.txtDefcon} color={this.state.color}/>
        <h1>DEFCON{this.state.numDefcon} ({this.state.sumador})</h1>
        <Button onClick={() => this.handlerOnClick(1)}>Conflico fronterizo (suma 50)</Button>
        <Button onClick={() => this.handlerOnClick(2)}>Lanzamiento cohete (suma 200)</Button>
        <Button onClick={() => this.handlerOnClick(3)}>Retórica belicista(suma 25)</Button><br />

      </div>
    );
  }
}

function Defcon(props) {
  return (
    <>
      <Button color={props.color}>{props.textoDef}</Button>
    </>
  )
}

export default App;