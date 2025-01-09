import React, { Component } from 'react';
import { Button } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

function Botonera(props) {
  let tabla = []
  if (props.jugable) {
    for (let i = 0; i < 8; i++) {
      for (let j = 0; j < 4; j++) {

        if (!(i % 2)) {
          tabla.push(<Button color={props.liBtn[0]}></Button>)
        }

        if (i > 4) {
          tabla.push(<Button color={props.liBtn[1]}></Button>)
        } else {
          tabla.push(<Button color={props.liBtn[2]}></Button>)
        }

        if (i % 2) {
          tabla.push(<Button color={props.liBtn[0]}></Button>)
        }
      }
      tabla.push(<br />)
    }
  }


  return (
    tabla
  );
}


class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      listaBotones: ["", "success", "secondary"],
      playable: false
    }
  }

  jugar() {
    let aux = this.state.playable

    if(aux){
      aux = false
    }else{
      aux = true
    }

    this.setState ({
      playable: aux
    })
  }

  render() {
    return (
      <div className="App">
        <header className='App-header'>
          <Button onClick={() => this.jugar()}>Jugar</Button> <br />
          <Botonera jugable={this.state.playable} liBtn={this.state.listaBotones} />
        </header>
      </div>
    );
  }
}

export default App;