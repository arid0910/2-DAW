import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';
import { Component } from 'react'

class App extends Component {
  constructor(props){
    super(props);

    this.state={
      colores:Array(5).fill("secondary")
    }
  }

  cambioColor(numBtn){
    let copia = this.state.colores
    if(this.state.colores[numBtn] === "secondary"){
      copia[numBtn]="primary"
    } 

    if(this.state.colores[numBtn] === "primary"){
      copia[numBtn]="primary"
    }

    if(this.state.colores[numBtn -1] === "primary"){
      copia[numBtn-2]="secondary"
    } 
    
    if(this.state.colores[numBtn +1] === "primary"){
      copia[numBtn+2]="secondary"
    }

    this.setState({colores: copia})
  }

  render(){
    return (
      <div className="App">
        <Button color={this.state.colores[0]} onClick={()=>this.cambioColor(0)}> uno </Button>
        <Button color={this.state.colores[1]} onClick={()=>this.cambioColor(1)}> dos </Button>
        <Button color={this.state.colores[2]} onClick={()=>this.cambioColor(2)}> tres </Button>
        <Button color={this.state.colores[3]} onClick={()=>this.cambioColor(3)}> cuatro </Button>
        <Button color={this.state.colores[4]} onClick={()=>this.cambioColor(4)}>cinco</Button>
      </div>
    );
  }
}
export default App;